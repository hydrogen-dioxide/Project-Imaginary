<?php

class Problem{
	public $problemID; public $problemName; public $problemStatement; public $generatedStatement;
	public $timeLimit; public $memoryLimit; public $problemType; public $problemAuthor; public $solved; public $attempted; public $proposedTime;
	public $acceptedLanguages = array(); public $samples = array(); public $subtasks = array();

	// Methods:
  // __construct();
	// loadFromSQL($problemID);
	// loadFromForm();
	// toHTML();
  // getPreview();
	// updateFile(); =>  need
	// uploadToSQL();

	// getInfo($problemID, $problemName, $timeLimit, $memoryLimit, $memoryUnit);
	// getSubtasks($subtasks);
	// getSamples($samples);
	
	// Static variables:
	// languageList
	// header
	// footer

	function __construct(){
    $this->problemID = "";
    $this->problemName = "";
    $this->timeLimit = "2"; // in seconds
    $this->memoryLimit = "256"; // in MB
    $this->problemType = "batch";
    $this->problemAuthor = "myself";
    $this->acceptedLanguages = json_decode('{ "C++11": "on", "C++14": "on", "C++17": "on", "Python": "on" }');
    $this->proposedTime = strval(time());
    $this->problemStatement = "#Input\n\n#Output\n\n#Sample Tests\n\n#Constraints\n\n#Subtasks\n";
    $this->subtasks = array();
    $this->samples = array();
  }

