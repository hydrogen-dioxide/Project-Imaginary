<!DOCTYPE html>

<html>
<head>
<?php 
  function includeHeader($id="", $title="", $nav="") {
    include($_SERVER['DOCUMENT_ROOT']."/head.php");
  }
  includeHeader("problem/TO_BE_REPLACED/submissions", "Problem Submission", "problems");
?>
</head>

<html>
  <div id="header"></div>
  <main>
	<h1> <img class="page-icon" src="/assets/image/icon_submissions.svg"> Problem Submissions </h1>

  <div class="table-container">
    <table>
      <thead> <tr> <th> Submission ID </th> <th> User </th> <th> Verdict </th>  <th> Runtime</th> <th> Memory usage </th></tr></thead>
      <tbody>
      <?php include($_SERVER['DOCUMENT_ROOT']."/php/sql_connect.php");
        function td($s){
          return '<td>' . $s . '</td>';
        }
        $sql = "SELECT * FROM submission WHERE problemID = '".$conn->real_escape_string($problemID)."' ORDER BY `submissionID` DESC limit 50;";
        $res = $conn->query($sql);
        while($row = mysqli_fetch_assoc($res)){
          echo '<tr>'.td("<a href='/submission/$row[submissionID].html'>".$row['submissionID']).td($row['userID']).td($row['result']).td($row['runtime'].td($row['memory'])).'</tr>';
        }
      ?>
      </tbody>
    </table>
  </div>
  </main>
  <div id="footer"></div>
</html>