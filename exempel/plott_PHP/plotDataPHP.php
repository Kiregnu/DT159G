<?php

	// Ett PHP-objekt, med JSON-kodat data anpassat för Plotly.
	// Notera syntaxskillnaden mot Javascript i "plott_JS".
	$data = [
		[
			"x" => ["giraffes", "orangutans", "monkeys"],
			"y" => [20, 14, 13],
			"type" => "bar"
		]
	]; 

	$ut = json_encode($data);

	// header('Content-Type: application/json'); // Lägger in i headern så att mottagaren får info om att det är json.
	echo $ut;

?>
