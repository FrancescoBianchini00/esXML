<?xml version="1.0" encoding="ISO-8859-1"?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

    <head>
        <title> Elenco piante con funzionalità DOM</title>
    </head>

<body>

<style>

body {
	
	background-color: #000024;
	color: white;

}

.scritta {
	
	color: red;
	font-style: oblique;
	font-weight: 1500;
	
}

td.centrato {
	
	vertical-align: middle;
	
}

</style>

<table border="2" cellspacing="5" cellpadding="10">

<caption class = "scritta"> Valori ottimali per la crescita di piante </caption>

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
		
			$xmlString = "";
			foreach (file("piante.xml") as $node) {
				$xmlString .= trim($node);
			}

			$doc = new DOMDocument();
			$doc->loadXML($xmlString);
			$root = $doc->documentElement;
			$elementi = $root->childNodes;

			for ($i=0; $i<$elementi->length; $i++) {
				
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
</body>
</html>