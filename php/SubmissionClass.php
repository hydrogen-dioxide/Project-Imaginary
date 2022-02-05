<?php

class Submission{
  public $submissionID;
  public $userID; public $userName;
  public $problemID; public $problemName;
  public $contestID; public $contestName;
  public $verdict; public $score; public $runtime; public $memory;
  public $results;
  public $sourceCode;

	// Methods:
	// loadFromSQL($submissionID);
	// loadFromString($input);
  // uploadToSQL();
  
	// arrayGetNext(&$arr, &$idx);
	

  function loadFromSQL($submissionID){
    include($_SERVER['DOCUMENT_ROOT']."/php/sql_connect.php");
    $sql = "SELECT * FROM submission
            WHERE submissionID = '".$conn->real_escape_string($submissionID)."'";
    $row = $conn->query($sql)->fetch_assoc() or die($conn->error);
    $this->submissionID = $row['submissionID'];
    $this->userID = $row['userID'];
    $this->userName = $row['userName'];
    $this->problemID = $row['problemID'];
    $this->problemName = $row['problemName'];
    $this->contestID = $row['contestID'];
    $this->contestName = $row['contestName'];
    $this->verdict = $row['verdict'];
    $this->score = (float) $row['score'];
    $this->runtime = (float) $row['runtime'];
    $this->memory = (float) $row['memory'];
    $this->results = json_decode($row['results'], true);
    $this->sourceCode = $row['sourceCode'];
  }

  function arrayGetNext(&$arr, &$idx){
    while($arr[$idx] == "") $idx++;
    return $arr[$idx++];
  }

  function loadFromString($input){
    $arr = preg_split('/[\n\s]+/', $input);
    $idx = 0;
    $this->verdict = Submission::arrayGetNext($arr, $idx);
    if($verdict == "SE" || $verdict == "CE") return;
    $this->score = (float) Submission::arrayGetNext($arr, $idx);
    $this->runtime = (float) Submission::arrayGetNext($arr, $idx);
    $this->memory = (float) Submission::arrayGetNext($arr, $idx);
    $lineCount = (int) Submission::arrayGetNext($arr, $idx);
    $tcs = array(); $sts = array();
    for($i = 1; $i <= $lineCount; $i++){
      $st = Submission::arrayGetNext($arr, $idx); 
      $stc = Submission::arrayGetNext($arr, $idx); 
      $v = Submission::arrayGetNext($arr, $idx);
      if($v == "INC"){
        $prev = Submission::arrayGetNext($arr, $idx); 
        $sc = Submission::arrayGetNext($arr, $idx);
        $tc = array(
          "subtask" => $st,
          "verdict"=> $v,
          "score"=> $sc,
          "including"=> $prev
        );
        array_push($tcs, $tc);
  		}else if($v == "SK"){
        $tc = array(
          "subtask"=> $st,
          "subtaskCase"=> $stc,
          "verdict"=> $v,
        );
        array_push($tcs, $tc);
      }else{
        $sc = Submission::arrayGetNext($arr, $idx); 
        $run = Submission::arrayGetNext($arr, $idx); 
        $mem = Submission::arrayGetNext($arr, $idx);
        $tc = array(
          "subtask"=> $st,
          "subtaskCase"=> $stc,
          "verdict"=> $v,
          "score"=> $sc,
          "runtime"=> $run,
          "memory"=> $mem
        );
        array_push($tcs, $tc);
      }
    }
    
    $subtaskCount = (int) Submission::arrayGetNext($arr, $idx);
    for($i = 1; $i <= $subtaskCount; $i++){
      $st = $i; 
      $v = Submission::arrayGetNext($arr, $idx); 
      $ts = Submission::arrayGetNext($arr, $idx); 
      $s = Submission::arrayGetNext($arr, $idx); 
      $last = Submission::arrayGetNext($arr, $idx);
      $st = array(
        "subtask"=> $st,
        "verdict"=> $v,
        "totalScore"=> $ts,
        "score"=> $s
      );
      array_push($sts, $st);
    }

    $results = array(
      "testcases"=> $tcs,
      "subtasks"=> $sts
    );

    $this->results = $results;
    return $results;
  }

}
?>