<?php
	$R = "C:/Users/User/Downloads/test/input/";

	$id = $_GET["id"];

	if($id == "ALLLLLLLLLLLLLLLLLLLLLLLL"){
		foreach(scandir($R, 1) as $file){
			unlink($R . $file);
		}
	}else{
		unlink($R . $id);
	}
?>