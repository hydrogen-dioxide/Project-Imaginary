<!DOCTYPE html>

<html>
  <head>
  <title>TWGSS Online Judge</title>
  <link rel="stylesheet" type="text/css" href="/style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/assets/image/icon.png">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
    $("#header").load("/header.html", null, function () { $('.nav-contests').addClass('active'); });
    $("#footer").load("/footer.html");
    });
  </script>

<html>
  <div id="header"></div>
  <main>
	<h1> Contest Submissions </h1>
  <div class="table-container">
    <table>
      <thead> <tr> <th> Submission ID </th> <th> User </th> <th> Verdict </th>  <th> Runtime</th> <th> Memory usage </th></tr></thead>
      <tbody>
      <tr><td><a href="/submission/0.html">0</td> <td>duncanhehe</td> <td  class="wa">Wrong answer</td> <td>0.043 s</td>  <td>35MB</td> </tr> <!-- u-1 -->
      <tr><td><a href="/submission/0.html">0</td> <td>duncanhehe</td> <td  class="tle">Time limit Exceeded </td> <td>0.995 s</td>  <td>125MB</td> </tr>
      </tbody>
    </table>
  </div>
  </main>
  <div id="footer"></div>
</html>