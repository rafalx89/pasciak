﻿<?php
	include('strona.inc');
	class Zawodnik extends Baza
	{
		public function setZawodnik($sql_result, $druzyna)
		{
			$zawartosc = "";
			for($i=0;$i<mysql_num_rows($sql_result); $i++)
			{
				$zawartosc .= '<div  class="wyswietl">';
				
					$zawartosc .= '<h3><span id="nazwa">Nazwisko:</span> '.mysql_result($sql_result, $i, 2).'</h3><br />';
					$zawartosc .= '<span id="nazwa">Imie:</span>  '.mysql_result($sql_result, $i, 1).'<br />';
					$zawartosc .= '<span id="nazwa">Kraj:</span>  '.mysql_result($sql_result, $i, 3).'<br />';
					$zawartosc .= '<span id="nazwa">Data urodzenia:</span>  '.mysql_result($sql_result, $i, 4).'<br />';
					$zawartosc .= '<span id="nazwa">Wzrost:</span>  '.mysql_result($sql_result, $i, 5).'<br />';
					$zawartosc .= '<span id="nazwa">Pozycja:</span>  '.mysql_result($sql_result, $i, 6).'<br />';
					$zawartosc .= '<span id="nazwa">Numer koszulki:</span>  '.mysql_result($sql_result, $i, 7).'<br />';
					if(mysql_result($sql_result,$i,8)==1)
					{
						$zawartosc .= '<form method="get" action="kontrakty.php" >';
							$zawartosc .= '<input type="hidden" name="id_zawodnika" value="'.mysql_result($sql_result, $i, 0).'" />';
							$zawartosc .= '<span id="nazwa"><input type="submit" name="kontrakt" value="Kontrakt" class="buttonk" /></span>Tak<br />';
						$zawartosc .= '</form>';
					}
					else
					{
						$zawartosc .= '<span id="nazwa">Kontrakt</span> Nie<br />';
					}
					$zawartosc .='<form method="get" action="zawodnik.php" id="" name="UsunLige">';
					$zawartosc .='<input type="hidden" name="usun" value="'.mysql_result($sql_result, $i, 0).'" />';
					$zawartosc .='<input type="hidden" name="druzyna1" value="'.$druzyna.'" />';
					$zawartosc .='<input type="submit"  id="button" value="Usuń" />';
					$zawartosc .='</form>';
			
				$zawartosc .= '<hr></div>';
			}
			$zawartosc .= $this->dodajZawodnika();
			return $zawartosc;
		}
		
		public function setDruzyna($sql_result)
		{
			$zawartosc = "<h3>Wybierz Zespół z którego zostaną wyświetleni zawodnicy:</h3><br />";
			$zawartosc .= '<form method="get" action="zawodnik.php">';
			for($i=0;$i < mysql_num_rows($sql_result); $i++)
			{
				$zawartosc .= '<input type="submit" name="druzyna" id="button" value=" '.mysql_result($sql_result,$i,0).'. '.mysql_result($sql_result,$i,1).'" /><br />';
			}
			$zawartosc .='</form>'; 
			$zawartosc .= $this->dodajZawodnika();
			return $zawartosc;
		}
		
		public function setLiga($sql_result)
		{
			$zawartosc = "<h3>Wybierz Lige z której zostaną wyświetleni zawodnicy:</h3><br />";
			$zawartosc .= '<form method="get" action="zawodnik.php">';

			for($i=0;$i < mysql_num_rows($sql_result); $i++)
			{
				$zawartosc .= '<input type="submit" name="liga" id="button" value="'.mysql_result($sql_result,$i).'" /><br />';
			}
			$zawartosc .='</form>'; 
			$zawartosc .= $this->dodajZawodnika();
			return $zawartosc;
		}

		public function setKraj($sql_result)
		{
			$zawartosc = "<h3>Wybierz Kraj z którego zostaną wyświetleni zawodnicy:</h3><br />";
			$zawartosc .= '<form method="get" action="zawodnik.php">';

			for($i=0;$i < mysql_num_rows($sql_result); $i++)
			{
				$zawartosc .= '<input type="submit" name="kraj"  id="button" value="'.mysql_result($sql_result,$i).'" /><br />';
			}
			$zawartosc .='</form>'; 
			$zawartosc .= $this->dodajZawodnika();
			return $zawartosc;
		}
		
		public function dodajZawodnika()
		{
			$sql_query = "select Nazwa from druzyna;";
			$sql_result=$this->select($sql_query);
			$zawartosc = '<form method="get" action="zawodnik.php" id="test" name="test">';

				$zawartosc .= '<table id="dodajLige">';
					$zawartosc .= "<tr id=\"dodaj\"><td><h3>Dodaj zespół: </h3></td></tr>"; 
					$zawartosc .='<tr>';
						$zawartosc .='<td>Imie: </td>';
						$zawartosc .='<td><input type="text" name="Imie" value="" size="30" /></td>';
					$zawartosc .='</tr>';
					$zawartosc .='<tr>';
						$zawartosc .='<td>Nazwisko: </td>';
						$zawartosc .='<td><input type="text" name="Nazwisko" value="" size="30" /></td>';
					$zawartosc .='</tr>';
					$zawartosc .='<tr>';
						$zawartosc .='<td>Kraj: </td>';
						$zawartosc .='<td><input type="text" name="Kraj" value="" size="30" /></td>';
					$zawartosc .='</tr>';
					$zawartosc .='<tr>';
						$zawartosc .='<td>Data ur.(RRRR-MM-DD): </td>';
						$zawartosc .='<td><input type="text" name="Data_ur" value="" size="30" /></td>';
					$zawartosc .='</tr>';
					$zawartosc .='<tr>';
						$zawartosc .='<td>Wzrost: </td>';
						$zawartosc .='<td><input type="text" name="Wzrost" value="" size="30" /></td>';
					$zawartosc .='</tr>';
					$zawartosc .='<tr>';
						$zawartosc .='<td>Pozycja: </td>';
						$zawartosc .='<td><input type="text" name="Pozycja" value="" size="30" /></td>';
					$zawartosc .='</tr>';
					$zawartosc .='<tr>';
						$zawartosc .='<td>Nr koszulki: </td>';
						$zawartosc .='<td><input type="text" name="Nr_koszulki" value="" size="30" /></td>';
					$zawartosc .='</tr>';
					$zawartosc .='<tr>';
						$zawartosc .='<td>Kontrakt: </td>';
						$zawartosc .='<td><input type="checkbox" name="Kontrakt" value=""  /></td>';
					$zawartosc .='</tr>';
					$zawartosc .='<tr>';
						$zawartosc .='<td>Zespol: </td>';
						$zawartosc .='<td><select name="Zespol">';
						for($i=0;$i<mysql_num_rows($sql_result); $i++)
						{
							$zawartosc .='<option>'.mysql_result($sql_result,$i).'</option>';
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
	
		
	$zawodnik = new Zawodnik();
	$zawodnik->naglowek="zawodnicy";
	$zawodnik->polaczZBaza();
	if(isset($_GET['Imie']) && isset($_GET['Nazwisko']) && isset($_GET['Pozycja']) && isset($_GET['Kraj']) && isset($_GET['Data_ur']) && isset($_GET['Nr_koszulki']) && isset($_GET['Zespol']) )
	{
		if($_GET['Imie']=="" || $_GET['Nazwisko']=="" || $_GET['Pozycja']=="" || $_GET['Kraj']=="" || $_GET['Data_ur']=="" || $_GET['Nr_koszulki']=="" || $_GET['Zespol']=="")
		{
			$zawodnik->zawartosc ="<h3 align='center'>Niepoprawne dane!</h3>";
		}
		else
		{
			$imie = $_GET['Imie'];
			$nazwisko = $_GET['Nazwisko'];
			$kraj = $_GET['Kraj'];
			$data_ur = $_GET['Data_ur'];
			$pozycja = $_GET['Pozycja'];
			$wzrost = (double)$_GET['Wzrost'];
			$nr_koszulki = $_GET['Nr_koszulki'];
			$zespol = $_GET['Zespol'];
			if(isset($_GET['Kontrakt']))
			{	
				$kontrakt = 1;
			}
			else 
			{
				$kontrakt = 0;
			}
			$zawodnik->zapytanie = "select ID_druzyny from druzyna where Nazwa = '".$zespol."';";
			$wynikZapytnia=$zawodnik->select($zawodnik->zapytanie);
			$i=0;
			$id_zespolu = mysql_result($wynikZapytnia, $i);
			
			$zawodnik->zapytanie = "insert into zawodnik values ('','".$imie."','".$nazwisko."', '".$kraj."', '".$data_ur."', '".$wzrost."', '".$pozycja."', '".$nr_koszulki."', '".$kontrakt."', '".$id_zespolu."')";
			$wynikZapytania = $zawodnik->select($zawodnik->zapytanie);
			$zawodnik->zapytanie = "select * from zawodnik where ID_druzyny = '".$id_zespolu."'";
			$wynikZapytania = $zawodnik->select($zawodnik->zapytanie);
			$zawodnik->zawartosc = $zawodnik->setZawodnik($wynikZapytania, $id_zespolu);
			
		}
	}
	else if(isset($_GET['kraj']))
	{
		$kraj = $_GET['kraj'];
		$zawodnik->zapytanie = 'select Nazwa from liga where Kraj = \''.$kraj.'\';';
		$wynikZapytania = $zawodnik->select($zawodnik->zapytanie);
		$zawodnik->naglowek = 'Zawodnicy';
		$zawodnik->zawartosc = $zawodnik->setLiga($wynikZapytania);
	}
	else if(isset($_GET['liga']))
	{
		$liga = $_GET['liga'];
		$zawodnik->zapytanie = 'select ID_druzyny, Nazwa from druzyna where Nazwa_ligi = \''.$liga.'\';';
		$wynikZapytania = $zawodnik->select($zawodnik->zapytanie);
		$zawodnik->zawartosc = $zawodnik->setDruzyna($wynikZapytania);
	}
	else if(isset($_GET['usun']))
	{
		$usun = $_GET['usun'];
		$druzyna = $_GET['druzyna1'];
		$zawodnik->naglowek = "Zawodnicy";
		$zawodnik->zapytanie = "delete from zawodnik where ID_zawodnik = '".$usun."';";
		$wynikZapytania = $zawodnik->select($zawodnik->zapytanie);
		if(!$wynikZapytania)
		{
			if(mysql_errno()==1451)
				$zawodnik->zawartosc = 'Nie można usunąć elementu który ma jakieś zależności pomiędzy innymi tabelami';
		}
		else
		{
			$zawodnik->zapytanie = "select * from zawodnik where ID_druzyny = '".$druzyna."'";
			$wynikZapytania = $zawodnik->select($zawodnik->zapytanie);
			$zawodnik->zawartosc = $zawodnik->setZawodnik($wynikZapytania, $druzyna);
		}
	}
	else if(isset($_GET['druzyna']))
	{
		$druzyna = $_GET['druzyna'];
		$druzyna = $zawodnik->valueBetweenStrings($druzyna, ' ', '.');
		$zawodnik->zapytanie = "select * from zawodnik where ID_druzyny = '".$druzyna."'";
		$wynikZapytania = $zawodnik->select($zawodnik->zapytanie);
		$zawodnik->zawartosc = $zawodnik->setZawodnik($wynikZapytania, $druzyna);
	}
	else
	{
		$zawodnik->zapytanie = "SELECT Kraj FROM liga group by Kraj;";
		$wynikZapytania = $zawodnik->select($zawodnik->zapytanie);
		$zawodnik->zawartosc = $zawodnik->setKraj($wynikZapytania);
	}
	
	
	$zawodnik->wyswietlStrone();
	$zawodnik->zamknijBaze($zawodnik->db);
	unset($zawodnik);
?>
