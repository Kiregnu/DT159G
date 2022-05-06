<?php
	include('../biblo/httpful.phar');
	
	// hämtar bara 100 poster åt gången.
	// $url = "https://catalog.skl.se/rowstore/dataset/b80d412c-9a81-4de3-a62c-724192295677/json";
	
	// Hämtar upp till 300 poster => alla.
	$url = "https://opendata-download-metfcst.smhi.se/api/category/pmp3g/version/2/geotype/point/lon/17.2664/lat/62.4066/data.json";
	
	$response = \Httpful\Request::get($url)
		->send();
		
	$inData =  json_decode( $response ); // utf8_encode( $response );
	//var_dump(json_decode($response));
	// Namnen på medlemsvariablerna i kommunerna
	$tid="validTime";
	$temp="parameters";


	//echo $befolkn["spp"];

	//var_dump($inData->results[1]->$namn);	
	//var_dump($inData->timeSeries[1]->$befolkn);
		
	// Skapa arrayer som är lämpliga för visualisering.
	$tidArr = array();
	$tempArr = array();
	
	foreach ( $inData->timeSeries as $prognos )
	{
		$tidArr[] = $prognos->$tid;
		$tempArr[] = $prognos->$temp[1]->values;
	}
	
	// Fr.o.m. 2021 är de inte sorterade i bokstavsordning.
	array_multisort($tidArr, $tempArr);
	
	// Skapa ett PHP-objekt, med "JSON-kodat" data anpassat för plotly.
	$data = [
		[
			"x" => $tidArr,
			"y" => $tempArr,
			"type" => "bar"
		]
	];
	
	$ut = json_encode( $data ); // Serialisera till json-format.
	

	header('Content-Type: application/json'); // Lägger in i headern så att mottagaren får info om att det är json.
	echo "{$ut}";

?>
