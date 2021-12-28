<!DOCTYPE html>

<html>
  <head>
  <title>TWGSS Online Judge</title>
  <link rel="stylesheet" type="text/css" href="/style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/assets/image/icon.svg">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
    $("#header").load("/header.html", null, function () { $('.nav-problems').addClass('active'); });
    $("#footer").load("/footer.html");
    });
  </script>

<html>
  <div id="header"></div>
  <main>
	<h1> <img class="page-icon" src="/assets/image/icon_submissions.svg"> Problem Submissions </h1>

  <div class="table-container">
    <table>
      <thead> <tr> <th> Submission ID </th> <th> User </th> <th> Verdict </th>  <th> Runtime</th> <th> Memory usage </th></tr></thead>
      <tbody>
      <?php include("../../php/sql_connect.php");
        function td($s){
          return '<td>' . $s . '</td>';
        }
        $sql = "SELECT * FROM Submission WHERE problemID = '0' limit 50;";
        $res = $conn->query($sql);
        while($row = mysqli_fetch_assoc($res)){
          echo '<tr>'.td($row['submissionID']).td($row['userID']).td($row['result']).td($row['runtime'].td($row['memory'])).'</tr>';
        }
      ?>
      <tr><td><a href="/submission/0.html">0</td><td></tr>
      </tbody>
    </table>
  </div>
  </main>
  <div id="footer"></div>
</html>