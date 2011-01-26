<?php
	include('strona.inc');
	
	class TabelaLigowa extends Baza
	{
		public function setTabelaLigowa($sql_result, $sezon, $liga)
		{
			$zawartosc = "<h3>Tabela Ligowa z ligi: ".$liga." i sezonu: ".$sezon."  </h3><br />";
			$zawartosc .="<table id=\"tabela_ligowa\">";
			$zawartosc .="<tr id=\"nazwy_pol\">";
			$zawartosc .="<td id= \"nazwy_pol\">Lp.</td>";
			for ($a=0; $a<mysql_num_fields($sql_result); $a++)
			{
				$zawartosc .= "<td id=\"nazwy_pol\">".mysql_field_name($sql_result ,$a)."</td>";
			}
			$zawartosc .="</tr>";
			for($i=0;$i < mysql_num_rows($sql_result); $i++)
			{
				$zawartosc .= "<tr>";
				$zawartosc .='<td id = "wyniki">'.($i+1).'</td>';
				for($j = 0; $j < mysql_num_fields($sql_result); $j++)
					$zawartosc .= "<td id = \"wyniki\">".mysql_result($sql_result,$i, $j)."</td>"; 
				$zawartosc .= "</tr>";
			} 
			$zawartosc .= "</table>";
			return $zawartosc;
		}
		public function setSezon($sql_result, $liga)
		{
			$zawartosc = "<h3>Wybierz Sezon z którego zostanie wyświetlona tabela ligowa:</h3><br />";
			$zawartosc .= '<form method="get" action="tabele_ligowe.php">';
			for($i=0;$i < mysql_num_rows($sql_result); $i++)
			{
				$zawartosc .= '<input type="hidden" name="liga1" value="'.$liga.'" /><br />';
				$zawartosc .= '<input type="submit" name="sezon" id="button" value="Sezon: '.mysql_result($sql_result,$i, 0).'. Rok: '.mysql_result($sql_result,$i, 1).'" /><br />';
				
			}
			$zawartosc .='</form>'; 
			return $zawartosc;
			
		}
		
		public function setLiga($sql_result)
		{
			$zawartosc = "<h3>Wybierz Lige z której zostaną wyświetlone tabele ligowe:</h3><br />";
			$zawartosc .= '<form method="get" action="tabele_ligowe.php">';

			for($i=0;$i < mysql_num_rows($sql_result); $i++)
			{
				$zawartosc .= '<input type="submit" name="liga" id="button" value="'.mysql_result($sql_result,$i).'" /><br />';
			}
			$zawartosc .='</form>'; 
			return $zawartosc;
		}

		public function setKraj($sql_result)
		{
			$zawartosc = "<h3>Wybierz Kraj z którego zostaną wyświetlone tabele ligowe:</h3><br />";
			$zawartosc .= '<form method="get" action="tabele_ligowe.php">';



			for($i=0;$i < mysql_num_rows($sql_result); $i++)
			{
				$zawartosc .= '<input type="submit" name="kraj"  id="button" value="'.mysql_result($sql_result,$i).'" /><br />';
			}
			$zawartosc .='</form>'; 
			return $zawartosc;
		}
	}
	
	$tabela_ligowa= new TabelaLigowa();
	$tabela_ligowa->polaczZBaza();
	$tabela_ligowa->naglowek = 'tabela';
	if(isset($_GET['kraj']))
	{
		$kraj = $_GET['kraj'];
		$tabela_ligowa->zapytanie = 'select Nazwa from liga where Kraj = \''.$kraj.'\';';
		$wynikZapytania = $tabela_ligowa->select($tabela_ligowa->zapytanie);
		$tabela_ligowa->zawartosc = $tabela_ligowa->setLiga($wynikZapytania);
	}
	else if(isset($_GET['liga']))
	{
		$liga = $_GET['liga'];
		$tabela_ligowa->zapytanie = 'select ID_sezonu, Rok_rozpoczecia_rozgrywek from sezon where Nazwa_ligi = \''.$liga.'\';';
		$wynikZapytania = $tabela_ligowa->select($tabela_ligowa->zapytanie);
		$tabela_ligowa->zawartosc = $tabela_ligowa->setSezon($wynikZapytania, $liga);
	}
	else if (isset($_GET['sezon']))
	{
		
		$liga = $_GET['liga1'];
		$sezon1 = $_GET['sezon'];
		$sezon = trim($tabela_ligowa->valueBetweenStrings($sezon1, 'Sezon:', '. Rok:'));
		$tabela_ligowa->zapytanie = "select c.Nazwa, a.Mecze_wygrane + a.Mecze_zremisowane + 
a.Mecze_przegrane as Mecze, a.Mecze_wygrane as Wygr, 
a.Mecze_zremisowane as Rem, a.Mecze_przegrane as Prz, 
a.Bramki_strzelone as BrStrze , a.Bramki_stracone as BrStra, a.Punkty from 
tabela_ligowa a natural join  druzyna c where 
ID_sezonu = '".$sezon."'
order by a.Pozycja;";
		$wynikZapytania = $tabela_ligowa->select($tabela_ligowa->zapytanie);
		$tabela_ligowa->zawartosc = $tabela_ligowa->setTabelaLigowa($wynikZapytania, $sezon1, $liga);
	}
	else
	{
		$tabela_ligowa->zapytanie = "SELECT Kraj FROM liga group by Kraj;";
		$wynikZapytania = $tabela_ligowa->select($tabela_ligowa->zapytanie);
		$tabela_ligowa->zawartosc = $tabela_ligowa->setKraj($wynikZapytania);
	}
	$tabela_ligowa->wyswietlStrone();
	$tabela_ligowa->zamknijBaze($tabela_ligowa->db);
	unset($tabela_ligowa);
?>
