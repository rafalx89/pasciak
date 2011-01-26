<?php

	include('strona.inc');
	
	class Mecz extends Baza
	{
	
		public function setKraj($sql_result)
		{
			$zawartosc = "<h3>Wybierz Kraj z którego zostaną wyświetlone mecze:</h3><br />";
			$zawartosc .= '<form method="get" action="mecze.php">';

			for($i=0;$i < mysql_num_rows($sql_result); $i++)
			{
				$zawartosc .= '<input type="submit" name="kraj"  id="button" value="'.mysql_result($sql_result,$i).'" /><br />';
			}
			$zawartosc .='</form>'; 
			return $zawartosc;
		}
		public function setLiga($sql_result)
		{
			$zawartosc = "<h3>Wybierz Lige z której zostaną wyświetlone mecze:</h3><br />";
			$zawartosc .= '<form method="get" action="mecze.php">';

			for($i=0;$i < mysql_num_rows($sql_result); $i++)
			{
				$zawartosc .= '<input type="submit" name="liga" id="button" value="'.mysql_result($sql_result,$i).'" /><br />';
			}
			$zawartosc .='</form>'; 
			return $zawartosc;
		}
		public function setSezon($sql_result, $liga)
		{
			$zawartosc = "<h3>Wybierz Sezon z którego zostaną wyświetlone mecze:</h3><br />";
			$zawartosc .= '<form method="get" action="mecze.php">';
			for($i=0;$i < mysql_num_rows($sql_result); $i++)
			{
				$zawartosc .= '<input type="hidden" name="liga1" value="'.$liga.'" /><br />';
				$zawartosc .= '<input type="submit" name="sezon" id="button" value="Sezon: '.mysql_result($sql_result,$i, 0).'. Rok: '.mysql_result($sql_result,$i, 1).'" /><br />';

			}
			$zawartosc .='</form>'; 
			return $zawartosc;
		}
		
		public function setMecze($sql_result, $sezon)
		{	
			$zawartosc ='<table id="kolejka">';
				$zawartosc .='<tr>';
					$zawartosc .= '<td id="kolejka2">Nr.</td>';
					$zawartosc .= '<td id="kolejka2">Gospodarz</td>';
					$zawartosc .= '<td id="kolejka2">Gość</td>';
					$zawartosc .= '<td id="kolejka2">Wynik</td>';
                                        $zawartosc .='</tr>';
                                if(mysql_num_rows($sql_result)!=0) 
                                {
                                        $k=mysql_result($sql_result,0, 4);
                                }
			
				$i=0;
				$zapytanie = "select Data_rozegrania from kolejka where Nr_kolejki ='".mysql_result($sql_result,$i, 4)."' and Id_sezonu = '".$sezon."';";
				$wynikZapytania = $this->select($zapytanie);
				
				$zawartosc .='<tr >';
				
						$zawartosc .='<td id="kolejka1" colspan="4" >Kolejka: '.mysql_result($sql_result,0, 4).', '.mysql_result($wynikZapytania, 0).'</td>';
					$zawartosc .='</tr>';
			for($i=0; $i < mysql_num_rows($sql_result); $i++)
			{
				if($k < mysql_result($sql_result,$i, 4))
				{
					$zawartosc .='<tr >';
					$zapytanie = "select Data_rozegrania from kolejka where Nr_kolejki ='".mysql_result($sql_result,$i, 4)."' and Id_sezonu = '".$sezon."';";
					$wynikZapytania = $this->select($zapytanie);
						$zawartosc .='<td id="kolejka1" colspan="4">Kolejka: '.mysql_result($sql_result,$i, 4).', '.mysql_result($wynikZapytania, 0).'</td>';
					$zawartosc .='</tr>';
					$k = mysql_result($sql_result,$i, 4);
				}
				$zawartosc .= '<tr>';
					$zawartosc .= '<td id="kolejka">'.($i+1).'</td>';
					$zawartosc .= '<td id="kolejka">'.mysql_result($sql_result,$i, 0).'</td>';
					$zawartosc .= '<td id="kolejka">'.mysql_result($sql_result,$i, 1).'</td>';
					$zawartosc .= '<td id="kolejka">'.mysql_result($sql_result,$i, 2).' - '.mysql_result($sql_result,$i, 3).'</td>';
				$zawartosc .= '</tr>';
			}
			$zawartosc .='</table>';
			return $zawartosc;
		}
	}

	$mecz = new Mecz();
	$mecz->naglowek = 'mecze';
	$mecz->polaczZBaza();
	
	if(isset($_GET['kraj']))
	{
		$kraj = $_GET['kraj'];
		$mecz->zapytanie = 'select Nazwa from liga where Kraj = \''.$kraj.'\';';
		$wynikZapytania = $mecz->select($mecz->zapytanie);
		$mecz->zawartosc = $mecz->setLiga($wynikZapytania);
	}
	else if(isset($_GET['liga']))
	{
		$liga = $_GET['liga'];
		$mecz->zapytanie = 'select ID_sezonu, Rok_rozpoczecia_rozgrywek from sezon where Nazwa_ligi = \''.$liga.'\';';
		$wynikZapytania = $mecz->select($mecz->zapytanie);
		$mecz->zawartosc = $mecz->setSezon($wynikZapytania, $liga);
	}
	else if(isset($_GET['sezon']))
	{
		$sezon = $_GET['sezon'];
		$liga = $_GET['liga1'];
		$sezon = $mecz->valueBetweenStrings($sezon, ' ', '.');
		$mecz->zapytanie = "select (select Nazwa from druzyna where ID_druzyny = ID_druzyny1) as Gospodarz, 
(select Nazwa from druzyna where ID_druzyny = ID_druzyny2) as 
Gosc,Wynik_druzyny_domowej, Wynik_druzyny_przyjezdnej, Nr_kolejki  from mecze m join 
sezon s where m.Nr_kolejki in (select Nr_kolejki from kolejka where
Id_sezonu = '".$sezon."') && s.Id_sezonu = '".$sezon."' && m.ID_druzyny1 in (select Id_druzyny from 
druzyna where Nazwa_ligi = '".$liga."') && m.ID_druzyny2 in (select Id_druzyny from 
druzyna where Nazwa_ligi = '".$liga."') order by m.Nr_kolejki;";
		$wynikZapytania = $mecz->select($mecz->zapytanie);
		$mecz->zawartosc = $mecz->setMecze($wynikZapytania, $sezon);
		
	}
	else
	{
		$mecz->zapytanie = "SELECT Kraj FROM liga group by Kraj;";
		$wynikZapytania = $mecz->select($mecz->zapytanie);
		$mecz->zawartosc = $mecz->setKraj($wynikZapytania);
	}
	$mecz->wyswietlStrone();
	$mecz->zamknijBaze($mecz->db);
	unset($mecz);
?>
