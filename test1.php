<!DOCTYPE HTML>

<html>

<head>
  <?php
  function includeHeader($id="", $title="", $nav="") {
    include($_SERVER['DOCUMENT_ROOT']."/head.php");
  }
  includeHeader("problems", "Problems", "problems"); ?>
  <style>
    main>section{
      display: none;
    }*/
  </style>
</head>
<body onload="setID('task_info');">
<div id="header"></div>
<main>

<script>
	function setID(id){
		document.getElementById("task_info").style.display = "none";
		document.getElementById("preview").style.display = "none";
		document.getElementById("test_data").style.display = "none";
		document.getElementById("solutions").style.display = "none";
		var div = document.getElementById(id);
		div.style.display = "inherit";
	}
</script>

<h1>Problem Setting</h1>

<button onclick="setID('task_info')"> Task Info </button> <button onclick="setID('preview'); showProblem('β001')"> Preview </button> <button onclick="setID('test_data')"> Test data </button> <button onclick="setID('solutions')"> Solutions </button>

<section id="task_info">
	<style>
		.user-input{
			height: 100%; width: 100%; border: 0px; padding: 0px; font-family: 'Source Sans Pro'; font-size: 16px;
		}
	</style>
  <section>
    <button onclick="location.href = 'help.php'"> HELP </button>
  </section>
	<!-- <form action="load_problem.php" method="GET" target="bin"> <h2> Load Problem: <input type="text" name="problemID"> </input> <button class="btn submit" type="submit"> Submit </button></h2> </form> -->

	<?php include("php/sql_connect.php");
    $taskID = $_GET['taskID'];
		$problem = array(
					"problemID"			=> "",
					"problemName"		=> "", 
					"timeLimit"			=> "2", 
					"memoryLimit"		=> "256",
					"problemType"		=> "batch", 
					"problemAuthor"			=> "myself", 
					"acceptedLanguages" => '{ "C++11": "on", "C++14": "on", "C++17": "on", "Python": "on" }',
					"proposedTime"		=> strval(time()),
					"problemStatement"	=> "#Input\n\n#Output\n\n#Sample Tests\n\n#Constraints\n\n#Subtasks\n",
					"subtasks"			=> "{}",
					"samples"			=> "{}");
		foreach($problem as $key => $value){
			if($key != "acceptedLanguages" && $key != "subtasks" && $key != "samples") $problem[$key] = htmlspecialchars($value);
		}
		
		if($taskID){
			$result = $conn->query("SELECT * FROM `problem` WHERE `problemID` = " . "'" . $conn->real_escape_string($taskID) . "';");
			if(mysqli_num_rows($result) >= 1){
        $problem = mysqli_fetch_assoc($result);
				if($conn->errno) echo $conn->error;
			}
		}
		$problemID			= htmlspecialchars($problem['problemID']);
		$problemName		= htmlspecialchars($problem['problemName']);
		$timeLimit			= htmlspecialchars($problem['timeLimit']);
		$memoryLimit		= htmlspecialchars($problem['memoryLimit']);
		$problemType		= htmlspecialchars($problem['problemType']);
		$problemAuthor				= htmlspecialchars($problem['problemAuthor']);
		$acceptedLanguages	= json_decode($problem['acceptedLanguages'], true);
		$proposedTime		= htmlspecialchars($problem['proposedTime']);
		$problemStatement	= htmlspecialchars($problem['problemStatement']);
		$subtask_array		= json_decode($problem['subtasks'], true);
		$sample_array		= json_decode($problem['samples'], true);
	?>
  
	<form action="/php/update_task.php" method="POST">
  <section>
    <h2>Basic Info</h2>
		<div class="table-container">
    <table>
			<tbody>
				<tr>
					<td style="min-width: 200px;"><label for="id">Task ID (4-6 Characters)</label></td>
					
					<td><input type="text" id="id" class="input px-3 py-2 border-2" name="problemID" required minlength="4" maxlength="6" size="10" value="<?php echo $problemID ?>"></td>
				</tr>
				<tr>
					<td><label for="name">Problem name (max. 50 Characters)</label></td>
					
					<td><input type="text" id="name" class="input px-3 py-2 border-2" name="problemName" required minlength="1" maxlength="50" size="50" value="<?php echo $problemName ?>"></td>
				</tr>
				<tr>
					<td><label for="time">Time limit</label></td>
					
					<td><input type="number" id="time" class="input px-3 py-2 border-2" name="timeLimit" min="0.1" max="60" step="0.1" size="10" value="<?php echo $timeLimit ?>"> s</td>
				</tr>
				<tr>
					<td><label for="memory">Memory limit</label></td>
					
					<td>
						<input type="number" id="memory" class="input px-3 py-2 border-2" name="memoryLimit" min="1" max="1024" step="1" size="10" value="<?php echo $memoryLimit ?>">
						<select name="mem_u" class="input px-3 py-2" >
							<option value="KB" >KB</option>
							<option value="MB" selected>MB</option>
						</select>
					</td>
				</tr>
				<tr>
					<td><label for="name">Problem type</label></td>
					
					<td><input type="text" id="type" class="input px-3 py-2 border-2" name="problemType" required minlength="1" maxlength="50" size="50" value="<?php echo $problemType ?>"></td>
				</tr>
				<tr>
					<td><label for="origin">Problem origin</label></td>
					
					<td><input type="text" id="origin" class="input px-3 py-2 border-2" name="problemAuthor" maxlength="50" size="50" value="<?php echo $problemAuthor ?>"></td>
				</tr>
				<tr>
					<td><label for="language">Accepted Language</label></td>
					
					<td>
						<input type="checkbox" id="cpp11" name="C++11" value="on" <?php echo ($acceptedLanguages["C++11"] == "on" ? "checked" : ""); ?> >
						<label>C++ 11</label>
						<input type="checkbox" id="cpp14" name="C++14" value="on" <?php echo ($acceptedLanguages["C++14"] == "on" ? "checked" : ""); ?> >
						<label>C++ 14</label>
						<input type="checkbox" id="cpp17" name="C++17" value="on" <?php echo ($acceptedLanguages["C++17"] == "on" ? "checked" : ""); ?> >
						<label>C++ 17</label>
						<input type="checkbox" id="python" name="Python" value="on" <?php echo ($acceptedLanguages["Python"] == "on" ? "checked" : ""); ?> >
						<label>Python</label>
					</td>
				</tr>
				<tr>
					<td style="min-width: 200px;"> <label for="problem_statement"> Problem Statement </label> </td>
					
					<td> <textarea class="code" cols="60" rows="20" name="problemStatement" style="resize: none; white-space: pre-wrap; overflow-wrap: normal;"><?php echo $problemStatement; ?></textarea> </td>
				</tr>
			</tbody>
		</table>
    </div>
    </section>
		
    <section>
		<h2> Upload </h2>
		<div class="table-container">
    <table>
			<tbody>
				<tr>
					<td> <label for="test_cases"> Test Cases </label> </td>
					
					<td> <input type="file" name="test_cases" multiple>  </td>
				</tr>
				<tr>
					<td> <label for="checker"> Checker </label> </td>
					
					<td> <input type="file" name="checker" multiple>  </td>
				</tr>
				<tr>
					<td> <label for="validator"> Validator </label> </td>
					
					<td> <input type="file" name="validator" multiple>  </td>
				</tr>
				<tr>
					<td> <label for="expected_solution"> Expected solution(s) </label> </td>
					
					<td> <input type="file" name="expected_solution" multiple>  </td>
				</tr>
				<tr>
					<td> <label for="suboptimal_solution"> Suboptimal solution(s) </label> </td>
					
					<td> <input type="file" name="suboptimal_solution" multiple>  </td>
				</tr>
				<tr>
					<td> <label for="scorer"> Scorer </label> </td>
					
					<td> <input type="file" name="scorer" multiple>  </td>
				</tr>
			</tbody>
		</table>
    </div>
    </section>

    <section>
		<h2> Subtask </h2>
		<style>
			#subtasks td {
				border: 1px solid var(--TWGSS-green, black);
			}
			#subtasks-table td {
				border: 1px solid var(--TWGSS-green, black);
			}
		</style>
		<button id="add_subtask" type="button" onclick="addSubtaskField();"> Add Subtask </button>
		<button id="del_subtask" type="button" onclick="delSubtaskField();"> Delete Subtask </button>
		<button id="rearrange_subtask" type="button" onclick=""> Rearrange Subtasks </button>
		<br>
		<br>
    <div class="table-container">
		<table style="visibility: hidden; display:none;">
			<tr id="sample-subtask" style="padding: 0px;">
				<td> 0 </td>
				<td> <input class="user-input" type="number" min="0" max="100" step="1" name="subtask-points[]" value=""> </td>
				<td> <input class="user-input" type="number" min="1" max="100" step="1" name="subtask-test_cases_L[]" value=""> </td>
				<td> <input class="user-input" type="number" min="1" max="100" step="1" name="subtask-test_cases_R[]" value=""> </td>
				<td> <input class="user-input" type="text" name="subtask-dependencies[]" value=""> </td>
				<td> <input class="user-input" type="text" name="subtask-constraint[]" value=""> </td>
			</tr>
		</table>
    </div>
    <div class="table-container">
		<table id="subtasks" style="table-layout: fixed; border: 1px solid var(--TWGSS-green, black); border-collapse: collapse;">
			<thead>
				<tr>
				<td style="min-width: 100px" rowspan="2"> Subtask no. </td>
				<td style="min-width: 100px" rowspan="2"> Points </td>
				<td style="min-width: 100px" colspan="2"> Test Cases </td>
				<td style="min-width: 100px" rowspan="2"> Dependencies </td>
				<td style="min-width: 600px" rowspan="2"> Constraint </td>
				</tr>

				<tr>
				<td> From </td>
				<td> To </td>
				</tr>
			</thead>
			<tbody id="subtasks-table">
			<?php
			for($i = 1; $i <= sizeof($subtask_array); $i++){
				echo "
					<tr id='sample-subtask-$i' style='padding: 0px;'>
						<td> $i </td>
						<td> <input class='user-input' type='number' min='0' max='100' step='1' name='subtask-points[]' value='" . htmlspecialchars($subtask_array[strval($i)]['points']) . "'> </td>
						<td> <input class='user-input' type='number' min='1' max='100' step='1' name='subtask-test_cases_L[]' value='" . htmlspecialchars($subtask_array[strval($i)]['test_case_L']) . "'> </td>
						<td> <input class='user-input' type='number' min='1' max='100' step='1' name='subtask-test_cases_R[]' value='" . htmlspecialchars($subtask_array[strval($i)]['test_cases_R']) . "'> </td>
						<td> <input class='user-input' type='text' name='subtask-dependencies[]' value='" . htmlspecialchars($subtask_array[strval($i)]['dependencies']) . "'> </td>
						<td> <input class='user-input' type='text' name='subtask-constraint[]' value='" . htmlspecialchars($subtask_array[strval($i)]['constraint']) . "'> </td>
					</tr>
				";
			}
			?>
			</tbody>
			<input style="display: none;" name="subtask-count" id="subtask-count" type="number">
		</table>
    </div>
    </section>

    <section>
		<h2> Sample Cases </h2>
		<button id="add_sample" type="button" onclick="addSampleField();"> Add Sample </button>
		<button id="del_sample" type="button" onclick="delSampleField();"> Delete Sample </button>
    <div class="table-container">
		<table style="visibility: hidden; display:none;">
			<tr id="sample-case" style="padding: 0px;">
				<td> 0 </td>
				<td> <textarea name="sample-in[]" cols="40" rows="7" class="code" type="text" style="resize: none; white-space: pre-wrap; overflow-wrap: normal;"></textarea> </td>
				<td> <textarea name="sample-out[]" cols="40" rows="7" class="code" type="text" style="resize: none; white-space: pre-wrap; overflow-wrap: normal;"></textarea> </td>
				<td> <textarea name="sample-explanation[]" cols="40" rows="7" class="code" type="text" style="resize: none; white-space: pre-wrap; overflow-wrap: normal;"></textarea> </td>
			</tr>
		</table>
    </div>
    <div class="table-container">
		<table style="border: 0px;">
			<thead>
				<tr>
				<td style="min-width: 100px"> Sample # </td>
				<td style="min-width: 100px"> Input </td>
				<td style="min-width: 100px"> Output </td>
				<td style="min-width: 100px"> Explanation </td>
				</tr>
			</thead>
			<tbody id="samples-table">
			<?php
			for($i = 1; $i <= sizeof($sample_array); $i++){
				echo "
					<tr id='sample-case-$i' style='samplepadding: 0px;'>
						<td> $i </td>
						<td> <textarea name='sample-in[]' cols='40' rows='7' class='code' type='text' style='resize: none;' >". htmlspecialchars($sample_array[strval($i)]['in']) ."</textarea> </td>
						<td> <textarea name='sample-out[]' cols='40' rows='7' class='code' type='text' style='resize: none;' >". htmlspecialchars($sample_array[strval($i)]['out']) ."</textarea> </td>
						<td> <textarea name='sample-explanation[]' cols='40' rows='7' class='code' type='text' style='resize: none;' >". htmlspecialchars($sample_array[strval($i)]['explanation']) ."</textarea> </td>
					</tr>
				";
			}
			?>
			</tbody>
			<input style="display: none;" name="sample-count" id="sample-count" type="number">
		</table>
    </div>
		<script>
			function addSubtaskField(strict = false) {
				var tr = document.getElementById('sample-subtask').cloneNode(true);
				var subtask_id = document.getElementById('subtasks-table').childElementCount + 1;
				// alert(tr.childNodes[1].innerHTML + " " + (tr.childNodes[1].innerHTML == 0));
				if(strict && tr.childNodes[1].innerHTML == 0) return false;
				tr.childNodes[1].innerHTML = subtask_id;
				document.getElementById('subtasks-table').appendChild(tr); 
				document.getElementById('subtask-count').value = subtask_id;
				// alert(document.getElementById('subtask-count').value + " " + document.getElementById('subtasks-table').childElementCount);
				return true;
			}
			function delSubtaskField(){
				var select = document.getElementById('subtasks-table');
				if(select.childElementCount < 2) return;
				select.removeChild(select.lastChild);
				document.getElementById('subtask-count').value = document.getElementById('subtasks-table').childElementCount;
			}

			function addSampleField(strict = false) {
				var tr = document.getElementById('sample-case').cloneNode(true);
				var sample_id = document.getElementById('samples-table').childElementCount + 1;
				// alert(tr.childNodes[1].innerHTML + " " + (tr.childNodes[1].innerHTML == 0));
				if(strict && tr.childNodes[1].innerHTML == 0) return false;
				tr.childNodes[1].innerHTML = sample_id;
				document.getElementById('samples-table').appendChild(tr); 
				document.getElementById('sample-count').value = sample_id;
				return true;
			}
			function delSampleField(){
				var select = document.getElementById('samples-table');
				if(select.childElementCount < 2) return;
				select.removeChild(select.lastChild);
				document.getElementById('sample-count').value = document.getElementById('samples-table').childElementCount;
			}

			document.getElementById('subtask-count').value = document.getElementById('subtasks-table').childElementCount;
			if(document.getElementById('subtask-count').value == 0) addSubtaskField();

			document.getElementById('sample-count').value = document.getElementById('samples-table').childElementCount;
			if(document.getElementById('sample-count').value == 0) addSampleField();
		</script>
		</section>
		<button class="btn save" name="save" type="submit"> Save </button> <button class="btn save" name="submit" type="submit"> Submit </button>
	</form>
