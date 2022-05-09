<?php
	include('../biblo/httpful.phar');

    //Hämtar API från SMHI.
	//"https://opendata-download-metfcst.smhi.se/api/category/pmp3g/version/2/geotype/point/lon/17.2664/lat/62.4066/data.json";
	//$url = "https://opendata-download-metfcst.smhi.se/api/category/pmp3g/version/2/geotype/point/lon/´${lon}´/lat/´${lat}´/data.json";
	
	$lonlatarr = array (
		[17.2664,62.4066],
		[18.0549,59.3417],
		[11.9924,57.7156]
	);

	// Skapa arrayer som är lämpliga för visualisering.
	
	$paramArr = array();

	foreach ($lonlatarr as $value) {
		
		$lon = $value[0];
		$lat = $value[1];
		
		
		$url = "https://opendata-download-metfcst.smhi.se/api/category/pmp3g/version/2/geotype/point/lon/${lon}/lat/${lat}/data.json";


		$response = \Httpful\Request::get($url)
		->send();
		
		$inData =  json_decode( $response );
	
		// Sätter 
		$tid="validTime";
		$param="parameters";
	
		$valueArr = array();
		$tidArr = array();
	
		$chosenstat = "ws";

		foreach ( $inData->timeSeries as $prognos ) {
			$tidArr[] = $prognos->$tid;

			for ($n=0;$n<18;$n++) {
		
				$cmp_t = strcmp($prognos->$param[$n]->name,$chosenstat);
				if ($cmp_t == 0) {

					$valueArr[] = $prognos->$param[$n]->values[0];
				}
			}
			
		}
		//print_r($valueArr);
		//print_r($valueArr);
		array_push($paramArr,$valueArr);
		//print_r($paramArr);		
	}


	// Skapa ett PHP-objekt, med "JSON-kodat" data anpassat för plotly.
	$data = [
		[
			"x" => $tidArr,
			"y" => $paramArr[0],
			"type" => "line"
		],
		[
			"x" => $tidArr,
			"y" => $paramArr[1],
			"type" => "line"
		],
		[
			"x" => $tidArr,
			"y" => $paramArr[2],
			"type" => "line"
		]
	];
	
    // Serialisera till json-format.
	$ut = json_encode( $data ); 
	
    // Lägger in i headern så att mottagaren får info om att det är json.
	header('Content-Type: application/json'); 
	echo "{$ut}";

?>
