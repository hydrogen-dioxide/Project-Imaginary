<?php
	$id = $_GET["id"];
	$files = scandir("C:/Users/User/Downloads/test/input/");

	foreach($files as $file){
		if($file != "." && $file != ".." && $file != ".vs"){
			echo $file . "<button onclick=\"deleteFile('$file')\"> " . "X" . " </button><br>";
		}
	}
?>