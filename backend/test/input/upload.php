<?php
	$R = "C:/Users/User/Downloads/test/input/";

	$name = 'file_in';
	echo $name . "<br>";
	
	$total = count($_FILES[$name]['name']);

	// Loop through each file
	for( $i=0 ; $i < $total ; $i++ ) {

	  //Get the temp file path
	  $tmpFilePath = $_FILES[$name]['tmp_name'][$i];

	  //Make sure we have a file path
	  if ($tmpFilePath != ""){
		//Setup our new file path
		$newFilePath = $R . $_FILES[$name]['name'][$i];

		//Upload the file into the temp dir
		if(move_uploaded_file($tmpFilePath, $newFilePath)) {

		}
	  }
	}
	print_r($_FILES);

?>