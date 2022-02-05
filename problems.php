<!DOCTYPE html>
<html>
<head>
<?php 
  function includeHeader($id="", $title="", $nav="") {
    include($_SERVER['DOCUMENT_ROOT']."/head.php");
  }
  includeHeader("problems", "Problems", "problems");
?>
</head>

<body>
<div id="header"></div>
<main>
	<h1> <img class="page-icon" src="/assets/image/icon_problems.svg"> Problems </h1>

  <div class="table-container">
    <table class="mid-table"> 
      <thead>
        
					<th colspan="2"> Problem </th>
          <th title="Solved"> <img class="table-head-icon" src="/assets/image/icon_solved.svg"></th>
          <th title="Attempted"> <img class="table-head-icon" src="/assets/image/icon_attempted.svg"></th>
        </tr>
      </thead>

      <tbody>

        <?php 
          include('php/sql_connect.php');
          include('Utility.php');
          $res = $conn->query("
            SELECT problemID, problemName, solved, attempted
            FROM problem ORDER BY problemID ASC LIMIT 10");
          if($res){
            $rank = 1;
            while ($row = mysqli_fetch_array($res)) {
              echo Utility::getProblemRow($row[0], $row[1], $row[2], $row[3], $row[4]);
            }
          }
          /*
          echo Utility::getProblemRow("X0000", "Printing Pages (TESTING)", 1, 50);
          echo Utility::getProblemRow("X0001", "Printing Pages", 1, 50);
          echo Utility::getProblemRow("X0002", "Electrical Strip", 3, 20);*/
        ?>

      </tbody>
    </table>
  </div>
  </main>
  <div id="footer"></div>
</body>
</html>