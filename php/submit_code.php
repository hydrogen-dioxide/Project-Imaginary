<?php
  // header('Location: '. '/problem/X0000/submissions.php');
	function deleteDirectory($dir) { // Credit: https://stackoverflow.com/questions/1653771/how-do-i-remove-a-directory-that-is-not-empty/49396280
		if (!file_exists($dir)) return true; if (!is_dir($dir)) return unlink($dir);
		foreach (scandir($dir) as $item) { if ($item == '.' || $item == '..') continue; 
		if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) return false;}
		return rmdir($dir);
	}

  function TL_ML($probID){
    include("sql_connect.php");
    $result = $conn->query("SELECT `timeLimit`, `memoryLimit` from `problem` where `problemID` = '" . $conn->real_escape_string($probID)."'");
    $row = $result->fetch_row();
    return $row[0] . ' ' . $row[1];
  }

  include("sql_connect.php");
	// header('Location: submission page.html');
	set_time_limit(300);

  echo "<pre>";

	$userID = $_SESSION['userID'];
	$identifier = "{{" . $_SESSION['username'] . '-' . time() . "}}"; 
	$result = $conn->query("SELECT `hash` FROM `submission` WHERE `userID` = '$userID' AND `submissionTime` = " . time());
	if($conn->errno) echo $conn->error;
	$collide_result = mysqli_num_rows($result);
	$identifier .= ($collide_result == 0 ? "" : "_" . $collide_result);
	$hash = hash('sha256', $identifier);
	echo $identifier . "<br>";
	echo $hash . "<br>"; // If two $hash are the same, then we have found the world's first SHA256 collision!

	function suffix($lang){
		if($lang == "Pascal") return ".pas"; if($lang == "C") return ".c";
		if($lang == "C++11" || $lang == "C++14" || $lang == "C++17" || $lang == "C++20") return ".cpp";
		if($lang == "in") return ".in"; if($lang == "out") return ".out"; if($lang == "txt") return ".txt";
		return ".unknown";
	}

	$language = $_POST["language"];
	echo "Programming Lauguage: " . $language . "<br>";

	$dir = '/var/www/tmp/' . $hash . '/';
	mkdir($dir);

	$pathtofile = $dir . "program" . suffix($language);

	$content = "";

	$uploadOk = 1;
	if ($_FILES["source_code_file"]["size"] > 256 * 1024) {
		echo "Your source code file is larger than 256 KB.";
		$uploadOk = 0;
		return;
	}

	if ($_FILES["source_code_file"]["size"] == 0){
		$uploadOk = 0;
	}
	
	if($uploadOk == 1){
    $content = file_get_contents($_FILES["source_code_file"]["tmp_name"]);
    echo "Source code uploaded <br>";
	}else{
		$content = $_POST["source_code_text"];
    if($content == ""){
      echo "Input field is empty." . "<br>"; return;
    }
	}

	function f($s){
		global $conn;
		return '"'. $conn->real_escape_string($s) . '"';
	}

	$sql = sprintf("INSERT INTO submission (problemID, userID, sourceCode, language, submissionTime, hash)
					VALUES (%s, %s, %s, %s, %s, %s)", f($_POST['problemID']), f($_SESSION['userID']), f($content), f($_POST['language']), f(time()), f($hash));

  // echo $sql;
	if(!$conn->query($sql)) echo $conn->error;

	$file = fopen($pathtofile, "w");
	if((fwrite($file, $content) == false) && (!file_exists($pathtofile))) {
		echo 'Fail to upload file. <br>';
	} else {
		echo 'File uploaded.<br>';
	}
  fclose($file);

	$judgepath = "judge";
	
  // Example: "judge /tmp/hash/ C++11"

  $command = "mkdir $dir; cd $dir; /var/www/problems/$_POST[problemID]/judge $language program".suffix($language).' '.$_POST['problemID']." > submission.txt";
  // INPUT: judge.sh file lang TL ML
  echo $command;
	system($command);
	echo "<p>Done!</p>";
  
  $result = file_get_contents($dir."/submission.txt");
  echo "<pre>" . $result . "</pre>";

  $submissionID = $conn->query("SELECT `submissionID` from `submission` WHERE `hash` = \"$hash\"")->fetch_row()[0];

  include($_SERVER['DOCUMENT_ROOT']."/php/SubmissionClass.php");
  $submission = new Submission(); 
  $submission->loadFromString($result);
  $sql = sprintf("UPDATE `submission`
  SET `verdict` = %s, `score` = %s, `runtime` = %s, `memory` = %s, `results` = %s
  WHERE `submissionID` = $submissionID;", f($submission->verdict), f($submission->score), f($submission->runtime), f($submission->memory), f(json_encode($submission->results)));
  echo "<pre>".$sql."</pre>";
  $conn->query($sql);
  if($conn->errno) echo $conn->error;
  deleteDirectory($dir);
  // header("Location: /problem/$_POST[problemID]/submissions");
?>