</section>

<section id="preview">
  <span id="preview_inner"> </span>
  <script>
    function showProblem(str) {
      const xmlhttp = new XMLHttpRequest();
      xmlhttp.onload = function() {
        document.getElementById("preview_inner").innerHTML = this.responseText;
      }
      xmlhttp.open("GET", "php/preview_problem.php?problemID=" + str);
      xmlhttp.send();
    }
  </script>
</section>

<section id="test_data">
	<h2> Test data </h2>
  <div class="table-container">
	<table>
    <thead>
      <tr>
        <th style="width: 10%;">ID</th>
        <th style="width: 10%;">Subtask</th>
        <th style="width: 10%;">Test Case</th>
        <th style="width: 35%;">Input</th>
        <th style="width: 35%;">Output</th>
      </tr>
    </thead>
    <tbody>
      <?php
        function testing($a){ // THIS IS ONLY FOR TESTING, AS I AM TOO LAZY OF TYPING TOO MUCH "<td>"s!
          echo "<tr>";
          for ($i=0; $i<count($a); $i++){
            if ($i > 2){
              echo "<td style='font-family: Consolas; text-align: left;'>$a[$i]</td>";
              continue;
            }
            echo "<td>$a[$i]</td>";
          }
          echo "</tr>";
          return;
        }

        testing(array(
          "1", "1", "1", "Apple", "Orange"
        ));

        testing(array(
          "2", "1", "2", "Good morning", "Hello"
        ));

        testing(array(
          "3", "2", "1", "Alice", "Bob"
        ));

        testing(array(
          "4", "3", "1", "What is 8*9?", "It's 64."
        ));
      ?>
    </tbody>
  </table>
  </div>
