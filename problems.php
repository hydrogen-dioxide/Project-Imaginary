<!DOCTYPE html>

<html>

<head>
	<title>TWGSS Online Judge</title>
	<link rel="stylesheet" type="text/css" href="/style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="/assets/image/icon.svg">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">
	</script>
  <script src="/assets/js/include.js"></script>
	<script>
		$(document).ready(function(){
    $("#header").load("/header.html", null, function () { $('.nav-problems').addClass('active'); });
    $("#footer").load("/footer.html");
    });
  </script>
</head>
<div id="header"></div>
<main>
	<h1> <img class="page-icon" src="/assets/image/icon_problems.svg"> Problems </h1>

  <div class="table-container">
    <table class="big-table"> 
      <thead>
        <tr>
          <th colspan="2"> Problem </th>
          <th title="Solved"> <img class="table-head-icon" src="/assets/image/icon_solved.svg"></th>
          <th title="Attempted"> <img class="table-head-icon" src="/assets/image/icon_attempted.svg"></th>
        </tr>
      </thead>

      <tbody>

        <?php 
          function problem($ID, $name, $solved, $attempted){
            return sprintf("
                            <tr data-href='/problem/%s'>
                            <td class='numbers'> %s </td>
                            <td> %s </td>
                            <td class='numbers'> %s </td>
                            <td class='numbers'> %s </td>
                            </tr>"
                            , $ID, $ID, $name, $solved, $attempted);
          }
          echo problem("X0000", "Printing Pages (TESTING)", 1, 50);
          echo problem("X0001", "Printing Pages", 1, 50);
          echo problem("X0002", "Electrical Strip", 3, 20);
        ?>

      </tbody>
    </table>
  </div>
  </main>
  <div id="footer"></div>
</html>