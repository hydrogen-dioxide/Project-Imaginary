<!DOCTYPE HTML>
<html>
<head>
  <?php 
    function includeHeader($id="", $title="", $nav="") {
      include($_SERVER['DOCUMENT_ROOT']."/head.php");
    }
    includeHeader("user", $userName, "");
  ?>
</head>
  <?php include("php/sql_connect.php"); include("Utility.php");
    $row = $conn->query("SELECT userID, userName, realName, displayName, info, description, contestList, problemList, (
										SELECT 1 + count(*) 
										from user t1 
										where t1.problemCount > t.problemCount
									) rank_no
    FROM user t WHERE userID = '$userID'")->fetch_assoc();
    $userName = $row['userName'];
    $realName = $row['realName'];
    $displayName = $row['displayName'];
    $rank = $row['rank_no'];
    $info = $row['info'];
    $description = $row['description'];
    $contestList = json_decode($row['contestList'], true);
    if($contestList == null) $contestList = [];
    $contestCount = count($contestList);
    $problemList = json_decode($row['problemList'], true);
    if($problemList == null) $problemList = [];
    $problemCount = count($problemList);
  ?>
  <body>
    <div id="header"></div>
    <main>
      <h1 class='page-head'>
        <div class="page-head-id"><?php echo $userName?></div>
        <div class="page-head-name"><?php echo $displayName ?></div>
        <a class="rank" href="/leaderboard" title="Leaderboard"><img src="/assets/image/icon_leaderboard.svg" height="12px">#<?php echo $rank ?></a>
      </h1>

      <div style="display: flex; flex-direction: row; align-items: center; text-align: right;">
        <img class="pfp" src="<?php echo Utility::getProfilePicturePath($userID); ?>" width="128px" height="128px">
        <div style="margin-left: 15px">
          <div style="padding: 10px; border: 2.5px rgb(var(--TWGSS-green-light)) solid; border-radius: 5px; max-width: min(720px, calc(90vw - 150px)); max-height: 480px; overflow: auto; text-align: left; white-space: pre-line;">
          <?php echo $description; ?>
          </div>
          <div style="margin: 10px 10px 0 10px;"><?php echo $realName; ?></div>
          <!--br>
          Class: 5D <br>
          Codeforces: QwertyPi <br>
          Atcoder: QwertyPi <br> 
          <br>
          <button> Direct Message </button>
          <button> Add as friend </button-->
        </div>
      </div>
      
      <!--section id="description">
      <h2> Personal Description </h2>
      <p> <?php echo $description; ?> </p>
      </section-->

      <section id="contest"> 
      <h2> Participated Contests <div class="count"><?php echo $contestCount; ?></div> </h2>
        <?php
          function getContestButton($id, $name){
            echo "<button class=\"prob-button\" onclick=\"location.href='/contest/$id'\"> $name </button>";
          }
          foreach($contestList as $contest){
            getContestButton($contest['id'], $contest['name']);
          }
        ?>
      </section>
      
      <section id="problem">
      <h2> Solved Problems <div class="count"><?php echo $problemCount; ?></div> </h2>
      <?php
        function getProblemButton($id){
          echo "<button class=\"prob-button\" onclick=\"location.href='/problem/$id'\"> $id </button>";
        }
        foreach($problemList as $problem){
          getProblemButton($problem);
        }
      ?>
    </main>
    <div id="footer"></div>
  </body>
</html>
<!--
	  <a href="/setting.php"> Setting </a>
      <br>
	  <a href="/admin/index.html"> Admin </a>
-->