<?php include_once("sql_connect.php");

// Check connection
echo "Connected successfully" . "<br>";

$sql = "CREATE TABLE `login` (
	`userID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`username` VARCHAR(32) NOT NULL,
	`password` VARCHAR(64) NOT NULL,
	`email` TEXT NOT NULL,
	`hash` VARCHAR(64) NOT NULL,
	`active` INT NOT NULL DEFAULT '0'
);";

if (!$conn->query($sql)) echo "Error: " . $conn->error . "<br>";

$sql = "CREATE TABLE `resetUserPassword` (
	`requestID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`hash` VARCHAR(64) NOT NULL,
	`username` VARCHAR(32) NOT NULL,
	`email` VARCHAR(320) NOT NULL
);";

if (!$conn->query($sql)) echo "Error: " . $conn->error . "<br>";

$sql = "CREATE TABLE `problem`(
	`problemID` VARCHAR(10) NOT NULL PRIMARY KEY,
	`problemName` NVARCHAR(50) NOT NULL,
	`problemType` VARCHAR(50),
	`proposedTime` TIMESTAMP NOT NULL,
	`author` VARCHAR(50),
	`timeLimit` DOUBLE,
	`memoryLimit` DOUBLE,
	`acceptedLanguages` VARCHAR(200) NOT NULL,
	`problemStatement` TEXT,
	`generatedStatement` TEXT,
	`subtasks` TEXT,
	`samples` TEXT 
);";

if (!$conn->query($sql)) echo "Error: " . $conn->error . "<br>";

$sql = "CREATE TABLE `submission`(
	`submissionID` INT PRIMARY KEY AUTO_INCREMENT,
	`problemID` VARCHAR(10) NOT NULL,
	`sourceCode` TEXT(32768),
	`runtime` DOUBLE,
	`memory` DOUBLE,
	`score` DOUBLE,
	`result` TEXT(32768),
	`userID` VARCHAR(50) NOT NULL,
	`usedLanguage` VARCHAR(20) NOT NULL,
	`submissionTime` TIMESTAMP NOT NULL
);";

if (!$conn->query($sql)) echo "Error: " . $conn->error . "<br>";

$sql = "CREATE TABLE `userInfo`(
	`userID` int primary key auto_increment,
	`contestCount` INT NOT NULL,
	`contestList` NVARCHAR(8191),
	`problemCount` INT NOT NULL,
	`problemList` NVARCHAR(8191),
	`registerTime` TIMESTAMP NOT NULL
);

";
if (!$conn->query($sql)){
  echo "Error: " . $conn->error . "<br>";
}
?>
