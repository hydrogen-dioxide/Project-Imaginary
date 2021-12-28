<?php
  $SQL_SERVERNAME = "cpanel.rocketdevhost.xyz:3306";
  $SQL_USERNAME = "judge_admin";
  $SQL_PASSWORD = ")]ynT{aI~p$~";
  $SQL_DATABASE = "judge_test";
	$conn = new mysqli($SQL_SERVERNAME, $SQL_USERNAME, $SQL_PASSWORD, $SQL_DATABASE);
	if($conn->connect_errno) echo $conn->connect_error;
?>