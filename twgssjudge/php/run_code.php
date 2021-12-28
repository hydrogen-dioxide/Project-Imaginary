<?php include("sql_password.php");
	function deleteDirectory($dir) { // Credit: https://stackoverflow.com/questions/1653771/how-do-i-remove-a-directory-that-is-not-empty/49396280
		if (!file_exists($dir)) return true; if (!is_dir($dir)) return unlink($dir);
		foreach (scandir($dir) as $item) { if ($item == '.' || $item == '..') continue; 
		if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) return false;}
		return rmdir($dir);
	}

	$conn = new mysqli($SQL_SERVERNAME, $SQL_USERNAME, $SQL_PASSWORD); if($conn -> connect_errno) echo $conn -> connect_error;
	$username = $_SESSION['username'];
	$identifier = "{{" . $username . '-' . time() . "}}"; 

	$conn->query("USE judge_test;");
	$result = $conn->query("SELECT `hash` FROM `submissions` WHERE `username` = '$username' AND `submissionTime` = " . time());
	if($conn->errno) echo $conn->error;
	$collide_result = mysqli_num_rows($result);
	$identifier .= ($collide_result == 0 ? "" : "_" . $collide_result);
	$hash = hash('sha256', $identifier);
	$conn->query("INSERT INTO `submissions` (`hash`, `username`, `submissionTime`)
				  VALUES ('$hash', '$username', " . time() . ");");
	if($conn->errno) echo $conn->error;
	echo $identifier . "<br>";
	echo $hash . "<br>"; // If two $hash are the same, then we have found the world's first SHA256 collision!

	$language = "C++11";
	$dir = $_SERVER["DOCUMENT_ROOT"] . '/tmp/' . $hash . '/';
	mkdir($dir);

	function suffix($lang){
		if($lang == "Pascal") return ".pas"; if($lang == "C") return ".c";
		if($lang == "C++11" || $lang == "C++14" || $lang == "C++17" || $lang == "C++20") return ".cpp";
		if($lang == "in") return ".in"; if($lang == "out") return ".out"; if($lang == "txt") return ".txt";
		return ".unknown";
	}
	$pathtofile = $dir . "program" . suffix($language);
	echo $pathtofile . "<br>";
	$content = "#include <bits/stdc++.h>\nusing namespace std; int32_t main(){ cout << 1 << endl; }";

	$file = fopen($pathtofile, "w");
	if((fwrite($file, $content) == false) && (!file_exists($pathtofile))) {
		fclose($file);
		echo 'File not written, check permissions!' . "<br>";
	} else {
		fclose($file);
		echo 'File write success!' . "<br>";
	}

	$judgepath = "judge";
	$command = $judgepath . ' ' . $dir . ' ' . $language; // Example: "judge /tmp/hash/ C++11"
	echo $command;
	deleteDirectory($dir);
?>
