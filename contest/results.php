<!DOCTYPE html>

<html>
<head>
<?php 
  function includeHeader($id="", $title="", $nav="") {
    include($_SERVER['DOCUMENT_ROOT']."/head.php");
  }
  includeHeader("contest/0/results", "Contest Results", "contests");
  include($_SERVER['DOCUMENT_ROOT'].'/php/sql_connect.php');
?>
</head>
<?php 
  function td($s, $cl=null, $id=null){
    return "<td class='$cl' id='$id'>".$s."</td>";
  }
  $problems = array("A - X00", "B - X01", "C - X02");
  $results = array(
    "me" => array(100, 0, 50),
    "you" => array(100, 50, 0),
    "they" => array(-100, 100, 0),
  );
  $sum = array();
  $ranks = array();
  foreach($results as $person => $scores){
    array_push($sum, array(array_sum($scores), $person));
  }
  sort($sum);
  $sum = array_reverse($sum);
  $cnt = 1; $cur_rank = 1;
  $prev_sc = 1e9 + 7;
  foreach($sum as $arr){
    if($arr[0] != $prev_sc){
      $cur_rank = $cnt;
    }
    $ranks[$arr[1]] = $cur_rank;
    $prev_sc = $arr[0];
    $cnt++;
  }
?>
<?php include("php/sql_connect.php"); include("Utility.php");?>
<body>
  <div id="header"></div>
  <main>
	<h1> Contest Result </h1>
  <div class="multi-container">

    <div class="table-container">
      <table class="center">
        <thead> 
          <tr>
            <td> Rank </td>
            <td> Name </td>
            <?php
              for ($i=0; $i<count($problems); $i++){
                echo td($problems[$i]);
              }
            ?>
            <td> Total </td>
          </tr>
        </thead>
        <tbody>
          <?php

            function testResultLine($rank, $name, $score){
              echo "<tr>".td($rank).td($name);
              $totalScore = 0;
              for ($i=0; $i<count($score); $i++){
                echo td($score[$i]);
                $totalScore += $score[$i];
              }
              echo td($totalScore)."</tr>";
              return;
            }
            foreach($sum as $arr) {
              testResultLine($ranks[$arr[1]], $arr[1], $results[$arr[1]]);
            }
          ?>
        </tbody>
      </table>
    </div>

    <div id="podium">   
      <div class="prize-group"><img class="pfp" src="<?php echo Utility::getProfilePicturePath(1); ?>" width="75px" height="75px"></div>
      <div class="prize-group"><img class="pfp" src="<?php echo Utility::getProfilePicturePath(2); ?>" width="75px" height="75px"></div>
      <div class="prize-group"><img class="pfp" src="<?php echo Utility::getProfilePicturePath(3); ?>" width="75px" height="75px"></div>
      <div class="prize-step"></div>
      <div class="prize-step"></div>
      <div class="prize-step"></div>
    </div>

  </div>


  </main>
  <div id="footer"></div>
</body>
</html>