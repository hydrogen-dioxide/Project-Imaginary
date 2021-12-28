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
  </head>

<html>
  <body>
  <div id="header"></div>
  <main>
  <h1> <img class="page-icon" src="/assets/image/icon_contests.png"> Contests </h1>
  <div class="table-container">
    <table class="big-table">
      <thead>
        <tr>
          <th> Contest # </th>
          <th> Contest Name </th>
          <th> # Participants </th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td> 0000 </td>
          <td> <a href="/contest/0000"> Beta Round #1 </td>
          <td> 1 </td>
        </tr>
        
        <tr>
          <td> 0001 </td>
          <td> Beta Round #2 </td>
          <td> 3 </td>
        <tr>
      </tbody>
    </table>
  </div>
  </main>
  <div id="footer"></div>
  </body>
</html>