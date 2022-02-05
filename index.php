<!doctype html>
<html>
<head>
<?php 
  function includeHeader($id="", $title="", $nav="") {
    include($_SERVER['DOCUMENT_ROOT']."/head.php");
  }
  includeHeader("index", "Main Page", "");
?>
</head>
<body>
  <?php include('Utility.php'); ?>
	<div id="header"></div>

      <main>
       <center><h1 class="sp">
          alpha
          </h1></center>
			  <div class="index-container">

          <div class="index-child" id="index-child-left">

            <div class="index-card" id="problemOfTheWeek">
              <h2>Problem of the Week</h2>
              <?php echo Utility::getProblemCard("SAMPLE", "Go to sample here", "0", "0"); ?>
            </div>
                

            <div class="index-card" id="recommended">
              <h2> Recommended </h2>
                <?php echo Utility::getProblemCard("β001", "Cereal Meal", "0", "0"); ?>
                <?php echo Utility::getProblemCard("β002", "Circle, circle everywhere", "0", "0"); ?>
                <?php echo Utility::getProblemCard("β003", "Make 24", "0", "0"); ?>
                <?php echo Utility::getProblemCard("β004", "NFT Trader", "0", "0"); ?>
                <?php echo Utility::getProblemCard("β005", "Text justifier", "0", "0"); ?>
                <?php echo Utility::getProblemCard("β006", "Multiple Choice", "0", "0"); ?>
            </div>

          </div>
          <div class="index-child" id="index-child-right">
            <div class="index-card" id="announcement">
              <h2> Announcement </h2>
              <?php
                echo Utility::getAnnouncementCard(
                  "4/2/2022 &ensp; 00:00",
                  "alpha",
                  "Now in <span class='inline-code'>alpha</span> stage! (4/2/2022 - 8/2/2022)"
                );
                echo Utility::getAnnouncementCard(
                  "1/2/2022 &ensp; 00:00",
                  "Year of Tiger!",
                  "Happy Chinese New Year! New year wish: Judge done on-time!"
                );
                echo Utility::getAnnouncementCard(
                  "19/1/2022 &ensp; 01:19",
                  "Schedule",
                  "
                  alpha-testing  4/2 -  8/2<br>
                  Daniel, Jack, Duncan, Ryan, Sensei, Mr. Lau<br>
                  testing while making<br>

                  <br>

                  beta-testing  12/2 - 19/2<br>
                  All OI Team members<br>
                  test the completed version;<br>
                  multiple test-contests (data will not be preserved) will be held;<br>
                  all people will use temporary accounts;<br>
                  all problems in the judge will copy from HKOJ, no real original problems will present<br>
                  
                  <br>

                  pre-release  20/2 - 21/2<br>
                  Daniel, Jack, Duncan, Ryan<br>
                  erase all testing data;<br>
                  import first-batch problems;<br>
                  for people to register<br>

                  <br>

                  official release  22/2<br>
                  All TWGSS students (and possibly teachers)
                  "
                );
                echo Utility::getAnnouncementCard(
                  "22/2/2022 &ensp; 22:22",
                  "Launch of TWGSS Online Judge!",
                  "[Not proofreaded] Welcome to TWGSS Online Judge! Develop by our team, we pay so much effort into this judge, please enjoy!
                  <br>
                  <button onclick='location.href=" . '"/credits.html"' . "'" . ">Credits</button>"
                );
              ?>
            </div>
          </div>

				</div>
      </main>
      <div id="footer"></div>
   </body>
</html>
<!--
   <a href="/setting.php"> Setting </a>
      <br>
   <a href="/admin/index.html"> Admin </a>
   -->