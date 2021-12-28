<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/style.css">
	<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
	<script>
		function copy_code(id) {
			var copyText = document.getElementById(id).innerText;
			navigator.clipboard.writeText(copyText);
			sendNotification();
		}
	</script>

<head>
<body>
<main>
<h2> Problem <span style="color: red"><?php echo $_POST['name']; ?></span> Preview </h2>
<?php 
	$header = "<!DOCTYPE HTML>
<html>

<head>
	<title>TWGSS Online Judge</title>
	<link rel='stylesheet' type='text/css' href='/style.css'>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<link rel='icon' href='/assets/image/icon.png'>
	<script id='MathJax-script' async src='https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js'></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'>
		$(document).ready(function(){
			$('#header').load('/header.html', null, function () { $('.nav-' + location.pathname.split('/')[1]).addClass('active'); });
			$('#footer').load('/footer.html');
		});
	</script>
	<script src='/assets/js/include.js'></script>
	<script>
		function copy_code(id) {
			var copyText = document.getElementById(id).innerText;
			navigator.clipboard.writeText(copyText);
			sendNotification();
		}
	</script>
</head>

<body>
	<div id='header'></div>
	<main>
";

	$footer = "
	</main>
	<div id='footer'></div>
</body>
</html>
";

	function get_info(){
		$result = sprintf("
	<div class='problem-head'>
		<div class='problem-id'>%s</div>
		<div class='problem-name'>%s</div>
	</div>
	<div class='stat-block'>
		<div class='stat-label'> <img class='page-icon' src='/assets/image/icon_timelimit.png'> Time </div>
		<div class='stat-no'> %s s </div>
	</div>
	<div class='stat-block'>
		<div class='stat-label'> <img class='page-icon' src='/assets/image/icon_memlimit.png'> Memory </div>
		<div class='stat-no'> %s %s </div>
	</div>
	
	<button onclick='location.href += '/submit.html'' class='btn submit'> Submit </button>
	<button onclick='location.href += '/submissions.php'' class='btn submission'> Submissions </button> 
	<button onclick='location.href += '/statistics.php'' class='btn statistic'> Statistics </button> 
	<button onclick='location.href += '/set.php'' class='btn setting'> Setting </button>
	", $_POST['id'], $_POST['name'], $_POST['time'], $_POST['memory'], $_POST['mem_u']);
		return $result; 
	}
	
	function get_samples(){
		$result = "
	  	<table class='sample-tests'>
		<thead> <tr>
		  	<th class='sample-heading'> # </th>
		  	<th class='sample-heading'> Input </th>
		  	<th class='sample-heading'> Output </th>
		  	<th width='100%'></th>
		</tr> </thead>
		<tbody>";

		for($i = 1; $i <= $_POST['sample-count']; $i++){
			$sample_in = $_POST['sample-in'][$i];
			$sample_in = str_replace("\n", "<br>", $sample_in);
			$sample_out = $_POST['sample-out'][$i];
			$sample_out = str_replace("\n", "<br>", $sample_out);
			$sample_explanation = trim($_POST['sample-explanation'][$i]);
			$result .= "
			<tr>
				<td class='stylized-number'> $i </td>
				<td class='sample-io code copyable' id='sample-$i-in' ondblclick='copy_code(this.id)'> $sample_in </td>
				<td class='sample-io code copyable' id='sample-$i-out' ondblclick='copy_code(this.id)'> $sample_out </td>
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
	
	function get_subtasks(){
		$result = "
		<table class='subtasks'>
		<thead> <tr>
			<th class='sample-heading'> # </th>
			<th class='sample-heading'> Points </th>
			<th class='sample-heading'> Constraints </th>
		</tr> </thead>
		<tbody>";
		
		for($i = 1; $i <= $_POST['subtask-count']; $i++){
			$subtask_id = $i;
			$subtask_points = $_POST['subtask-points'][$i];
			$subtask_constraint = trim($_POST['subtask-constraint'][$i]);
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
	
	// how to support image in the layout?
	function to_html(){
    global $header, $footer;
		$statement = $_POST['statement'];
		$result = "";
		$result .= $header;
		$result .= get_info();
		$escape_mode = false;
		$result .= "<section>\n"; // empty section for simplicity
		foreach(explode("\n", $statement) as $line){
			$line = trim($line);
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
							$result .= get_samples();
						}else if($title == "SUBTASKS"){
							$result .= get_subtasks();
						}else{
							$escape_mode = false;
						}
					}
				}else{
					$result .= "\t<p>" . $line . "<p>\n";
				}
			}
		}
		$result .= "\t</section>\n";
		$result .= $footer;
		return $result;
	}
	if (!file_exists("../problems/" . $_POST["id"])) {
		mkdir("../problems/" . $_POST["id"], 0777, true);
	}
	$file = fopen("../problems/" . $_POST["id"] . "/problem_statement.html", "w");
	fwrite($file, to_html());
	fclose($file);
	echo to_html();
?>
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
			"author" 				=> $_POST['origin'],
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

		if(mysqli_num_rows($conn->query("SELECT * FROM problem WHERE problemID = " . $_POST["id"])) >= 1){
			$sql = "UPDATE problem\nSET ";
			foreach($att as $key => $value){
				$sql .= $key .' ='. $value . '=,' . "\n";
			}
			$sql = rtrim($sql, ",\n");
			$sql .= "\n WHERE problemID = " . $conn->real_escape_string($_POST['id']) . ';';
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
	<table>
		<tbody>
			<tr>
				<td style="min-width: 100px"> Task ID </td>
				<td> <?php echo $_POST["id"]; ?> </td>
			</tr>
			<tr>
				<td> Task Name </td>
				<td> <?php echo $_POST["name"]; ?> </td>
			</tr>
			<tr>
				<td> Time Limit </td>
				<td> <?php echo $_POST["time"]; ?> s</td>
			</tr>
			<tr>
				<td> Mem Limit </td>
				<td> <?php echo $_POST["memory"]; ?> <?php echo $_POST["mem_u"]; ?> </td>
			</tr>
			<tr>
				<td> Type </td>
				<td> <?php echo $_POST["type"]; ?> </td>
			</tr>
			<tr>
				<td> Origin </td>
				<td> <?php echo $_POST["origin"]; ?> </td>
			</tr>
			<tr>
				<td> Language </td>
				<td> <?php 
						$init = true;
						foreach(["C++11", "C++14", "C++17", "Python"] as $language){
							if(isset($_POST[$language])){
								echo (!$init?", ":"") . $language; $init = false;
							}
						} ?> </td>
			</tr>
		</tbody>
	</table>

</main>
</body>
</html>