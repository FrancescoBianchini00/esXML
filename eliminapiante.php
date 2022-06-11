<?php

ini_set('display_errors', 0);
error_reporting(E_ALL);

?>

<?xml version="1.0" encoding="ISO-8859-1"?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

    <head>
        <title> elimina pianta </title>
    </head>

<body>

<style>

body {
	
	background-color: #696969;
	color: white;

}

</style>

<?php

if ($_POST ['invio'] == "Elimina pianta" && $_POST ['nome']){
	
	$doc = new DOMDocument();
	if (!$doc->load('piante.xml')) {
	  die ("Error mentre si andava parsando il documento\n");
	}
	$root = $doc->documentElement;
	$elementi = $root->childNodes;

	for ($i = 0; $i < $elementi->length; $i++) {
		
		$elemento = $elementi->item($i);
		$pianta = $elemento->firstChild;
		$nomePianta = $pianta->textContent;
		
		if ($nomePianta == $_POST ['nome']){
			
			$root->removeChild($elemento);
			
		}
		
	}
	
	$doc->save('piante.xml');
	
	echo "<h3>Fatto</h3>\n";
	$_POST['invio']="j";
	
}


?>

<form action = "eliminapiante.php" method = "post">
	
	<p>
	Inserisci il nome completo della pianta da eliminare <input type = "text" name = "nome" size = "50" />
	</p>
	
	<p>
	<input type = "submit" name = "invio" value = "Elimina pianta" />
	</p>
	
</form>

<?php

if ($_POST ['invio'] == "j")
	echo '<p><a href = "piante.php">Torna alla tabella delle piante</a></p>';

?>

</body>
</html>