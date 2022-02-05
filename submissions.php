<!DOCTYPE html>
<html>

<head>
<?php 
  function includeHeader($id="", $title="", $nav="") {
    include($_SERVER['DOCUMENT_ROOT']."/head.php");
  }
  includeHeader("submissions", "Submissions", "submissions");
?>
</head>

	<html>
	<div id="header"></div>
	<main>
		<h1> <img class="page-icon" src="/assets/image/icon_submissions.svg"> All Submissions </h1>

		<div class="table-container">
			<table style="width:100%">
				<thead>
					<tr>
						<th style="width:5%"> ID </th>
            <th style="width:15%"> Date & Time </th>
						<th style="width:22.5%"> User </th>
            <th style="width:22.5%"> Problem </th>
            <th style="width:7.5%"> Language </th>
						<th style="width:12.5%"> Verdict </th>
						<th style="width:7.5%"> <img class="table-head-icon" src="/assets/image/icon_timelimit.svg"> Runtime</th>
						<th style="width:7.5%"> <img class="table-head-icon" src="/assets/image/icon_memlimit.svg"> Memory</th>
					</tr>
				</thead>
				<tbody>
          <?php
            include('php/sql_connect.php');
            $verdictClass = array(
            "Accepted"				=>		"ac", 
					  "Wrong Answer"			=>		"wa", 
					  "Time Limit Exceeded"		=>		"tle",
					  "Runtime Error"			=>		"re",
					  "Compilation Error" 		=> 		"ce");
            $res = $conn->query("
              SELECT s.submissionID, 
                    s.submissionTime,
                    s.userID, 
                    u.userName,
                    u.displayName,
                    s.problemID, 
                    p.problemName,
                    s.language, 
                    s.verdict, 
                    s.runtime, 
                    s.memory
              FROM submission s 
              LEFT JOIN user u ON s.userID = u.userID
              LEFT JOIN problem p ON s.problemID = p.problemID
              ORDER BY submissionID DESC LIMIT 10");
            
            echo $conn->error;
            include('Utility.php');
            if($res) { 
              while ($row = mysqli_fetch_assoc($res)) {
                echo Utility::getSubmissionRow(
                  $row['submissionID'],
                  date('d/m/Y H:i:s', $row['submissionTime']),
                  $row['userID'],
                  $row['userName'],
                  $row['displayName'],
                  $row['problemID'],
                  $row['problemName'],
                  $row['language'],
                  Utility::getVerdictName($row['verdict']),
                  strtolower($row['verdict']),
                  ($row['runtime'] ? number_format($row['runtime'], 3, '.', '') . ' s' : ''),
                  ($row['memory'] ? number_format($row['memory'] / 1024, 3, '.', '') . ' MB' : '')
                  );
              }
            }
          
          ?>
				</tbody>
			</table>
		</div>
	</main>
	<div id="footer"></div>

	</html>