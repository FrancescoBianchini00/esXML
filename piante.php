<?xml version="1.0" encoding="ISO-8859-1"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

    <head>
        <title>elenco di temperature con XML e DOM</title>
		
		<style>
  		  *.centrat {text-align: center;}
		</style>
    </head>
<body>

<!-- 
    per una versione di questo file con spiegazioni verbose di vari aspetti, vedi "questofile"comment.php 
  -->

<table border="1" cellspacing="3" cellpadding="5"
       summary="una collezione di rilievi metereologici: per diverse citta' del mondo, viene mostrata la temperatura e il grado di unidita', rilevati oggi, qualunque sia oggi ...">
<caption style="color: olive; font-style: oblique; font-weight: bold">Temperature registrate qui e l&igrave; in giro per il mondo</caption>

<thead>
 <tr>
  <th>citt&agrave;</th>
  <th>temperatura registrata</td>
  <th>umidita' media relativa</td>
 </tr>
</thead>

<tbody>

<?php
$t2=microtime();
$xmlString = "";
foreach ( file("temperature.xml") as $node ) {
	$xmlString .= trim($node);
}

$doc = new DOMDocument();
$doc->loadXML($xmlString);
$root = $doc->documentElement;
$elementi = $root->childNodes;

for ($i=0; $i<$elementi->length; $i++) {
    $elemento = $elementi->item($i);
	$town = $elemento->firstChild;
	$townName = $town->textContent;
	$temp = $town->nextSibling;
	$tempValue = $temp->textContent;
	$humid = $elemento->lastChild;
	$humidValue = $humid->textContent;
	print "<tr><td>$townName</td><td class=\"centrat\">$tempValue</td><td class=\"centrat\">$humidValue</td></tr>\n";
}
echo "</tbody>\n</table>";
?>
</body>
</html>