	function loadFromSQL($problemID){
    include("sql_connect.php");
		$problemID = $conn->real_escape_string($problemID);

		$res = $conn->query("SELECT *
								FROM problem 
								WHERE problemID = '$problemID'") or die($conn->error);
		if(!$res) { $this->problemID = null; return false; }
		$row = $res->fetch_assoc();
		$this->problemID				= $row['problemID'];
		$this->problemName				= $row['problemName'];
		$this->problemStatement			= $row['problemStatement'];
		// $this->generatedStatement		= $row['generatedStatement'];
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
		return true;
	}
	
	function loadFromForm(){
		if(!$_POST['problemID']) return false;
		$memoryLimit = floatval($_POST['memoryLimit']) / ($_POST['mem_u'] == "MB" ? 1 : 1024);
		$acceptedLanguages = array();
		foreach(Problem::$languageList as $language){
			$acceptedLanguages[$language] = (isset($_POST[$language]) ? "on" : "off");
		}
		$subtasks = array();
		for($i = 1; $i <= $_POST['subtask-count']; $i++){
			$subtask_id = $i;
			$subtask_points = $_POST['subtask-points'][$i];
			$subtask_constraint = trim($_POST['subtask-constraint'][$i]);
			$subtasks[strval($i)] = array("id"				=> strval($i), 
										  "points"			=> $_POST['subtask-points'][$i], 
										  "test_cases_L"	=> $_POST['subtask-test_cases_L'][$i],
										  "test_cases_R"	=> $_POST['subtask-test_cases_R'][$i],
										  "constraint"		=> trim($_POST['subtask-constraint'][$i]), 
										  "dependencies"	=> $_POST['subtask-dependencies'][$i]);
		}
		
		$samples = array();
		for($i = 1; $i <= $_POST['sample-count']; $i++){
			$sample_in = $_POST['sample-in'][$i];
			$sample_out = $_POST['sample-out'][$i];
			$sample_explanation = trim($_POST['sample-explanation'][$i]);
			$samples[strval($i)] = array("in"			=> $_POST['sample-in'][$i], 
										 "out"			=> $_POST['sample-out'][$i], 
										 "explanation"	=> $_POST['sample-explanation'][$i]);
		}
		$this->problemID				= $_POST['problemID'];
		$this->problemName				= $_POST['problemName'];
		$this->problemStatement			= $_POST['problemStatement'];
		$this->timeLimit				= $_POST['timeLimit'];
		$this->memoryLimit				= $memoryLimit;
		$this->problemType				= $_POST['problemType'];
		$this->problemAuthor			= $_POST['problemAuthor'];
		// $this->solved				= 0;
		// $this->attempted				= 0;
		// $this->proposedTime			= 0;
		$this->acceptedLanguages		= $acceptedLanguages;
		$this->samples					= $samples;
		$this->subtasks					= $subtasks;
		return true;
	}

	function getInfo($id, $name, $time, $memory, $mem_u){
		return "
	<h1 class='page-head'>
		<div class='problem-id page-head-id'>$id</div>
		<div class='problem-name page-head-name'>$name</div>
	</h1>
	<div class='problem-info-bar'>
		<div class='all-stats-block'>
			<div class='stat-block'>
				<span class='stat-label'> <img class='page-icon' src='/assets/image/icon_timelimit.svg'><span class='portrait-hide'>Time</span> </span>
				<span class='stat-no'> $time s </span>
			</div>
			<div class='stat-block'>
				<span class='stat-label'> <img class='page-icon' src='/assets/image/icon_memlimit.svg'><span class='portrait-hide'>Memory</span> </span>
				<span class='stat-no'> $memory $mem_u </span>
			</div>
		</div>

		<div class='all-problem-buttons'>
			<button onclick='location.href += \"/submit\"' class='btn submit'> Submit </button>
			<button onclick='location.href += \"/submissions\"' class='btn submission'> Submissions </button> 
			<button onclick='location.href += \"/stats\"' class='btn statistic'> Statistics </button> 
			<button onclick='location.href += \"/set\"' class='btn setting'> Setting </button>
		</div>
	</div>
	";
	}
	
	function getSamples($samples){
		$result = "
	  	<table class='sample-tests'>
		<thead> <tr>
		  	<th class='sample-heading'> # </th>
		  	<th class='sample-heading'> Input </th>
		  	<th class='sample-heading'> Output </th>
		  	<th width='100%'></th>
		</tr> </thead>
		<tbody>";

		for($i = 1; $i <= count($samples); $i++){
			$sample_in = $samples[$i]['in'];
			$sample_in = str_replace("\n", "<br>", $sample_in);
			$sample_out = $samples[$i]['out'];
			$sample_out = str_replace("\n", "<br>", $sample_out);
			$sample_explanation = trim($samples[$i]['explanation']);
			$result .= "
			<tr>
				<td class='stylized-number'> $i </td>
				<td class='sample-io code copyable' id='sample-$i-in' ondblclick='copy_code(this.id)' title='Double Click to Copy'> $sample_in </td>
				<td class='sample-io code copyable' id='sample-$i-out' ondblclick='copy_code(this.id)' title='Double Click to Copy'> $sample_out </td>
			</tr>
			<tr>
				<td></td>
				<td class='sample-explanation' colspan='3'> $sample_explanation </td>
			</tr>";
		}
		$result .= "
		</tbody> </table>\n";
		return $result;
	}
	
	function getSubtasks($subtasks){
		$result = "
		<table class='subtasks'>
		<thead> <tr>
			<th class='sample-heading'> # </th>
			<th class='sample-heading'> Points </th>
			<th class='sample-heading'> Constraints </th>
		</tr> </thead>
		<tbody>";
		
		for($i = 1; $i <= count($subtasks); $i++){
			$subtask_points = $subtasks[$i]['points'];
			$subtask_constraint = trim($subtasks[$i]['constraint']);
			$result .= "
			<tr>
				<td class='stylized-number'> $i </td>
				<td id='subtask-$i' class='subtask-points'> $subtask_points </td>
				<td id='subtask-$i-constraint' class='subtask-constraint'> $subtask_constraint </td>
			</tr>";
		}
		
		$result .= "
		</tbody> </table>\n";
		return $result;
	}
	
	function toHTML(){
		if(!$this->problemID) return false;
		$memory = $this->memoryLimit;
		if($memory < 1){
			$mem_u = "KB"; $memory *= 1024;
		}else{
			$mem_u = "MB";
		}
		$result = "";
		$result .= Problem::getInfo($this->problemID, $this->problemName, $this->timeLimit, $memory, $mem_u);
		$escape_mode = false;
		$result .= "<section>\n"; // empty section for simplicity
		foreach(explode("\n", $this->problemStatement) as $line){
			$line = trim($line);
			if($line == "\n") continue;
			if($escape_mode == true){
				if($line == "#ESCAPE"){
					$escape_mode = false;
				}else{
					$result .= $line;
				}
			}else{
				if(strlen($line) >= 2 && $line[0] == "/" && $line[1] == "/") continue;
				if(strlen($line) == 0) continue;
				if($line[0] == '#'){ // subheading
					$title = strtoupper(trim(substr($line, -strlen($line) + 1)));
					if($title == "ESCAPE"){
						$escape_mode = true;
					}else{
						$result .= "\t</section>\n";
						$result .= "\t<section>\n";
						$result .= "\t\t<h2 class='subheading'>" . $title . "</h2>\n";
						if($title == "SAMPLE TESTS"){
							$result .= Problem::getSamples($this->samples);
						}else if($title == "SUBTASKS"){
							$result .= Problem::getSubtasks($this->subtasks);
						}else{
							$escape_mode = false;
						}
					}
				}else{
					$result .= "\t<p>" . $line . "</p>\n";
				}
			}
		}
		$result .= "\t</section>\n";

		$result = preg_replace_callback('/`.*?`/', function ($matches) {
			return '<span class="inline-code">' . substr($matches[0], 1, strlen($matches[0]) - 2) . '</span>'; 
		}, $result);
		return $result;
	}
	
  function getPreview(){
		if(!$this->problemID) return false;
		$result = "";
		$escape_mode = false;
		$result .= "<section>\n"; // empty section for simplicity
		foreach(explode("\n", $this->problemStatement) as $line){
			$line = trim($line);
			if($line == "\n") continue;
			if($escape_mode == true){
				if($line == "#ESCAPE"){
					$escape_mode = false;
				}else{
					$result .= $line;
				}
			}else{
				if(strlen($line) >= 2 && $line[0] == "/" && $line[1] == "/") continue;
				if(strlen($line) == 0) continue;
				if($line[0] == '#'){ // subheading
					$title = strtoupper(trim(substr($line, -strlen($line) + 1)));
					if($title == "ESCAPE"){
						$escape_mode = true;
					}else{
						$result .= "\t</section>\n";
						$result .= "\t<section>\n";
						$result .= "\t\t<h2 class='subheading'>" . $title . "</h2>\n";
						if($title == "SAMPLE TESTS"){
							$result .= Problem::getSamples($this->samples);
						}else if($title == "SUBTASKS"){
							$result .= Problem::getSubtasks($this->subtasks);
						}else{
							$escape_mode = false;
						}
					}
				}else{
					$result .= "\t<p>" . $line . "</p>\n";
				}
			}
		}
		$result .= "\t</section>\n";
		$result = preg_replace_callback('/`.*?`/', function ($matches) {
			return '<span class="inline-code">' . substr($matches[0], 1, strlen($matches[0]) - 2) . '</span>'; 
		}, $result);
		return $result;
  }

	function updateFile(){
	/*	if (!file_exists("../problem/" . $this->problemID)) {
		  mkdir("../problem/" . $this->problemID, 0777, true);
		}
		$file = fopen("../problem/" . $this->problemID . "/index.php", "w");
		fwrite($file, $this->generatedStatement);
		fclose($file);

		$file = fopen("../problem/" . $this->problemID . "/set.php", "w");
		fwrite($file, str_replace("TO_BE_REPLACED", $this->problemID, file_get_contents("../problem/SAMPLE/set.php")));
		fclose($file);

		$file = fopen("../problem/" . $this->problemID . "/stats.php", "w");
		fwrite($file, str_replace("TO_BE_REPLACED", $this->problemID, file_get_contents("../problem/SAMPLE/stats.php")));
		fclose($file);

		$file = fopen("../problem/" . $this->problemID . "/submissions.php", "w");
		fwrite($file, str_replace("TO_BE_REPLACED", $this->problemID, file_get_contents("../problem/SAMPLE/submissions.php")));
		fclose($file);

		$file = fopen("../problem/" . $this->problemID . "/submit.php", "w");
		fwrite($file, str_replace("TO_BE_REPLACED", $this->problemID, file_get_contents("../problem/SAMPLE/submit.php")));
		fclose($file);
  	*/
	}

	function uploadToSQL(){
		include("sql_connect.php"); if($conn == null) return false;
		if($this->problemID == null) return false;
		$att = array(
			"problemID" 			=> $this->problemID,
			"problemName" 			=> $this->problemName,
			"timeLimit" 			=> $this->timeLimit,
			"memoryLimit" 			=> $this->memoryLimit,
			"problemType" 			=> $this->problemType,
			"problemAuthor" 		=> $this->problemAuthor,
			"acceptedLanguages" 	=> json_encode($this->acceptedLanguages),
			"proposedTime" 			=> strval(time()),
			"problemStatement" 		=> $this->problemStatement,
			"generatedStatement" 	=> ($generatedStatement ? $generatedStatement : Problem::toHTML()),
			"subtasks" 				=> json_encode($this->subtasks),
			"samples" 				=> json_encode($this->samples)
		);

		foreach($att as $key => $value){
			$att[$key] = '"'. $conn->real_escape_string($value) .'"';
		}

		if(mysqli_num_rows($conn->query("SELECT problemID FROM problem WHERE problemID = '" . $this->problemID . "'"))){
			$sql = "UPDATE problem\nSET ";
			foreach($att as $key => $value){
				$sql .= $key .'='. $value . ',' . "\n";
			}
			$sql = rtrim($sql, ",\n");
			$sql .= "\n WHERE problemID = ".$att['problemID'].";";
			echo '<pre>' . htmlspecialchars($sql) . '</pre>';
			$conn->query($sql); if($conn->errno) echo $conn->error;
		}else{
			$sql = "INSERT INTO problem (";
			foreach($att as $key => $value){
				$sql .= $key . ",";
			}
			$sql = rtrim($sql, ",");
			$sql .= ")\nVALUES (";
			foreach($att as $key => $value){
				$sql .= $value . ", \n";
			}
			$sql = rtrim($sql, ", \n");
			$sql .= ');';
			echo '<pre>' . htmlspecialchars($sql) . '</pre>';
			$conn->query($sql); if($conn->errno) echo $conn->error;
		}
	}
	
	static $languageList = ["C++11", "C++14", "C++17", "Python"];
} 
?>