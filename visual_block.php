  <!doctype html>
<html>

<head>
	<title>TWGSS Online Judge</title>
	<link rel="stylesheet" type="text/css" href="/style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="/assets/image/icon.svg">
	<script src="/assets/js/include.js">
	</script>
	<script src="/assets/js/theme.js">
	</script>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">
	</script>
	<script>
		$(document).ready(function(){
         $("#header").load("/header.html", null, function () { $('.nav-lab').addClass('active'); });
         $("#footer").load("/footer.html");
         });
	</script>
</head>

<body>
	<div id="header"></div>

      <main>
        <center>
          <h1 class="sp" style="font-family: 'MiSans'; color: rgb(var(--TWGSS-green)); letter-spacing: 5px;"> visual_block </h1>
          Experiment here
        </center>


<head>
	<link rel="stylesheet" href="style.css">
</head>
<?php
include("Utility.php");

echo "<h1> Visual Components </h1>";

echo Utility::getUserBlock("1", "Daniel", "Lonely Christmas rip :(") . '<br>';
echo Utility::getProblemBlock("X0000", "Printing Pages (TESTING)");

?>
<br>
will not use the thing below...
<div class="table-list template-list">
<?php
  function toArray($a){
    if (!is_array($a)){
      $a = array($a);
    }//lol
    return $a;
  }
  
  function tableCard($a, $b){
    $a = toArray($a);
    $b = toArray($b);
    $output = "";
    $aNo = count($a);
    $bNo = count($b);
    $output .= "<div class='list-block'>";
    for ($i=0; $i<$aNo; $i++){
      $output .= "<span class='list-block-content'>".$a[$i]."</span>";
    }
    $output .= "</div>";
    $output .= "<div class='list-block'>";
    for ($i=0; $i<$bNo; $i++){
      $output .= "<span class='list-block-content'>".$b[$i]."</span>";
    }
    $output .= "</div>";
    return $output;
  }

  echo tableCard(
    "Date",
    array("4 OCT 2021", "4 JUN 1989"),
  );
  echo tableCard(
    "Time",
    "16:00-17:05",
  );
  echo tableCard(
    array("Venue", "Place"),
    array("Google Meet", "Tiananmen Square", "Victoria Harbour")
  );
?>

</div>


<br>
will not use the thing below...
<div class="table-list user-list">
<?
  function nlUserRow($id, $name, $display, $rank, $solve){
    $output = "
    <a href='/user/$id.html'>
      <div class='list-block'>
        <span class='list-block-content'>".$rank."</span>
      </div>
      <div class='list-block'>
        <span class='list-block-content'>".Utility::getUserBlock($id, $name, $display)."</span>
      </div>
      <div class='list-block'>
        <span class='list-block-content'>".$solve."</span>
      </div>
    </a>

    ";
    return $output;
  }
  echo nlUserRow( // nl stands for "New List"
    1,
    "Daniel",
    "Lonely Christmas",
    1,
    571,
  );
?>
</div>

<?php
  echo Utility::getUserRow(1, "Daniel", "lonely christmas", 1,571); 
?>




  <div class="table-container">
    <table class="big-table">
      <thead>
        <tr>
          <th> Rank </th>
          <th> User </th>
          <th title="Problems Solved"> <img class="table-head-icon" src="/assets/image/icon_solved.svg"></th>
        </tr>
      </thead>
      <tbody>
        <?php
          echo Utility::getUserRow(1, "Daniel", "lonely christmas", 1,571); 
          //echo Utility::getUserRowFromSQL("1");
        ?>
      </tbody>
    </table>
  </div>

  <div class="table-container">
    <table class="big-table"> 
      <thead>
        <tr>
          <th colspan="2"> Problem </th>
          <th title="Solved"> <img class="table-head-icon" src="/assets/image/icon_solved.svg"></th>
          <th title="Attempted"> <img class="table-head-icon" src="/assets/image/icon_attempted.svg"></th>
        </tr>
      </thead>

      <tbody>
        <?php 
          //echo Utility::getProblemRowFromSQL("X0000");
          echo Utility::getProblemRow("X0000", "Printing Pages (TESTING)", 1, 50);
        ?>
      </tbody>
    </table>
  </div>
		<div class="table-container">
			<table style="width:100%">
				<thead>
					<tr>
						<th> ID </th>
            <th> Date & Time </th>
						<th> User </th>
            <th> Problem </th>
            <th> Language </th>
						<th> Verdict </th>
						<th> <img class="table-head-icon" src="/assets/image/icon_timelimit.svg"> Runtime</th>
						<th> <img class="table-head-icon" src="/assets/image/icon_memlimit.svg"> Memory</th>
					</tr>
				</thead>
				<tbody>
          <?php
            //echo Utility::getSubmissionRowFromSQL("1");
            echo Utility::getSubmissionRow("1", "27/12/2021 00:00:00", "1", "Daniel", "Lonely Christmas rip", "X0000", 
                                  "Printing Pages", "C++20", "Accepted", "ac", "0.023 s", "89.64MB");
          ?>
				</tbody>
			</table>
		</div>

    <div class="table-container">
      <table class="big-table">
        <thead>
          <tr>
            <th> Contest # </th>
            <th> Contest Name </th>
            <th> # Participants </th>
          </tr>
        </thead>

        <tbody>
          <?php
            //echo Utility::getContestRowFromSQL("0000");
            echo Utility::getContestRow("0000", "Beta Round #1", 1);
          ?>
        </tbody>
      </table>
    </div>
    <div class="flex-child">
      <div class="index-card" id="announcement">
        <h2> Announcement </h2>
        <?php
          echo Utility::getAnnouncementCard(
            "32/12/2021 &ensp; 24:61",
            "Launch of TWGSS Online Judge!",
            "[Not proofreaded] Welcome to TWGSS Online Judge! Develop by our team, we pay so much effort into this judge, please enjoy!
            <br>
            <button onclick='location.href=" . '"/credits.html"' . "'" . ">Credits</button>"
          );
        ?>
      </div>
    </div>
    <div class="flex-child">
      <div class="index-card" id="recommended">
        <h2> Recommended </h2>
          <?php
            echo Utility::getProblemCard(
              "X0003",
              "Sad Birthday",
              "0",
              "0"
              ); ?>
      </div>
    </div>
      </main>
      <div id="footer"></div>
   </body>
</html>