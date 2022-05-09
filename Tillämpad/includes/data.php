<?php
	include('../biblo/httpful.phar');

    //Hämtar API från SMHI.
	//"https://opendata-download-metfcst.smhi.se/api/category/pmp3g/version/2/geotype/point/lon/17.2664/lat/62.4066/data.json";
	//$url = "https://opendata-download-metfcst.smhi.se/api/category/pmp3g/version/2/geotype/point/lon/´${lon}´/lat/´${lat}´/data.json";
	
	$lonlatarr = array (
		[17.2664,62.4066], //svall
		[18.0549,59.3417], //sthlm
		[11.9924,57.7156] //gtbg
	);

	$paramArr = array();

	//Går igenom alla koordinater i lonlatarr.
	foreach ($lonlatarr as $value) {
		
		//Sätter lat och lon, laddar om API.
		$lon = $value[0];
		$lat = $value[1];
		$url = "https://opendata-download-metfcst.smhi.se/api/category/pmp3g/version/2/geotype/point/lon/${lon}/lat/${lat}/data.json";

		$response = \Httpful\Request::get($url)
		->send();
		
		$inData =  json_decode( $response );
	
		// Sätter värdena från hämtat JSON.
		$tid="validTime";
		$param="parameters";
	
		//Skapar arrayer som värden ska sparas i
		$valueArr = array();
		$tidArr = array();
	
		//Definierar vilken typ av data som ska hämtas.
		$chosenstat = "t";

		//Kollar genom all data som hämtas och sparar tiderna i array
		foreach ( $inData->timeSeries as $prognos ) {
			$tidArr[] = $prognos->$tid;

			//Kollar igenom alla typer av data som ges av API.
			for ($n=0;$n<18;$n++) {
		
				//Väljer ut den data som matchar den valda typen av data. Sparar då data i valueArr.
				$cmp = strcmp($prognos->$param[$n]->name,$chosenstat);
				if ($cmp == 0) {
					$valueArr[] = $prognos->$param[$n]->values[0];
				}
			}	
		}
		//Lägger in alla värden i paramArr
		array_push($paramArr,$valueArr);
	}


	// Skapa ett PHP-objekt, med "JSON-kodat" data anpassat för plotly.
	$data = [
		[
			"x" => $tidArr,
			"y" => $paramArr[0],
			"type" => "line",
			"name" => "Sundsvall"
		],
		[
			"x" => $tidArr,
			"y" => $paramArr[1],
			"type" => "line",
			"name" => "Stockholm"
		],
		[
			"x" => $tidArr,
			"y" => $paramArr[2],
			"type" => "line",
			"name" => "Göteborg"
		]
	];
	
    // Serialisera till json-format.
	$ut = json_encode( $data ); 
	
    // Lägger in i headern så att mottagaren får info om att det är json.
	header('Content-Type: application/json'); 
	echo "{$ut}";

?>
