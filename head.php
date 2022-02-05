	<?php include("php/session.php"); 
/*    if(!Session::checkSession()){
      header("entry.php");
    }*/
  echo $conn->error;
  ?>

  <?php
	$SQL_SERVERNAME = "cpanel.rocketdevhost.xyz:3306";
	$SQL_USERNAME = "judge";
	$SQL_PASSWORD = "Y89YB2xVQ8aUjuj";
	$SQL_DATABASE = "judge_test";
	$conn = new mysqli($SQL_SERVERNAME, $SQL_USERNAME, $SQL_PASSWORD, $SQL_DATABASE);
	if($conn->connect_errno) echo $conn->connect_error;
	// if($_SERVER['HTTP_X_FORWARDED_FOR'])
  // ALTER TABLE tablename AUTO_INCREMENT = 1
		$conn->query("INSERT INTO visits (visit_id, time, IP, page) VALUES (DEFAULT, DEFAULT, '".$_SERVER['HTTP_X_FORWARDED_FOR']."', '".$_SERVER['PHP_SELF']."');");
?>
  <link rel="stylesheet" type="text/css" href="/style.css">
	<meta charset="utf-8">
  <title><?php if($title) echo $title . " | "; ?>TWGSS Online Judge</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="/assets/image/icon.svg">
  <?php include $_SERVER['DOCUMENT_ROOT'].'/function.php';?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">
	</script>
  <script src="/assets/js/include.js"></script>
  <script src="/assets/js/chart.min.js"> </script>
	<script>
		$(document).ready(function(){
         $("#header").load("/header.php", null, function () { $('.nav-<?php 
            if($nav){
              echo "$nav";
            }else{
              echo "location.pathname.split('/')[1]";
            }
          ?>').addClass('active');
          });
         $("#footer").load("/footer.html");
         $("#back").load("/back.html");
         });
  </script>