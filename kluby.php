<?php
	include('strona.inc');
	
	class Klub extends Baza
	{
		public function kluby($sql_result)
		{
			$zawartosc = "";
			for($i=0;$i<mysql_num_rows($sql_result); $i++)
			{
				$zawartosc .= '<div  class="wyswietl">';
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
				$zawartosc .='<form method="get" action="kluby.php" id="" name="UsunKlub">';
				$zawartosc .='<input type="hidden" name="usun" value="'.mysql_result($sql_result, $i, 0).'" />';
				$zawartosc .='<input type="submit"  id="button" value="Usuń" />';
				$zawartosc .='</form>';
				$zawartosc .= '<hr></div>';
			}
			$zawartosc .= $this->dodajKlub();
			return $zawartosc;
		}
		
		public function dodajKlub()
		{
			$zawartosc = '<form method="get" action="kluby.php" id="test" name="test">';

				$zawartosc .= '<table id="dodajLige">';
					$zawartosc .= "<tr id=\"dodaj\"><td><h3>Dodaj Klub: </h3></td></tr>"; 
					$zawartosc .='<tr>';
						$zawartosc .='<td>Nazwa: </td>';
						$zawartosc .='<td><input type="text" name="Klub" value="" size="30" /></td>';
					$zawartosc .='</tr>';
					$zawartosc .='<tr>';
						$zawartosc .='<td>Prezes: </td>';
						$zawartosc .='<td><input type="text" name="Prezes" value="" size="30" /></td>';
					$zawartosc .='</tr>';
					$zawartosc .='<tr>';
						$zawartosc .='<td>Miasto: </td>';
						$zawartosc .='<td><input type="text" name="Miasto" value="" size="30" /></td>';
					$zawartosc .='</tr>';
					$zawartosc .='<tr>';
						$zawartosc .='<td>Ulica: </td>';
						$zawartosc .='<td><input type="text" name="Ulica" value="" size="30" /></td>';
					$zawartosc .='</tr>';
					$zawartosc .='<tr>';
						$zawartosc .='<td>Numer: </td>';
						$zawartosc .='<td><input type="text" name="Numer" value="" size="10" /></td>';
					$zawartosc .='</tr>';
					$zawartosc .='<tr>';
						$zawartosc .='<td>Budzet:  </td>';
						$zawartosc .='<td><input type="text" name="Budzet" value="" size="30" /></td>';
					$zawartosc .='</tr>';
					$zawartosc .='<tr>';
						$zawartosc .='<td><input type="submit" name="dodaj" value="Zatwierdz" /></td>';
					$zawartosc .='</tr>';
				$zawartosc .='</table>';
			$zawartosc .='</form>';
			return $zawartosc;
		}
	}
	
	$klub = new Klub();
	$klub->polaczZBaza();
	$klub->naglowek = "kluby";
	if(isset($_GET['Klub']) &&  isset($_GET['Prezes']) &&  isset($_GET['Miasto'])
		&& isset($_GET['Ulica'])  && isset($_GET['Numer'])  && isset($_GET['Budzet']) )
	{
		if($_GET['Klub']=="" || $_GET['Prezes']=="" || $_GET['Miasto']=="" || $_GET['Ulica']=="" || $_GET['Numer']=="" || $_GET['Budzet']=="")
		{
			$klub->zawartosc = "<h3 align='center'>Niepoprawne dane!</h3>";
		}
		else
		{
			$nazwa = $_GET['Klub'];
			$prezes = $_GET['Prezes'];
			$miasto = $_GET['Miasto'];
			$ulica = $_GET['Ulica'];
			$numer = $_GET['Numer'];
			$budzet = $_GET['Budzet'];
			$klub->zapytanie = "insert into klub values ('".$nazwa."','".$prezes."', '".$miasto."', '".$ulica."', '".$numer."', '".$budzet."')";
			$wynikZapytania = $klub->select($klub->zapytanie);
			$klub->zapytanie = "select * from klub";
			$wynikZapytania = $klub->select($klub->zapytanie);
			
			$klub->zawartosc = $klub->kluby($wynikZapytania);
		}
	}
	else if(isset($_GET['usun']))
	{
		$usun = $_GET['usun'];
		$klub->zapytanie = "delete from klub where Nazwa = '".$usun."';";
		$wynikZapytania = $klub->select($klub->zapytanie);
		if(!$wynikZapytania)
		{
			if(mysql_errno()==1451)
				$klub->zawartosc = 'Nie można usunąć elementu który ma jakieś zależności pomiędzy innymi tabelami';
		}
		else
		{
			$klub->zapytanie = "select * from klub";
			$wynikZapytania = $klub->select($klub->zapytanie);
			$klub->zawartosc = $klub->kluby($wynikZapytania);
		}
		
		

	}
	else
	{
		$klub->zapytanie = "select * from klub";
		$wynikZapytania = $klub->select($klub->zapytanie);
		$klub->zawartosc = $klub->kluby($wynikZapytania);
	}
	$klub->wyswietlStrone();
	$klub->zamknijBaze($klub->db);
	unset($klub);
?>