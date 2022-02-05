<!DOCTYPE html>
<html>

<head>
<?php 
  function includeHeader($id="", $title="", $nav="") {
    include($_SERVER['DOCUMENT_ROOT']."/head.php");
  }
  includeHeader("contest/0/submissions", "Contest submissions", "");
?>
</head>
<body>
	<div id="header"></div>
	<main>
		<h1> <img class="page-icon" src="/assets/image/icon_submissions.svg"> Contest Submissions </h1>
		<div class="table-container">
			<table style="width:100%">
				<thead>
					<tr>
						<th> ID </th>
            <th> Date & Time </th>
						<th> User </th>
            <th> Problem </th>
            <th> Language </th>
						<th> Verdict </th>
						<th> <img class="table-head-icon" src="/assets/image/icon_timelimit.svg"> Runtime</th>
						<th> <img class="table-head-icon" src="/assets/image/icon_memlimit.svg"> Memory</th>
					</tr>
				</thead>
				<tbody>
          <?php
            include($_SERVER['DOCUMENT_ROOT'].'/php/sql_connect.php');
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
              WHERE s.contestID = '" . $conn->real_escape_string($contestID) . "'
              ORDER BY submissionID DESC LIMIT 10");
            
            echo $conn->error;
            include($_SERVER['DOCUMENT_ROOT'].'/Utility.php');
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
                  $row['verdict'],
                  $verdictClass[$row['verdict']],
                  ($row['runtime'] ? $row['runtime'] . ' s' : ''),
                  ($row['memory'] ? $row['memory'] . ' MB' : '')
                  );
              }
            }
          
          ?>
				</tbody>
			</table>
		</div>
	</main>
	<div id="footer"></div>
</body>
</html>