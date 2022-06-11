<?php

ini_set('display_errors', 0);
error_reporting(E_ALL);

?>

<?xml version="1.0" encoding="ISO-8859-1"?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

    <head>
        <title> aggiunta pianta </title>
    </head>

<body>

<style>

body {
	
	background-color: #696969;
	color: white;

}

</style>

<?php

if ($_POST ['invio'] == "Aggiungi pianta" && $_POST ['nome'] && $_POST ['temperatura'] && $_POST ['substrato'] && $_POST ['clima'] && $_POST ['irrigatura'] && $_POST ['luce']) {
	
	$doc = new DOMDocument();
	if (!$doc->load('piante.xml')) {
	  die ("Error mentre si andava parsando il documento\n");
	}
	
	$root = $doc->documentElement;
	$elementi = $root->childNodes;
	
	$newRecord = $doc->createElement("record");
	$newPianta = $doc->createElement("pianta", $_POST ['nome']);
	$newTemperature = $doc->createElement("temperatura", $_POST ['temperatura']);
	$newSubst = $doc->createElement("substrato", $_POST ['substrato']);
	$newClima = $doc->createElement("clima", $_POST ['clima']);
	$newIrrig = $doc->createElement("irrigatura", $_POST ['irrigatura']);
	$newLuce = $doc->createElement("luce", $_POST ['luce']);
	$newRecord->appendChild($newPianta);
	$newRecord->appendChild($newTemperature);
	$newRecord->appendChild($newSubst);
	$newRecord->appendChild($newClima);
	$newRecord->appendChild($newIrrig);
	$newRecord->appendChild($newLuce);
	
	$root->appendChild($newRecord);
	
	$doc->appendChild($root);
	
	$doc->save('piante.xml');
	
	echo "<h3>Fatto</h3>\n";
	$_POST['invio']="j";
	
}


?>

<form action = "aggiungipiante.php" method = "post">
	
	<p>
	Nome piante <input type = "text" name = "nome" size = "50" />
	</p>
	
	<p>
	Temperatura (seguita da "(Celsius)") <input type = "text" name = "temperatura" size = "50" />
	</p>
	
	<p>
	Substrato <input type = "text" name = "substrato" size = "50" />
	</p>
	
	<p>
	Clima <input type = "text" name = "clima" size = "50" />
	</p>
	
	<p>
	Irrigatura <input type = "text" name = "irrigatura" size = "50" />
	</p>
	
	<p>
	Luce <input type = "text" name = "luce" size = "50" />
	</p>
	
	<p>
	<input type = "submit" name = "invio" value = "Aggiungi pianta" />
	</p>
	
</form>

<?php

if ($_POST ['invio'] == "j")
	echo '<p><a href = "piante.php">Torna alla tabella delle piante</a></p>';

?>

</body>
</html>