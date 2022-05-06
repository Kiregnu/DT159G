<?php
	// Länk till nedladdade REST-biblioteket. Detta ligger i mappen biblo i överordnad katalog.
	include('../biblo/httpful.phar');

	// Hämta data
	// http://öppnadata.se/dataset/kommunkoder
	$url = "https://catalog.skl.se/store/1/resource/165";
	$response = \Httpful\Request::get($url)
		->send();

	// Vad fick vi??
	var_dump($response);

	echo "<br />-----------------------------------------------------------<br />";
	
	// Länk till datat.
	echo "<a href=\"https://catalog.skl.se/store/1/resource/165\">Data-URL</a> <br />";

	echo "<br />-----------------------------------------------------------<br />";
?>
