<?php
	include('../biblo/httpful.phar');

    //Hämtar API från SMHI.
	$url = "https://opendata-download-metfcst.smhi.se/api/category/pmp3g/version/2/geotype/point/lon/17.2664/lat/62.4066/data.json";
	
	$response = \Httpful\Request::get($url)
		->send();
		
	$inData =  json_decode( $response );
	
	// Sätter 
	$tid="validTime";
	$param="parameters";
	
	// Skapa arrayer som är lämpliga för visualisering.
	$tidArr = array();
	$paramArr = array();
	
	foreach ( $inData->timeSeries as $prognos )
	{
		$tidArr[] = $prognos->$tid;

		for ($n=0;$n<18;$n++) {
			
			$i = strcmp($prognos->$param[$n]->name,"t");
			if ($i == 0) {
				$paramArr[] = $prognos->$param[$n]->values[0];
			}
		}
	}

	// Skapa ett PHP-objekt, med "JSON-kodat" data anpassat för plotly.
	$data = [
		[
			"x" => $tidArr,
			"y" => $paramArr,
			"type" => "line",
            "title" => "Sundsvall"
		]
	];
	
    // Serialisera till json-format.
	$ut = json_encode( $data ); 
	
    // Lägger in i headern så att mottagaren får info om att det är json.
	header('Content-Type: application/json'); 
	echo "{$ut}";

?>