</section>

<section id="solutions" >
	<h2> Solutions </h2>
  <div class="table-container">
	<table>
    <thead>
      <tr>
        <th style="width: 10%;" rowspan="2">Solution</th>
        <th style="width: 10%;" colspan="10">Subtask</th>
        <th style="width: 10%;" rowspan="2">Total</th>
      </tr>
      <tr>
        <?php
          for ($i=1; $i<=10; $i++){
            echo "<th>$i</th>";
          }
        ?>
      </tr>
    </thead>
    <tbody>
      <?php

        function testing2($a){ // THIS IS ONLY FOR TESTING, AS I AM TOO LAZY OF TYPING TOO MUCH "<td>"s!
          echo "<tr>";
          for ($i=0; $i<count($a); $i++){
            if ($i == 1){
              for ($j=0; $j<$a[$i]; $j++){
                $r = rand(0, 2);
                if ($r == 0){
                  $b = "ac";
                }
                if ($r == 1){
                  $b = "wa";
                }
                if ($r == 2){
                  $b = "tle";
                }
                echo "<td class='$b'>$b</td>";
              }
              continue;
            }
            echo "<td>$a[$i]</td>";
          }
          echo "</tr>";
          return;
        }

        testing2(array(
          "brute_force.cpp", 10, rand(0.000, 100.000)
        ));
        testing2(array(
          "relax.cpp", 10, rand(0.000, 100.000)
        ));
      ?>
    </tbody>
  </table>
  </div>

  <div class="table-container">
	<table>
    <thead>
      <tr>
        <th style="width: 10%;" rowspan="3">Solution</th>
        <th style="width: 10%;" colspan="100">Subtask</th>
        <th style="width: 10%;" rowspan="3">Total</th>
      </tr>
      <tr>
        <?php
          for ($i=1; $i<=10; $i++){
            echo "<th colspan='10'>$i</th>";
          }
        ?>
      </tr>
      <tr>
        <?php
          for ($i=1; $i<=100; $i++){
            if ($i%10 == 0){
              echo "<th>Total</th>";
              continue;
            }
            echo "<th>". ($i%10) ."</th>";
          }
        ?>
      </tr>
    </thead>
    <tbody>
      <?php

        function testing3($a){ // THIS IS ONLY FOR TESTING, AS I AM TOO LAZY OF TYPING TOO MUCH "<td>"s!
          echo "<tr>";
          for ($i=0; $i<count($a); $i++){
            if ($i == 1){
              for ($j=0; $j<$a[$i]; $j++){
                $r = rand(0, 2);
                if ($r == 0){
                  $b = "ac";
                  $bg = "rgb(var(--TWGSS-green-light))";
                }
                if ($r == 1){
                  $b = "wa";
                  $bg = "unset";
                }
                if ($r == 2){
                  $b = "tle";
                  $bg = "unset";
                }
                echo "<td style='background-color: $bg'>".strtoupper($b)."</td>";
              }
              continue;
            }
            echo "<td>$a[$i]</td>";
          }
          echo "</tr>";
          return;
        }

        testing3(array(
          "brute_force.cpp", 100, rand(0.000, 100.000)
        ));
        testing3(array(
          "relax.cpp", 100, rand(0.000, 100.000)
        ));
      ?>
    </tbody>
  </table>
  </div>
</section>

</main>
<div id="footer"></div>
</body>
</html>