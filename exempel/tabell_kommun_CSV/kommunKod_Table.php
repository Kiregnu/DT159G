<?php
	// Länk till nedladdade REST-biblioteket. Dett ligger i mappen biblo i överordnad katalog.
	include('../biblo/httpful.phar');

	// Hämta data
	// http://öppnadata.se/dataset/kommunkoder
	$url = "https://catalog.skl.se/store/1/resource/165";
	$response = \Httpful\Request::get($url)
		->send();

	// Lägg in resultatet i en array. (PHP_EOL = End Of Line)
	$a = explode(PHP_EOL, $response);

	// Plocka ut o förbered rubrikraden ur arrayen
	$rub = array_shift( $a );
	$rub = trim( $rub );
	$rubData = explode( ";", $rub );

	// Tabellstart
	echo "<table>\n";

	// Skriv ut rubrik
	echo "\t<tr>\n\t\t";
	foreach ( $rubData as $elem )
		echo "<th>{$elem} </th>";
	echo "\n\t</tr>\n";

	// Skriv ut rader
	foreach ( $a as $rad )
	{
		echo "\t<tr>\n\t\t";
		$rad = trim( $rad );
		$data = explode( ";", $rad );
		foreach ( $data as $elem )
			echo "<td>{$elem} </td>";
		echo "\n\t</tr>\n";
	}

	// Tabellslut
	echo "</table>\n";

?>
