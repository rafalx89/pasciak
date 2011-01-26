<?php
	include('strona.inc');
	$strona = new Strona();
	$strona->naglowek = "baner_glowny";
	$strona->zawartosc =  "To jest główna.";
	$strona->wyswietlStrone();
        unset($strona);
?>
