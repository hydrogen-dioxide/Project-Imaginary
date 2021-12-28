<?php include("sql_connect.php");
	function f($s){
		global $conn;
		return '"'. $conn->real_escape_string($s) . '"';
	}
	$sql = sprintf("INSERT INTO submission (problemID, userID, sourceCode, usedLanguage)
					VALUES (%s, %s, %s, %s)", f($_POST['problemID']), f($_POST['userID']), f($_POST['sourceCode']), f($_POST['language']));
	if(!$conn->query($sql)) echo $conn->error;
?>