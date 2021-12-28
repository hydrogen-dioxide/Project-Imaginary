 <?php
$servername = "cpanel.rocketdevhost.xyz:3306";
$username = "judge_admin";
$password = ")]ynT{aI~p$~";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?> 