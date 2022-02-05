<!DOCTYPE html>
<html>
<head>
<?php 
  function includeHeader($id="", $title="", $nav="") {
    include($_SERVER['DOCUMENT_ROOT']."/head.php");
  }
  includeHeader("leaderboard", "Leaderboard", "leaderboard");
?>
</head>
<body>
  <div id="header"></div>
  <main>
	<h1> <img class="page-icon" src="/assets/image/icon_leaderboard.svg"> Leaderboard </h1>
  <div class="table-container">
    <table class="mid-table">
      <thead>
        <tr>
          <th> Rank </th>
          <th> User </th>
          <th title="Problems Solved"> <img class="table-head-icon" src="/assets/image/icon_solved.svg"></th>
        </tr>
      </thead>

      <tbody>
        <?php 
          include('php/sql_connect.php');
          $res = $conn->query("
            SELECT userID, userName, displayName, problemCount
            FROM user ORDER BY problemCount DESC LIMIT 10");
          include('Utility.php');
          if($res){
            $rank = 1; $idx = 0; $prev = -1;
            while ($row = mysqli_fetch_array($res)) {
              $idx++;
              if($prev != $row[3]) $rank = $idx;

              echo Utility::getUserRow($row[0], $row[1], $row[2], $rank, $row[3]);
              
              $prev = $row[3];
            }
          }
        ?>
      </tbody>
    </table>
  </div>
  </main>
  <div id="footer"></div>
</html>