<?php 
	// header('Location: submission page.html');
	set_time_limit(300);
	$problem_name = "Printing Pages";
	$source_code_name = $problem_name . ".cpp";
	$language = $_POST["language_options"];
	echo "<p> Programming Lauguage: " . $language . "</p>";
	
	$uploadOk = 1;
	if ($_FILES["source_code_file"]["size"] > 256 * 1024) {
		echo "Sorry, your source code file is too large.";
		$uploadOk = 0;
		return;
	}

	if ($_FILES["source_code_file"]["size"] == 0){
		$uploadOk = 0;
	}
	
	if($uploadOk == 1){
		move_uploaded_file($_FILES["source_code_file"]["tmp_name"], $source_code_name);
		echo "The file ". htmlspecialchars( basename( $_FILES["source_code_file"]["name"])). " has been uploaded.";
	}else{
		$source_code = fopen( "../background/" . $source_code_name, "w"); // TODO: hardcode
		if( $source_code == false){
			echo ("Error: File " . $source_code_name . "cannot be created");
			exit();
		}
		fwrite($source_code, $_POST["source_code_text"]);
		fclose($source_code);
	}
	system("cd ../background; ./judge < task_info.txt > 'submission 0.txt'");
	echo "<p> Done! </p>";
	$result = fopen("../background/submission 0.txt", "r") or die("Unable to open submission result file!");  // TODO: hardcode
	echo "<pre>" . fread($result, filesize("../background/submission 0.txt")) . "</pre>";  // TODO: hardcode
	fclose($result);
?>
