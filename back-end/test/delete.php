<?php
	$R = "input/";

	$id = $_GET["id"];

	if($id == "__ALL__"){
		foreach(scandir($R, 1) as $file){
			unlink($R . $file);
		}
	}else{
		unlink($R . $id);
	}
?>