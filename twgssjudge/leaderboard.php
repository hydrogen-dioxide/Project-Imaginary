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
    $("#header").load("/header.html", null, function () { $('.nav-leaderboard').addClass('active'); });
    $("#footer").load("/footer.html");
    });
  </script>

<html>
  <div id="header"></div>
  <main>
	<h1> <img class="page-icon" src="/assets/image/icon_leaderboard.png"> Leaderboard </h1>
  <div class="table-container">
    <table class="big-table">
      <thead>
        <tr>
          <th> Name </th>
          <th> # Solves </th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td> <a href="user/1.html"> Daniel </td>
          <td> 23 </td>
        </tr>
        
        <tr>
          <td> XXX </td>
          <td> 13 </td>
        <tr>
      </tbody>
    </table>
  </div>
  </main>
  <div id="footer"></div>
</html>