<!DOCTYPE html>

<html>
<head>
<?php 
  function includeHeader($id="", $title="", $nav="") {
    include($_SERVER['DOCUMENT_ROOT']."/head.php");
  }
  includeHeader("contest/0/index", "Contest", "contests");
  include($_SERVER['DOCUMENT_ROOT'].'/php/sql_connect.php');
?>
</head>

<html>
  <div id="header"></div>
  <main>
	<h1> Beta Round #1 </h1>
	<button onclick="location.href += '/submit'" class="btn submit"> Submit </button> 
	<button onclick="location.href += '/submissions'" class="btn submission"> Submissions </button> 
	<button onclick="location.href += '/results'" class="btn statistic"> Results </button> 
	<button onclick="location.href += '/stats'" class="btn statistic"> Statistics </button> 
	<button onclick="location.href += '/set'" class="btn setting"> Setting </button> 
  <br>
  <div class="table-container">
    <table class="big-table">
      <thead>
      <tr> <th colspan="2"> Problem </th> <th> Subtasks </th> <th> # of Solves</th></tr>
      </thead>
      <tbody>
      <?php
        function genRow($problemID, $problemName, $subtasksPts, $solved){
          if (!is_array($subtasksPts)){
            $subtasksPts = array($subtasksPts);
          }
          $fullMark = 0;
          for ($i=0; $i<sizeof($subtasksPts); $i++){
            if (is_numeric($subtasksPts[$i])){
              $fullMark += $subtasksPts[$i];
            } 
          }
          $subtasks = "<div class='subtask-bar'>";
          if (!($fullMark == 0)){
            for ($i=0; $i<sizeof($subtasksPts); $i++){
              $subtasks .= "<div class='subtask-score' style='width: ".$subtasksPts[$i] / $fullMark * 100 ."%'> $subtasksPts[$i] </div>";
            }
          }
          $subtasks .= "</div>";
          echo "<tr data-href='/problem/$problemID'> <td> $problemID </td> <td> $problemName </td> <td class='subtask-cell'> $subtasks </td> <td> $solved </td> </tr>";
        }
        $contestID = "0";
        $res = $conn->query("SELECT problemCount, problemList FROM contest WHERE contestID = '" . $contestID . "';");
        if(!$res){
          echo "Contest Not exist";
        }else{
          $problemList = $res->fetch_row()[1]; // why this is buggy
          $problemList = json_decode($problemList, true);
          $problemCount = count($problemList);
          $sql = "SELECT problemID, problemName, subtasks, solved, attempted FROM problem WHERE problemID in (";
          for($i = 0; $i < $problemCount; $i++){
            $sql .= "'".$problemList[$i]."'".($i != $problemCount - 1 ? ', ' : ');');
          }
          // echo '<pre>'. $sql . '</pre>';
          $res = $conn->query($sql); echo $conn->error;
          for($i = 0; $i < $problemCount; $i++){
            $row = $res->fetch_assoc();
            $subtasks = json_decode($row['subtasks'], true);
            $subtaskPts = array();
            for($j = 1; $j <= count($subtasks); $j++){
              $subtaskPts[] = (is_numeric($subtasks[$j]['points']) ? $subtasks[$j]['points'] : 100);
            }
            genRow($row['problemID'], $row['problemName'], $subtaskPts, $row['solved']);
          }
        }
      ?>
      </tbody>
    </table>
  </div>
  </main>
  <div id="footer"></div>
</html>