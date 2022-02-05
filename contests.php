<!DOCTYPE html>

<html>

<head>
<?php 
  function includeHeader($id="", $title="", $nav="") {
    include($_SERVER['DOCUMENT_ROOT']."/head.php");
  }
  includeHeader("contests", "Contests", "contests");
?>
</head>

<html>
  <body>
  <div id="header"></div>
  <main>
  <h1> <img class="page-icon" src="/assets/image/icon_contests.svg"> Contests </h1>
  <div class="table-container">
    <table class="mid-table">
      <thead>
        <tr>
          <th colspan="2"> Contest </th>
          <th> # Participants </th>
        </tr>
      </thead>

      <tbody >
        <?php
          include('php/sql_connect.php');
          include('Utility.php');
          $res = $conn->query("SELECT contestID, contestName, contestantCount FROM contest ORDER BY contestID ASC LIMIT 10");
          if($res){
           while($row = mysqli_fetch_array($res)){
              echo Utility::getContestRow($row[0], $row[1], $row[2]);
            }
          }
        ?>
      </tbody>
    </table>
  </div>
  </main>
  <div id="footer"></div>
  </body>
</html>