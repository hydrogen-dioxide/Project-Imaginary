<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/style.css">
	<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
  <script stc="/assets/js/include.js"> </script>
<head>
<body>
<main>
<h2> Contest <span style="color: red"><?php echo $_POST['contestID']."-".$_POST['contestName']; ?></span> Preview </h2>

	<?php 
		$memoryLimit = floatval($_POST['memory']) / ($_POST['mem_u'] == "MB" ? 1 : 1024);
		$languages = array();
		foreach(["C++11", "C++14", "C++17", "Python"] as $language){
			$languages[$language] = (isset($_POST[$language]) ? "on" : "off");
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
		
		include("sql_connect.php"); if($conn == null) { die("Fail to connect SQL"); }
		
		$att = array(
			"problemID" 			=> $_POST['id'],
			"problemName" 			=> $_POST['name'],
			"timeLimit" 			=> $_POST['time'],
			"memoryLimit" 			=> $memoryLimit,
			"problemType" 			=> $_POST['type'],
			"problemAuthor" 				=> $_POST['origin'],
			"acceptedLanguages" 	=> json_encode($languages),
			"proposedTime" 			=> strval(time()),
			"problemStatement" 		=> $_POST['statement'],
			"generatedStatement" 	=> to_html(),
			"subtasks" 				=> json_encode($subtasks),
			"samples" 				=> json_encode($samples)
		);

		foreach($att as $key => $value){
			$att[$key] = '"'. $conn->real_escape_string($value) .'"';
		}

		if(mysqli_num_rows($conn->query("SELECT * FROM problem WHERE problemID = '" . $_POST["id"] . "'")) >= 1){
			$sql = "UPDATE problem\nSET ";
			foreach($att as $key => $value){
				$sql .= $key .'='. $value . ',' . "\n";
			}
			$sql = rtrim($sql, ",\n");
			$sql .= "\n WHERE problemID = '" . $conn->real_escape_string($_POST['id']) . "';";
			echo '<pre>' . htmlspecialchars($sql) . '</pre>';
			$conn->query($sql);
			if($conn->errno) echo $conn->error;
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
			$conn->query($sql);
			if($conn->errno) echo $conn->error;
		}
	?>