<?php

	include('strona.inc');
	
	class Strzelcy extends Baza 
	{
		
		public function setLiga($sql_result)
		{
			$zawartosc = "<h3>Wybierz Lige z której zostaną wyświetleni strzelcy:</h3><br />";
			$zawartosc .= '<form method="get" action="strzelcy.php">';

			for($i=0;$i < mysql_num_rows($sql_result); $i++)
			{
				$zawartosc .= '<input type="submit" name="liga" id="button" value="'.mysql_result($sql_result,$i).'" /><br />';
			}
			$zawartosc .='</form>'; 
			return $zawartosc;
		}

		public function setKraj($sql_result)
		{
			$zawartosc = "<h3>Wybierz Kraj z którego zostaną wyświetleni strzelcy:</h3><br />";
			$zawartosc .= '<form method="get" action="strzelcy.php">';
			for($i=0;$i < mysql_num_rows($sql_result); $i++)
			{
				$zawartosc .= '<input type="submit" name="kraj"  id="button" value="'.mysql_result($sql_result,$i).'" /><br />';
			}
			$zawartosc .='</form>'; 
			return $zawartosc;
                }
                public function setSezon($sql_result, $liga)
                {
                        $zawartosc = "<h3>Wybierz Sezon z którego zostaną wyświetleni strzelcy:</h3><br />";
                        $zawartosc .= '<form method="get" action="strzelcy.php">';
                        for($i=0;$i < mysql_num_rows($sql_result); $i++)
                        {
                            $zawartosc .= '<input type="hidden" name="liga1" value="'.$liga.'" /><br />';
                            $zawartosc .= '<input type="submit" name="sezon" id="button" value="Sezon: '.mysql_result($sql_result,$i, 0).'. Rok: '.mysql_result($sql_result,$i, 1).'" /><br />';
                        }
                        $zawartosc .='</form>'; 
                        return $zawartosc;
                }

	}

	
		
	$strzelcy = new Strzelcy();
	$strzelcy->naglowek = 'strzelcy';
	$strzelcy->polaczZBaza();
	if(isset($_GET['kraj']))
	{
		$kraj = $_GET['kraj'];
		$strzelcy->zapytanie = 'select Nazwa from liga where Kraj = \''.$kraj.'\';';
		$wynikZapytania = $strzelcy->select($strzelcy->zapytanie);
		$strzelcy->zawartosc = $strzelcy->setLiga($wynikZapytania);
	}
	else if(isset($_GET['liga']))
        {
                $liga = $_GET['liga'];
                $strzelcy->zapytanie = 'select ID_sezonu, Rok_rozpoczecia_rozgrywek from sezon where Nazwa_ligi = \''.$liga.'\';';
                $wynikZapytania = $strzelcy->select($strzelcy->zapytanie);
                $strzelcy->zawartosc = $strzelcy->setSezon($wynikZapytania, $liga);
	    	
        }
        else if(isset($_GET['sezon']))
        {
                $sezon = $_GET['sezon'];
                $liga = $_GET['liga1'];
                $sezon = $strzelcy->valueBetweenStrings($sezon, ' ', '.');
                $strzelcy->zawartosc = "Strona w budowie";

                
        }

	else
	{
		$strzelcy->zapytanie = "SELECT Kraj FROM liga group by Kraj;";
		$wynikZapytania = $strzelcy->select($strzelcy->zapytanie);
		$strzelcy->zawartosc = $strzelcy->setKraj($wynikZapytania);
	}
	


	$strzelcy->wyswietlStrone();
	$strzelcy->zamknijBaze($strzelcy->db);
	unset($strzelcy);

?>
