<?xml version="1.0" encoding="ISO-8859-1"?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

    <head>
        <title> Elenco piante con funzionalità DOM</title>
    </head>

<body>

<style>

body {
	
	background-color: #696969;
	color: white;

}

.scritta {
	
	color: #DC143C;
	font-style: oblique;
	font-weight: 2000;
	font-size: 140%;
	
}

td.centrato {
	
	vertical-align: middle;
	
}

</style>

<table border="2" cellspacing="5" cellpadding="10">

	<caption class = "scritta"><h3> Valori ottimali per la crescita di piante <h3></caption>

	<thead>
		<tr>
			<th>Nome pianta</th>
			<th>Temperatura</th>
			<th>Substrato</th>
			<th>Clima</th>
			<th>Irrigatura</th>
			<th>Luce</th>
		</tr>
	</thead>

	<tbody>

		<?php
		
		$lungPag = 5;
	
		$xmlString = "";
		foreach (file("piante.xml") as $node) {
			$xmlString .= trim($node);
		}

		$doc = new DOMDocument();
		$doc->loadXML($xmlString);
		$root = $doc->documentElement;
		$elementi = $root->childNodes;
		
		if (isset($_GET['next']))
			$primo = $_GET['next'];
		else
			$primo = 0;
		
		if ($elementi->length - $primo < $lungPag)
			$ultimo = $elementi->length;
		else
			$ultimo = $primo + $lungPag;

		for ($i = $primo; $i < $ultimo; $i++) {
			
			$elemento = $elementi->item($i);
			$pianta = $elemento->firstChild;
			$nomePianta = $pianta->textContent;
			$temperatura = $pianta->nextSibling;
			$valoreTemp = $temperatura->textContent;
			$substr = $temperatura->nextSibling;
			$valoreSubstr = $substr->textContent;
			$clima = $substr->nextSibling;
			$valoreclima = $clima->textContent;
			$irrig = $clima->nextSibling;
			$valoreirrig = $irrig->textContent;
			$luce = $elemento->lastChild;
			$valoreluce = $luce->textContent;
			
			print "<tr><td class=\"centrato\">$nomePianta</td><td class=\"centrato\">$valoreTemp</td><td class=\"centrato\">$valoreSubstr</td><td>$valoreclima</td><td class=\"centrato\">$valoreirrig</td><td class=\"centrato\">$valoreluce</td></tr>\n";
		
		}
	
		?>
		
	</tbody>
</table>

<?php

if ($ultimo < $elementi->length) {
    echo '<br /><p><a href="piante.php?next='
    . $ultimo
    . '">Pagina successiva</a></p>';
	
} else {
	print '<h4> Ultima pagina :) <br /></h4> <br />';
}

if (!($ultimo < $elementi->length)) {
    echo '<p><a href="piante.php?prec='
    . $primo
    . '">Pagina iniziale</a></p>';
}

?>

<p><a href = "aggiungipiante.php">Aggiungi pianta</a></p>

<p><a href = "eliminapiante.php">Elimina pianta</a></p>

</body>
</html>