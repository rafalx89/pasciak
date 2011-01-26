<?php

	include ('strona.inc');
	
	class Kontrakt extends Baza
	{
		public function wyswietlKontrakt($zawodnik)
		{
			$this->zapytanie = "select Imie, Nazwisko, ID_druzyny from zawodnik where ID_zawodnik = '".$zawodnik."'";
			$wynikZapytania1 = $this->select($this->zapytanie);
			$this->zapytanie = "select Nazwa from druzyna where ID_druzyny = '".mysql_result($wynikZapytania1, 0, 2)."'";
			$wynikZapytania2 = $this->select($this->zapytanie);
			echo $wynikZapytania2['Nazwa'];
			$this->zapytanie = "select * from kontrakt where ID_zawodnika = '".$zawodnik."'";
                        $wynikZapytania3 = mysql_query($this->zapytanie, $this->db);
                        $zawartosc="";
			if(mysql_num_rows($wynikZapytania3)==1)
			{
				
				$nr_kontraktu = mysql_result($wynikZapytania3, 0, 0);
				$data_rozpoczecia = mysql_result($wynikZapytania3, 0, 1);
				$data_zakonczenia = mysql_result($wynikZapytania3, 0, 2);
				$placa = mysql_result($wynikZapytania3, 0, 3);
			}
			else
			{
				$nr_kontraktu ='brak danych';
				$data_rozpoczecia ='brak danych';
				$data_zakonczenia ='brak danych';
				$placa = 'brak danych';
			}
			$zawartosc .= '<div class="wyswietl">';
			$zawartosc .= '<h3><span id="nazwa"> '.mysql_result($wynikZapytania1, 0, 0).' '.mysql_result($wynikZapytania1, 0, 1).'</span></h3><br />';
			$zawartosc .= '<span id="nazwa">Klub:</span>  '.mysql_result($wynikZapytania2, 0).'<br />';
			$zawartosc .= '<span id="nazwa">Nr kontraktu:</span>  '.$nr_kontraktu.'<br />';
			$zawartosc .= '<span id="nazwa">Data rozpoczęcia:</span>  '.$data_rozpoczecia.'<br />';
			$zawartosc .= '<span id="nazwa">Data zakończenia:</span>  '.$data_zakonczenia.'<br />';
			$zawartosc .= '<span id="nazwa">Płaca:</span>  '.$placa.'<br />';
			
					$zawartosc .='<form method="get" action="kontrakty.php" id="" name="UsunKontrakt">';
					$zawartosc .='<input type="hidden" name="usun" value="'.$nr_kontraktu.'" />';
					$zawartosc .='<input type="submit"  id="button" value="Usuń" />';
					$zawartosc .='</form>';
					
			$zawartosc .= '<hr></div>';
			
			return $zawartosc;
		}
		public function dodajKontrakt()
		{
			$sql_query = "select ID_zawodnik, Imie, Nazwisko, Kraj from zawodnik;";
			$sql_result=$this->select($sql_query);
			$zawartosc = '<form method="get" action="kontrakty.php" id="test" name="test">';

				$zawartosc .= '<table id="dodajLige">';
					$zawartosc .= "<tr id=\"dodaj\"><td><h3>Dodaj kontrakt: </h3></td></tr>"; 
					$zawartosc .='<tr>';
						$zawartosc .='<td>Data rozpoczecia.(RRRR-MM-DD): </td>';
						$zawartosc .='<td><input type="text" name="Data_roz" value="" size="30" /></td>';
					$zawartosc .='</tr>';
					$zawartosc .='<tr>';
						$zawartosc .='<td>Data zakonczenia.(RRRR-MM-DD): </td>';
						$zawartosc .='<td><input type="text" name="Data_zak" value="" size="30" /></td>';
					$zawartosc .='</tr>';
					$zawartosc .='<tr>';
						$zawartosc .='<td>Płaca: </td>';
						$zawartosc .='<td><input type="text" name="Placa" value="" size="30" /></td>';
					$zawartosc .='</tr>';
					$zawartosc .='<tr>';
						$zawartosc .='<td>Zawodnik: </td>';
						$zawartosc .='<td><select name="Zawodnik">';
						for($i=0;$i<mysql_num_rows($sql_result); $i++)
						{
							$zawartosc .='<option>'.mysql_result($sql_result,$i, 0).'. '.mysql_result($sql_result,$i, 1).' '.mysql_result($sql_result,$i, 2).', '.mysql_result($sql_result,$i, 3).'</option>';
						}
					$zawartosc .='</select></td></tr>';
					$zawartosc .='<tr>';
						$zawartosc .='<td><input type="submit" name="dodaj" value="Zatwierdz" /></td>';
					$zawartosc .='</tr>';
				$zawartosc .='</table>';
			$zawartosc .='</form>';
			return $zawartosc;
		}
	}
	
	$kontrakt = new Kontrakt();
	$kontrakt->polaczZBaza();
	$kontrakt->naglowek = 'kontrakty';
	if(isset($_GET['usun']))
	{
		$usun = $_GET['usun'];
		$kontrakt->zapytanie = "delete from kontrakt where ID_zawodnika = '".$usun."'";
		$wynikZapytania = $kontrakt->select($kontrakt->zapytanie);
		if(mysql_error())
		{
			$kontrakt->zawartosc = "<h3 align='center' color = 'red'>Błąd!</h3>";
		}
		else
		{
			$kontrakt->zawartosc = "<h3 align= 'center'>Usunięto</h3>";
			$kontrakt->zapytanie = "update zawodnik set Kontrakt='0' where ID_zawodnik = '2';";
			$wynikZapytania = $kontrakt->select($kontrakt->zapytanie);
		}
	}
	else if(isset($_GET['id_zawodnika']))
	{
		$zawodnik = $_GET['id_zawodnika'];
		$kontrakt->zawartosc = $kontrakt->wyswietlKontrakt($zawodnik);
		
	}
	else
	{
		
		if(isset($_GET['Data_roz']) && isset($_GET['Data_zak']) && isset($_GET['Placa']) && isset($_GET['Zawodnik']))
		{
			if($_GET['Data_roz']!="" && $_GET['Data_zak']!="" && $_GET['Placa']!="" && $_GET['Zawodnik']!="")
			{
				$data_roz = $_GET['Data_roz'];
				$data_zak = $_GET['Data_zak'];
				$placa = (double)$_GET['Placa'];
				$zawodnik = $_GET['Zawodnik'];
				$zawodnik = explode('.', $zawodnik);
				$kontrakt->zapytanie ="insert into kontrakt values('', $data_roz, $data_zak, $placa, $zawodnik[0])";
				$kontrakt->zawartosc = $kontrakt->select($kontrakt->zapytanie);
				$kontrakt->zawartosc = "<h3 align='center'>Dodano</h3>";
				
			}
			else
			{
				$kontrakt->zawartosc = '<h3 align = "center">Niepoprawne dane!</h3>';
			}
		}
		else
		{
			$kontrakt->zawartosc = "<h3 align='center'>Jeśli chcesz przeglądnąć kontrakt to wybierz kontrakt klikając na aktywny kontrakt przy zawodniku w zakładce Zawodnicy</h3><br /><br />";
			$kontrakt->zawartosc .= $kontrakt->dodajKontrakt();
		}
	}
	$kontrakt->wyswietlStrone();
	$kontrakt->zamknijBaze($kontrakt->db);
	unset($kontrakt);
?>
