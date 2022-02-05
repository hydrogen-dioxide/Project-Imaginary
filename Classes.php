<?php
include("Utility.php");

class User{
	public $userID; public $userName; public $displayName; public $rank;
	public $problemCount; public $problemList = array();
	public $contestCount; public $contestList = array();

	static $userBlockFormat = ''; static $userRowFormat = '';
	function loadFromSQL($userID, $full_mode = false){
		include(Utility::$connectSQLPath);
		$userID = $conn->real_escape_string($userID);
		// Note: rank function is in O(N). But since N <= 100 in foreseeable future (i.e. 2 years), can fix it later. (aka not my work! lol)
		if($full_mode){
			$res = $conn->query("select userID, userName, displayName, problemCount, problemList, contestCount, contestList,
									(
										select 1 + count(*) 
										from user t1 
										where t1.problemCount > t.problemCount
									) rank_no
									from user t
									WHERE userID = " . Utility::squote($userID));
			if($conn->errno) echo $conn->error;
			if(!$res) { $this->userID = null; return; }
			$row = $res->fetch_assoc();
			$this->userID			= $row['userID'];
			$this->userName			= $row['userName'];
			$this->displayName		= $row['displayName'];
			$this->rank				= $row['rank_no'];
			$this->problemCount		= $row['problemCount'];
			$this->problemList		= json_decode($row['problemList'], true);
			$this->contestCount		= $row['contestCount'];
			$this->contestList		= json_decode($row['contestList'], true);
		}else{
			$res = $conn->query("select userID, userName, displayName, problemCount,
									(
										select 1 + count(*) 
										from user t1 
										where t1.problemCount > t.problemCount
									) rank_no
									from user t
									WHERE userID = " . Utility::squote($userID));
			if($conn->errno) echo $conn->error;
			if(!$res) { $this->userID = null; return; }
			$row = $res->fetch_assoc();
			$this->userID			= $row['userID'];
			$this->userName			= $row['userName'];
			$this->displayName		= $row['displayName'];
			$this->rank				= $row['rank_no'];
			$this->problemCount		= $row['problemCount'];
		}
		return;
	}

	function getBlock(): string{
		return Utility::getBlock($this->userID, $this->userName, $this->displayName);
	}

	function getRow(){
		return Utility::getUserRow($this->userID, $this->userName, $this->displayName, $this->rank, $this->problemCount);
	}
};

class Sample{

};

class Subtask{
	
};

class Problem{
	public $problemID; public $problemName; public $problemStatement; public $genereatedStatement;
	public $timeLimit; public $memoryLimit; public $problemType; public $problemAuthor; public $solved; public $attempted; public $proposedTime;
	public $acceptedLanguages = array(); public $samples = array(); public $subtasks = array();

	function loadFromSQL($problemID, $full_mode = false){
		include(Utility::$connectSQLPath);
		$problemID = $conn->real_escape_string($problemID);
		if($full_mode){
			$res = $conn->query("SELECT *
									FROM problem 
									WHERE problemID = " . Utility::squote($problemID));
			if(!$res) { $this->problemID = null; return; }
			$row = $res->fetch_assoc();
			$this->problemID				= $row['problemID'];
			$this->problemName				= $row['problemName'];
			$this->problemStatement			= $row['problemStatment'];
			$this->genereatedStatement		= $row['generatedStatement'];
			$this->timeLimit				= $row['timeLimit'];
			$this->memoryLimit				= $row['memoryLimit'];
			$this->problemType				= $row['problemType'];
			$this->problemAuthor			= $row['problemAuthor'];
			$this->solved					= $row['solved'];
			$this->attempted				= $row['attempted'];
			$this->proposedTime				= $row['proposedTime'];
			$this->acceptedLanguages		= json_decode($row['acceptedLanguages'], true);
			$this->samples					= json_decode($row['samples'], true);
			$this->subtasks					= json_decode($row['subtasks'], true);
		}else{
			$res = $conn->query("SELECT problemID, problemName, solved, attempted
									FROM problem
									WHERE problemID = " . Utility::squote($problemID));
			if(!$res) { $this->problemID = null; return; }
			$row = $res->fetch_assoc();
			$this->problemID				= $row['problemID'];
			$this->problemName				= $row['problemName'];
			$this->solved					= $row['solved'];
			$this->attempted				= $row['attempted'];
		}
		return;
	}

	function getBlock() : string{
		return Utility::getBlock($this->problemID, $this->problemName);
	}

	function getRow() : string{
		return Utility::getProblemRow($this->problemID, $this->problemName, $this->solved, $this->attempted);
	}
};

$problem = new Problem();
$t0 = microtime(true);
for($i = 0; $i < 100; $i++){
  $problem->loadFromSQL("X0000", 1);
}
$t1 = microtime(true);
for($i = 0; $i < 100; $i++){
  kloadFromSQL("X0000");
}
$t2 = microtime(true);
echo ($t1 - $t0).' '.($t2 - $t1);
class Submission{
	public $submissionID; public $submissionTime; public $language; public $score; public $verdict; public $runtime; public $memory; 
	public $problem = null; public $user = null; public $sourceCode; public $subtaskResult; public $testcaseResult;

	const VERDICT_CLASS = array(
					"Accepted"				=>		"ac", 
					"Wrong Answer"			=>		"wa", 
					"Time Limit Exceeded"	=>		"tle",
					"Runtime Error"			=>		"re",
					"Compilation Error" 	=> 		"ce");

	function loadFromSQL($submissionID, $full_mode = false){
		include(Utility::$connectSQLPath);
		$submissionID = $conn->real_escape_string($submissionID);
		if($full_mode){
			$res = $conn->query("SELECT *
									FROM submission 
									WHERE submissionID = " . Utility::squote($submissionID));
			if(!$res) { $this->submissionID = null; return; }
			$row = $res->fetch_assoc();
			$this->submissionID				= $row['submissionID'];
			$this->submissionTime			= $row['submissionTime'];
			$this->language					= $row['language'];
			$this->verdict					= $row['verdict'];
			$this->score					= $row['score'];
			$this->runtime					= $row['runtime'];
			$this->memory					= $row['memory'];
			$this->sourceCode				= $row['sourceCode'];
			$this->result					= $row['result'];
			$this->subtaskResult			= json_decode($row['subtaskResult'], true);
			$this->testcaseResult			= json_decode($row['testcaseResult'], true);
			$this->problem = new Problem(); $this->problem->loadFromSQL($problemID);
			$this->user = new User(); $this->user->loadFromSQL($userID);
		}else{
			$res = $conn->query("SELECT submissionID, problemID, userID, submissionTime, language, verdict, score, runtime, memory
									FROM submission
									WHERE submissionID = " . Utility::squote($submissionID));
			if(!$res) { $this->submissionID = null; return; }
			$row = $res->fetch_assoc();
			$this->submissionID				= $row['submissionID'];
			$this->submissionTime			= $row['submissionTime'];
			$this->language					= $row['language'];
			$this->verdict					= $row['verdict'];
			$this->score					= $row['score'];
			$this->runtime					= $row['runtime'];
			$this->memory					= $row['memory'];
			$this->problem = new Problem(); $this->problem->loadFromSQL($problemID);
			$this->user = new User(); $this->user->loadFromSQL($userID);
		}
		return;
	}

	function getRow(){
		return Utility::getSubmissionRow($this->submissionID, $this->submissionTime, $this->user->userID, $this->user->userName, $this->user->displayName,
								$this->problem->problemID, $this->problem->problemName, $this->language, $this->verdict, VERDICT_CLASS[$this->verdict], $this->runtime, $this->memory);
	}
}

class Contest{
	public $contestID; public $contestName; public $startTime; public $endTime; public $duration;
	public $problemCount; public $problemList; public $contestantCount; public $contestantList;

	function loadFromSQL($contestID, $full_mode = false){
		include(Utility::$connectSQLPath);
		$contestID = $conn->real_escape_string($contestID);
		if($full_mode){
			$res = $conn->query("SELECT *
									FROM contest 
									WHERE contestID = " . Utility::squote($contestID));
			if(!$res) { $this->contestID = null; return; }
			$row = $res->fetch_assoc();
			$this->contestID				= $row['contestID'];
			$this->contestTime				= $row['contestName'];
			$this->startTime				= $row['startTime'];
			$this->endTime					= $row['endTime'];
			$this->duration					= $row['duration'];
			$this->problemCount				= $row['problemCount'];
			$this->problemList				= json_decode($row['problemList'], true);
			$this->contestantCount			= $row['contestantCount'];
			$this->contestantList			= json_decode($row['contestantList'], true);
		}else{
			$res = $conn->query("SELECT contestID, contestName, startTime, endTime, duration, problemCount, contestantCount
									FROM contest
									WHERE contestID = " . Utility::squote($contestID));
			if(!$res) { $this->contestID = null; return; }
			$row = $res->fetch_assoc();
			$this->contestID				= $row['contestID'];
			$this->contestTime				= $row['contestName'];
			$this->startTime				= $row['startTime'];
			$this->endTime					= $row['endTime'];
			$this->duration					= $row['duration'];
			$this->problemCount				= $row['problemCount'];
			$this->contestantCount			= $row['contestantCount'];
		}
		return;
	}

	function getRow(){
		return Utility::getContestRow($this->contestID, $this->contestName, $this->contestantCount);
	}
};

class Setting{

};
$user = new User(); $user->loadFromSQL(1); 
$problem = new Problem(); $problem->loadFromSQL(1); 
$contest = new Contest(); $contest->loadFromSQL(1); 
$submission = new Submission(); $submission->loadFromSQL(1);
?>