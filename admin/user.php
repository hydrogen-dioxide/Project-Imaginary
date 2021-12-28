<!DOCTYPE HTML>
<html>

  <head>
    <title> Admin | TWGSS Online Judge</title>
    <link rel="stylesheet" type="text/css" href="/style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/assets/image/icon.png">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
      $(document).ready(function(){
      $("#header").load("/header.html", null, function () { $('.nav-' + location.pathname.split("/")[1]).addClass('active'); });
      $("#footer").load("/footer.html");
      });
    </script>
  </head>

  <body>
    <div id="header"></div>
    <main>
      <h1> User Priviledges </h1>
      <div class="table-container">
        <table class="center">
          <tr> <td> Name </td> <td> Problem Setting </td> <td> Contest setting </td> </tr>
          <tr> <td> Daniel </td> <td> Yes </td> <td> Yes </td></tr>
          <tr> <td> Jack </td> <td> No </td> <td> Yes </td> </tr>
          <tr> <td> Duncan </td> <td> Yes </td> <td> No </td></tr>
        </table>
      </div>
    </main>
    <div id="footer"></div>
  </body>
</html>
<!--
	  <a href="/setting.php"> Setting </a>
      <br>
	  <a href="/admin/index.html"> Admin </a>
-->