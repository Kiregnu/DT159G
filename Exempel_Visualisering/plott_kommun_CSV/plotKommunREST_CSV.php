<?php
	// Länk till nedladdade REST-biblioteket, lagt i mappem biblo i överordnad katalog.
	include('../biblo/httpful.phar');

	// Hämta datat
	// http://öppnadata.se/dataset/kommunkoder
	$url = "https://catalog.skl.se/store/1/resource/165";
	$response = \Httpful\Request::get($url)
		->send();

	// var_dump($response);	// vad har vi fått?

	// stoppa in resultatet i en array.
	$rader = explode("\n", $response);

	// Plocka bort rubrikraden ur arrayen
	array_shift( $rader );

	// Skapa arrayer som är lämpliga för visualisering.
	$namnArr = array();
	$befArr = array();
//	$i=0;
	foreach ( $rader as $rad )
	{
		$rad = trim( $rad );
		$radData = str_getcsv( $rad, ";"); // splitta raden till en array
		if( count( $radData ) >= 3 )	// ev tomrader
		{
			$namnArr[] =  utf8_encode( $radData[1] );
			//$namnArr[] =  $radData[1];
			$befArr[] = (int)$radData[2];
		}
	}

	// Fr.o.m. 2022 är de inte sorterade i bokstavsordning.
	array_multisort($namnArr, $befArr);
	
	// Ett PHP-objekt, med JSON-kodat data anpassat för Plotly.
	$data = [
		[
			"x" => $namnArr,
			"y" => $befArr,
			"type" => "bar"
		]
	];
	
	$ut = json_encode( $data );

	header('Content-Type: application/json'); // Lägger in i headern så att mottagaren får info om att det är json.
	echo "{$ut}";
	
	//var_dump( $ut );	// kolla resultatet av json_encode.
	//var_dump( json_last_error_msg() );	// om json_encode gick fel, vad gick fel?

?>
