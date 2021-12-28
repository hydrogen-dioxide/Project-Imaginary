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
    $("#header").load("/header.html", null, function () { $('.nav-problems').addClass('active'); });
    $("#footer").load("/footer.html");
    });
  </script>

<html>
  <div id="header"></div>
  <main>
	<h1> Problem Statistics </h1>
    <div class="table-container">
      <table>
        <thead> 
          <tr> <td>Stat Type</td>  <td>solved User</td> <td>Attempted user</td> <td>Accepted</td> <td>Wrong Answer</td> <td>Runtime Error	</td></td> <td>Total submission</td> </tr>
        </thead>
        <tbody>
          <tr> <td>You </td> <td>not Solved </td> <td> Not Attempted </td> <td>0 </td> <td>N/A </td> <td>N/A </td> <td>0 </td> </tr>
          <tr> <td>Active User</td> <td>134 </td> <td> 177 </td> <td>146 </td> <td>177 </td> <td>11 </td> <td>334 </td> </tr>
          <tr> <td>All Users</td> <td>221 </td> <td> 301 </td> <td>233 </td> <td>532 </td> <td>19 </td> <td>784 </td> </tr>
        </tbody>
      </table>
    </div>
  </main>
  <div id="footer"></div>
</html>