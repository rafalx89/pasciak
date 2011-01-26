<?php
include('strona.inc');
$sciezka = dirname(__FILE__);

	class Zespoly extends Baza
	{
		public function getZespoly($sql_result, $liga, $sciezka)
		{
                        $zawartosc = "";
			for($i=0;$i<mysql_num_rows($sql_result); $i++)
			{
				//$tabelka .='<tr>';
				$zawartosc .= '<div  class="wyswietl">';
				for($j=0; $j<mysql_num_fields($sql_result);$j++)
				{
					if($j==0)
                                        {
                                                $result = mysql_result($sql_result, $i, 6);

                                                $result = substr($result, 1);

                                                $zawartosc .= '<img src="'.$result.'" alt="herb" class = "herb" />';
						$zawartosc .= '<h3><span id="nazwa">Nazwa:</span>  '.mysql_result($sql_result, $i, $j+1).'</h3>';
						$zawartosc .= '<span id="nazwa">ID:</span>  '.mysql_result($sql_result, $i, $j).'<br />';
					}
					else if($j==2)
					{
						$zawartosc .= '<span id="nazwa">Kapitan:</span>  '.mysql_result($sql_result, $i, $j).'<br />';
					}
					else if($j==3)
					{
						$zawartosc .= '<span id="nazwa">Trener:</span>  '.mysql_result($sql_result, $i, $j).'<br />';
					}
					else if($j==4)
					{
						$zawartosc .= '<span id="nazwa">Nazwa Ligi:</span>  '.mysql_result($sql_result, $i, $j).'<br />';
					}
					else if($j==5)
					{
						$zawartosc .= '<span id="nazwa">Klub:</span>  '.mysql_result($sql_result, $i, $j).'<br />';
					}
					
				}
				$zawartosc .='<form method="get" action="zespoly.php" id="" name="UsunZespol">';
				$zawartosc .='<input type="hidden" name="usunZespol" value="'.mysql_result($sql_result, $i, 0).'" />';
				$zawartosc .='<input type="hidden" name="liga" value="'.$liga.'" />';
				$zawartosc .='<input type="submit"  id="button" value="Usuń" />';
				$zawartosc .='</form>';
				$zawartosc .= '<hr></div>';
				
			}
			$zawartosc .=$this->dodajZespol($liga);
			return $zawartosc;
		}
		public function setLiga($sql_result)
		{
			$zawartosc = "<h3>Wybierz Lige z której zostaną wyświetlone zespoły:</h3><br />";
			$zawartosc .= '<form method="get" action="zespoly.php">';

			for($i=0;$i < mysql_num_rows($sql_result); $i++)
			{
				$zawartosc .= '<input type="submit" name="liga" id="button" value="'.mysql_result($sql_result,$i).'" /><br />';
			}
			$zawartosc .='</form>'; 
			return $zawartosc;
		}

		public function setKraj($sql_result)
		{
			$zawartosc = "<h3>Wybierz Kraj z którego zostaną wyświetlone zespoły:</h3><br />";
			$zawartosc .= '<form method="get" action="zespoly.php">';



			for($i=0;$i < mysql_num_rows($sql_result); $i++)
			{
				$zawartosc .= '<input type="submit" name="kraj"  id="button" value="'.mysql_result($sql_result,$i).'" /><br />';
			}
			$zawartosc .='</form>'; 
			return $zawartosc;
		}
		
		public function dodajZespol($liga)
		{
			$sql_query = "select Nazwa from klub;";
			$sql_result=$this->select($sql_query);
			$zawartosc = '<form method="get" action="zespoly.php" id="test" name="test">';

				$zawartosc .= '<table id="dodajLige">';
					$zawartosc .= "<tr id=\"dodaj\"><td><h3>Dodaj zespół: </h3></td></tr>"; 
					$zawartosc .='<tr>';
						$zawartosc .='<td>Nazwa: </td>';
						$zawartosc .='<td><input type="text" name="Nazwa" value="" size="30" /></td>';
					$zawartosc .='</tr>';
					$zawartosc .='<tr>';
						$zawartosc .='<td>Kapitan: </td>';
						$zawartosc .='<td><input type="text" name="Kapitan" value="" size="30" /></td>';
					$zawartosc .='</tr>';
					$zawartosc .='<tr>';
						$zawartosc .='<td>Trener: </td>';
						$zawartosc .='<td><input type="text" name="Trener" value="" size="30" /></td>';
					$zawartosc .='</tr>';
					$zawartosc .='<tr>';
						$zawartosc .='<td>Nazwa klubu: </td>';
						$zawartosc .='<td><select name="Nazwa_klubu">';
						for($i=0;$i<mysql_num_rows($sql_result); $i++)
						{
							$zawartosc .='<option>'.mysql_result($sql_result,$i).'</option>';
						}
					$zawartosc .='</select></td></tr>';
					
						$zawartosc .='<td><input type="hidden" name="Nazwa_ligi" value="'.$liga.'" size="30" /></td>';
					$zawartosc .='<tr>';
						$zawartosc .='<td><input type="submit" name="dodaj" value="Zatwierdz" /></td>';
					$zawartosc .='</tr>';
				$zawartosc .='</table>';
			$zawartosc .='</form>';
			return $zawartosc;
		}
	}
	$zespoly= new Zespoly();
	$zespoly->polaczZBaza();
	$zespoly->naglowek = 'zespoly';
	if(isset($_GET['Nazwa']) && isset($_GET['Kapitan']) && isset($_GET['Trener']) && isset($_GET['Nazwa_klubu']) )
	{
		if($_GET['Nazwa']=="" || $_GET['Kapitan']=="" || $_GET['Trener']=="" || $_GET['Nazwa_klubu']=="")
		{
			$zespoly->zawartosc ="<h3 align='center'>Niepoprawne dane!</h3>";
		}
		else
		{
			$nazwa = $_GET['Nazwa'];
			$kapitan = $_GET['Kapitan'];
			$trener = $_GET['Trener'];
			$nazwa_ligi = $_GET['Nazwa_ligi'];
			$nazwa_klubu = $_GET['Nazwa_klubu'];
			$zespoly->zapytanie = "insert into druzyna values ('','".$nazwa."','".$kapitan."', '".$trener."', '".$nazwa_ligi."', '".$nazwa_klubu."')";
			$wynikZapytania = $zespoly->select($zespoly->zapytanie);
			$zespoly->zapytanie = 'select * from druzyna where Nazwa_ligi = \''.$nazwa_ligi.'\';';
			$wynikZapytania = $zespoly->select($zespoly->zapytanie);
			$zespoly->zawartosc = $zespoly->getZespoly($wynikZapytania, $nazwa_ligi, $sciezka);
		}
	}
	else if(isset($_GET['kraj']))
	{
		$kraj = $_GET['kraj'];
		$zespoly->zapytanie = 'select Nazwa from liga where Kraj = \''.$kraj.'\';';
		$wynikZapytania = $zespoly->select($zespoly->zapytanie);
		$zespoly->zawartosc = $zespoly->setLiga($wynikZapytania);
	}
	else if(isset($_GET['liga']) && !isset($_GET['usunZespol']))
	{
		$liga = $_GET['liga'];
		$zespoly->zapytanie = 'select * from druzyna where Nazwa_ligi = \''.$liga.'\';';
		$wynikZapytania = $zespoly->select($zespoly->zapytanie);
		$zespoly->zawartosc = $zespoly->getZespoly($wynikZapytania, $liga, $sciezka);
	}
	else if(isset($_GET['usunZespol']))
	{
		$usun= $_GET['usunZespol'];
		$liga = $_GET['liga'];
		$zespoly->zapytanie = 'delete from druzyna where ID_druzyny = \''.$usun.'\'';
		$wynikZapytania = $zespoly->select($zespoly->zapytanie);
		if(!$wynikZapytania)
		{
			if(mysql_errno()==1451)
				$zespoly->zawartosc = 'Nie można usunąć elementu który ma jakieś zależności pomiędzy innymi tabelami';
		}
		else
		{
			$zespoly->zapytanie = 'select * from druzyna where Nazwa_ligi = \''.$liga.'\';';
			$wynikZapytania = $zespoly->select($zespoly->zapytanie);
			$zespoly->zawartosc = $zespoly->getZespoly($wynikZapytania, $liga, $sciezka);
		}
	}
	else
	{
		$zespoly->zapytanie = "SELECT Kraj FROM liga group by Kraj;";
		$wynikZapytania = $zespoly->select($zespoly->zapytanie);
		$zespoly->zawartosc = $zespoly->setKraj($wynikZapytania);
	}
	$zespoly->wyswietlStrone();
	$zespoly->zamknijBaze($zespoly->db);
	
?>
