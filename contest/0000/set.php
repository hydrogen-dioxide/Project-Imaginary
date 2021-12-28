<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8" />
    <title> TWGSS Online Judge (alpha) </title>
    <link rel="shortcut icon" type="image/png" href="../assets/image/icon.png" />
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/problem_setting.css">
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
      $(document).ready(function(){
      $("#header").load("/header.html", null, function () { $('.nav-problems').addClass('active'); });
      $("#footer").load("/footer.html");
      });
    </script>
</head>
<body>
	<div id="header"> </div>
  <main>

    <section>
      <h2 class="subheading"> REJUDGE </h2>
      If there is a wrong test case, then all solutions will need to be re-judged.
      <br>
      <button id="rejudge" class="btn warning"> Rejudge All </button>
      <script>
          function warning(){
              alert("Are you sure?");
          }
          document.getElementById("rejudge").onclick=(warning);
      </script>
    </section>

    <section>
    <h2 class="subheading"> CONTEST INFORMATION </h2>
	<form action="/php/contest_info.php" method="post">
		<table>
			<tbody>
				<tr>
					<td style="min-width: 200px;"><label for="id"> Contest ID (4-6 Characters)</label></td>
					<td style="width: 20px;"> </td>
					<td><input type="text" id="id" class="input px-3 py-2 border-2" name="id" required minlength="4" maxlength="6" size="10" value="<?php echo $problemID ?>"></td>
				</tr>
				<tr>
					<td><label for="name">Contest name (max. 50 Characters)</label></td>
					<td> </td>
					<td><input type="text" id="name" class="input px-3 py-2 border-2" name="name" required minlength="1" maxlength="50" size="50" value="<?php echo $problemName ?>"></td>
				</tr>
				<tr>
					<td><label for="pretests">Pretests</label></td>
					<td> </td>
					<td><input type="text" id="type" class="input px-3 py-2 border-2" name="type" required minlength="1" maxlength="50" size="50" value="<?php echo $problemType ?>"></td>
				</tr>
				<tr>
					<td><label for="origin">Scoring</label></td>
					<td> </td>
					<td><input type="text" id="origin" class="input px-3 py-2 border-2" name="origin" maxlength="50" size="50" value="<?php echo $author ?>"></td>
				</tr>
				<tr>
					<td><label for="language">Select</label></td>
					<td> </td>
					<td> Best Result </td>
				</tr>
				<tr>
					<td><label for="language">Result</label></td>
					<td> </td>
					<td> Own result </td>
				</tr>
			</tbody>
		</table>
    </section>
    		<button class="btn save" name="save" type="submit"> Save </button> <button class="btn save" name="submit" type="submit"> Submit </button>
	</form>
    </main>
	<div id="footer"> </div>
</body>
</html>