<?php
	include('strona.inc');
	class Szukaj extends Baza
	{
		public function szukajKlub() 
		{	
			$zawartosc = '<form method="get" action="szukaj.php" id="test" name="test">';
				
				$zawartosc .= '<table id="dodajLige">';
					$zawartosc .='<tr>';
						$zawartosc .='<td>Podaj nazwe Klubu </td>';
						$zawartosc .='<td><input type="text" name="SzukajKlub"  size="30" /></td>';
					$zawartosc .='</tr>';
					$zawartosc .='<tr>';
						$zawartosc .='<td><input type="submit" name="zatwierdz" value="Zatwierdz" /></td>';
					$zawartosc .='</tr>';
				$zawartosc .='</table>';
			$zawartosc .='</form>';
			return $zawartosc;
		
		}
		
		public function szukajLigi() 
		{	
			$zawartosc = '<form method="get" action="szukaj.php" id="test" name="test">';

				$zawartosc .= '<table id="dodajLige">';
					$zawartosc .='<tr>';
						$zawartosc .='<td>Podaj nazwe Ligi</td>';
						$zawartosc .='<td><input type="text" name="SzukajLigi" value="" size="30" /></td>';
					$zawartosc .='</tr>';
					$zawartosc .='<tr>';
						$zawartosc .='<td><input type="submit" name="zatwierdz" value="Zatwierdz" /></td>';
					$zawartosc .='</tr>';
				$zawartosc .='</table>';
			$zawartosc .='</form>';
			return $zawartosc;
		}

		public function szukajZawodnika() 
		{	
			$zawartosc = '<form method="get" action="szukaj.php" id="test" name="test">';

				$zawartosc .= '<table id="dodajLige">';
					$zawartosc .='<tr>';
						$zawartosc .='<td>Podaj nazwisko lub imie zawodnika lub oba razem </td>';
						$zawartosc .='<td><input type="text" name="SzukajZawodnika" value="" size="30" /></td>';
					$zawartosc .='</tr>';
					$zawartosc .='<tr>';
						$zawartosc .='<td><input type="submit" name="zatwierdz" value="Zatwierdz" /></td>';
					$zawartosc .='</tr>';
				$zawartosc .='</table>';
			$zawartosc .='</form>';
			return $zawartosc;
		}

		public function szukajDruzyny() 
		{	
			$zawartosc = '<form method="get" action="szukaj.php" id="test" name="test">';

				$zawartosc .= '<table id="dodajLige">';
					$zawartosc .='<tr>';
						$zawartosc .='<td>Podaj nazwe Druzyny </td>';
						$zawartosc .='<td><input type="text" name="SzukajDruzyny" value="" size="30" /></td>';
					$zawartosc .='</tr>';
					$zawartosc .='<tr>';
						$zawartosc .='<td><input type="submit" name="zatwierdz" value="Zatwierdz" /></td>';
					$zawartosc .='</tr>';
				$zawartosc .='</table>';
			$zawartosc .='</form>';
			return $zawartosc;
		}
		
		public function kluby($sql_result)
		{
			$zawartosc = "";
			for($i=0;$i<mysql_num_rows($sql_result); $i++)
			{
				$zawartosc .= '<div id="klub" class="test">';
				for($j=0; $j<mysql_num_fields($sql_result);$j++)
				{
					if($j==0)
					{ 
						$zawartosc .= '<h3><span id="nazwa">Nazwa:</span> '.mysql_result($sql_result, $i, $j).'</h3><br />';
					}
					else 
					{
						$zawartosc .= '<span id="nazwa">'.mysql_field_name($sql_result, $j).':</span>  '.mysql_result($sql_result, $i, $j).'<br />';
					}
					
				}
				$zawartosc .= '</div>';
			}
			return $zawartosc;
		}
		public function liga($sql_result)
		{
			for($i=0; $i<mysql_num_rows($sql_result);$i++)
			{
				$zawartosc .= '<div id="liga" class="test">';
				for($j=0; $j<mysql_num_fields($sql_result);$j++)
				{
					if($j==0)
					{ 
						$zawartosc .= '<h3><span id="nazwa">Liga:</span> '.mysql_result($sql_result, $i, $j).'</h3><br />';
					}
					else if($j==1)
					{
						$zawartosc .= '<span id="nazwa">Kraj:</span>  '.mysql_result($sql_result, $i, $j).'<br />';
					}
					else
					{
						$zawartosc .= '<span id="nazwa">Ilość drużyn:</span>  '.mysql_result($sql_result, $i, $j).'<br />';
					}

				}
				$zawartosc .= '</div>';
			}
			return $zawartosc;
		}
		public function zespol($sql_result)
		{
			for($i=0;$i<mysql_num_rows($sql_result); $i++)
			{
				$zawartosc .= '<div id="zespoly" class="test">';
				for($j=0; $j<mysql_num_fields($sql_result);$j++)
				{
					if($j==0)
					{
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
				$zawartosc .= '</div>';
			}
			return $zawartosc;
		}
		public function zawodnik($sql_result)
		{
			for($i=0;$i<mysql_num_rows($sql_result); $i++)
			{
				$zawartosc .= '<div id="klub" class="test">';

					$zawartosc .= '<h3><span id="nazwa">Nazwisko:</span> '.mysql_result($sql_result, $i, 2).'</h3><br />';
					$zawartosc .= '<span id="nazwa">Imie:</span>  '.mysql_result($sql_result, $i, 1).'<br />';
					$zawartosc .= '<span id="nazwa">Kraj:</span>  '.mysql_result($sql_result, $i, 3).'<br />';
					$zawartosc .= '<span id="nazwa">Data urodzenia:</span>  '.mysql_result($sql_result, $i, 4).'<br />';
					$zawartosc .= '<span id="nazwa">Wzrost:</span>  '.mysql_result($sql_result, $i, 5).'<br />';
					$zawartosc .= '<span id="nazwa">Pozycja:</span>  '.mysql_result($sql_result, $i, 6).'<br />';
					$zawartosc .= '<span id="nazwa">Numer koszulki:</span>  '.mysql_result($sql_result, $i, 7).'<br />';
					if(mysql_result($sql_result,$i,8)==1)
					{
						$zawartosc .= '<span id="nazwa">Kontrakt:</span>Tak<br />';
					}
					else
					{
						$zawartosc .= '<span id="nazwa">Kontrakt</span> Nie<br />';
					}
					$zawartosc .='</form>';

				$zawartosc .= '</div>';
			}
			return $zawartosc;
		}

	}


	$szukaj = new Szukaj();
	$szukaj->polaczZBaza();
	$szukaj->naglowek = "szukaj";
	if(isset($_GET['SzukajKlub']))
	{
			$szukajKlub = $_GET['SzukajKlub'];
			$szukaj->zapytanie = "select * from klub where Nazwa ='".$szukajKlub."' ;";
			$wynikZapytania = $szukaj->select($szukaj->zapytanie);
			if(!$wynikZapytania)
			{
				$szukaj->zawartosc = 'Nie znaleziono';
			}
			else
			{
				$szukaj->zawartosc = $szukaj->kluby($wynikZapytania);
				if($szukaj->zawartosc == '')
					$szukaj->zawartosc ="Nie znaleziono";
			}
	}
	else if(isset($_GET['SzukajLigi']))
	{
			$szukajLigi = $_GET['SzukajLigi'];
			$szukaj->zapytanie = "select * from liga where Nazwa ='".$szukajLigi."' ;";
			$wynikZapytania = $szukaj->select($szukaj->zapytanie);
			if(!$wynikZapytania)
			{
				$szukaj->zawartosc = 'Nie znaleziono';
			}
			else
			{
				$szukaj->zawartosc = $szukaj->liga($wynikZapytania);
				if($szukaj->zawartosc == '')
					$szukaj->zawartosc ="Nie znaleziono";
			}
	}
	else if(isset($_GET['SzukajDruzyny']))
	{
			$szukajDruzyna = $_GET['SzukajDruzyny'];
			$szukaj->zapytanie = "select * from druzyna where Nazwa ='".$szukajDruzyna."' ;";
			$wynikZapytania = $szukaj->select($szukaj->zapytanie);
			if(!$wynikZapytania)
			{
				$szukaj->zawartosc = 'Nie znaleziono';
			}
			else
			{
				$szukaj->zawartosc = $szukaj->zespol($wynikZapytania);
				if($szukaj->zawartosc == '')
					$szukaj->zawartosc ="Nie znaleziono";
			}
	}
	else if(isset($_GET['SzukajZawodnika']))
	{
			$szukajZawodnika = $_GET['SzukajZawodnika'];
			$szukajZawodnika = str_replace(chr(32), '.',$szukajZawodnika);
			$szukajZawodnika = explode('.', $szukajZawodnika);
			$szukaj->zapytanie = "select * from zawodnik where Nazwisko ='".$szukajZawodnika[0]."' || Nazwisko ='".$szukajZawodnika[1]."' || Imie ='".$szukajZawodnika[0]."' || Imie ='".$szukajZawodnika[1]."' ;";
			$wynikZapytania = $szukaj->select($szukaj->zapytanie);
			if(!$wynikZapytania)
			{
				$szukaj->zawartosc = 'Nie znaleziono';
			}
			else
			{
				$szukaj->zawartosc = $szukaj->zawodnik($wynikZapytania);
				if($szukaj->zawartosc == '')
					$szukaj->zawartosc ="Nie znaleziono";
			}
	}
	else if(isset($_GET['szukaj']))
	{
		$wyszukaj = $_GET['szukaj'];
		if($wyszukaj=="Liga")
		{
			$szukaj->zawartosc = '<br />'.$szukaj->szukajLigi().'';
		}
		else if($wyszukaj=="Klub")
		{
			$szukaj->zawartosc = '<br />'.$szukaj->szukajKlub().'';
		}
		else if($wyszukaj=="Zawodnik")
		{
			$szukaj->zawartosc = '<br />'.$szukaj->szukajZawodnika().'';
		}
		else if($wyszukaj=="Druzyna")
		{
			$szukaj->zawartosc = '<br />'.$szukaj->szukajDruzyny().'';
		}
	}
	else
	{			$zawartosc .="<p>Co chcesz wyszukać?</p> <br />";
				$zawartosc .='<form method="get" action="szukaj.php" id="" name="Szukaj">';
				$zawartosc .='<input type="submit" name="szukaj"  id="button" value="Liga" />';
				$zawartosc .='<input type="submit" name="szukaj"  id="button" value="Klub" />';
				$zawartosc .='<input type="submit" name="szukaj"  id="button" value="Zawodnik" />';
				$zawartosc .='<input type="submit" name="szukaj"  id="button" value="Druzyna" />';
				$zawartosc .='</form>';
				$szukaj->zawartosc = $zawartosc;
	}
	$szukaj->wyswietlStrone();
	$szukaj->zamknijBaze($szukaj->db);
	unset($szukaj);

?>