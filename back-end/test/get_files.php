<?php
	$id = $_GET["id"];
	$files = scandir("input/");

	foreach($files as $file){
		if($file != "." && $file != ".." && $file != ".vs"){
			echo $file . "<button onclick=\"deleteFile('$file')\"> " . "X" . " </button><br>";
		}
	}
?>