<?php

$SQL_SERVERNAME = "localhost";
$SQL_USERNAME = "root";
$SQL_PASSWORD = "";
$conn = new mysqli($SQL_SERVERNAME, $SQL_USERNAME, $SQL_PASSWORD);
if($conn->connect_errno) echo $conn->connect_error;
echo "Connected successfully" . "<br>";

$conn->query('CREATE DATABASE judge_test_f;');
$conn->query('USE judge_test_f;');

$sql = "CREATE TABLE login (
	userID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(32) NOT NULL,
	password VARCHAR(64) NOT NULL,
	email TEXT NOT NULL,
	hash VARCHAR(64) NOT NULL,
	active INT NOT NULL DEFAULT '0'
);";

if (!$conn->query($sql)) echo "Error: " . $conn->error . "<br>";

$sql = "CREATE TABLE resetUserPassword (
	requestID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	hash VARCHAR(64) NOT NULL,
	username VARCHAR(32) NOT NULL,
	email VARCHAR(320) NOT NULL
);";

if (!$conn->query($sql)) echo "Error: " . $conn->error . "<br>";

$sql = "CREATE TABLE problem(
	problemID VARCHAR(10) NOT NULL PRIMARY KEY,
	problemName NVARCHAR(50) NOT NULL,
	problemType VARCHAR(50),
	proposedTime TIMESTAMP NOT NULL,
	author VARCHAR(50),
	timeLimit DOUBLE,
	memoryLimit DOUBLE,
	acceptedLanguages VARCHAR(200) NOT NULL,
	solved INT,
	attempted INT,
	problemStatement TEXT,
	generatedStatement TEXT,
	subtasks TEXT,
	samples TEXT
);";

if (!$conn->query($sql)) echo "Error: " . $conn->error . "<br>";

$sql = "CREATE TABLE submission(
	submissionID INT PRIMARY KEY AUTO_INCREMENT,
	problemID VARCHAR(10) NOT NULL,
	userID VARCHAR(50) NOT NULL,
	sourceCode TEXT(32768),
	language VARCHAR(20) NOT NULL,
	submissionTime INT NOT NULL,
	score DOUBLE,
	verdict VARCHAR(10),
	result TEXT(32768),
	runtime DOUBLE,
	memory DOUBLE,
	hash VARCHAR(128) UNIQUE NOT NULL
);";

if (!$conn->query($sql)) echo "Error: " . $conn->error . "<br>";

$sql = "CREATE TABLE user(
	userID INT PRIMARY KEY AUTO_INCREMENT,
	userName NVARCHAR(50),
	displayName NVARCHAR(50),
	contestCount INT NOT NULL,
	contestList NVARCHAR(8191),
	problemCount INT NOT NULL,
	problemList NVARCHAR(8191),
	registerTime INT NOT NULL
);";

if (!$conn->query($sql)) echo "Error: " . $conn->error . "<br>";

$sql = "CREATE TABLE contest(
	contestID INT PRIMARY KEY AUTO_INCREMENT,
	contestName NVARCHAR(50),
	contestantCount INT NOT NULL,
	contestantList NVARCHAR(8191),
	proposedTime INT NOT NULL
);";

if (!$conn->query($sql)) echo "Error: " . $conn->error . "<br>";
?>
