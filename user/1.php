<!DOCTYPE HTML>
<html>

  <?php 
    function includeHeader($id="", $title="", $nav="") {
      include($_SERVER['DOCUMENT_ROOT']."/head.php");
    }
    includeHeader("user/1", "User Info", "");
  ?>
  <script>
    $(document).ready(function(){
    $("#header").load("/header.html", null, function () { $('.nav-' + location.pathname.split("/")[1]).addClass('active'); });
    $("#footer").load("/footer.html");
    });
  </script>
</head>
  <?php include("../php/sql_connect.php"); include("../Utility.php");
    $userID = 1;
    $row = $conn->query("SELECT userID, userName, info, description, contestList, problemList, (
										SELECT 1 + count(*) 
										from user t1 
										where t1.problemCount > t.problemCount
									) rank_no
    FROM user t WHERE userID = '$userID'")->fetch_assoc();
    $userName = $row['userName'];
    $rank = $row['rank_no'];
    $info = $row['info'];
    $description = $row['description'];
    $contestList = json_decode($row['contestList'], true);
    $contestCount = count($contestList);
    $problemList = json_decode($row['problemList'], true);
    $problemCount = count($problemList);
  ?>
  <body>
    <div id="header"></div>
    <main>
      <h1 style="text-transform: none">Daniel Hsieh
        <a class="rank" href="/leaderboard.php" title="Leaderboard"><img src="/assets/image/icon_leaderboard.svg" height="12px">#<?php echo $rank ?></a>
      </h1>

      <div style="display: flex; flex-direction: row">
        <img class="pfp" src="<?php echo Utility::getProfilePicturePath($userID); ?>" width="128px" height="128px">
        <div style="width: 13px"> </div>
        <div>
          Name: Daniel Hsieh <br>
          Class: 5D <br>
          Codeforces: QwertyPi <br>
          Atcoder: QwertyPi <br>
          <button> Direct Message </button>
          <button> Add as friend </button>
        </div>
      </div>
      
      <section id="description">
      <h2> Personal Description </h2>
      <p> <?php echo $description; ?> </p>
      </section>

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