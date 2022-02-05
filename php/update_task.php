<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/style.css">
	<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
  <script stc="/assets/js/include.js"> </script>
<head>
<body>
<main>
  <h2> Problem <span style="color: red"><?php echo $_POST['problemName']; ?></span> Preview </h2>
  <?php
    include('ProblemClass.php');
    $problem = new Problem();
    $problem->loadFromForm();
    echo $problem->problemID;
    echo $problem->toHTML();
    $problem->uploadToSQL();
    $problem->updateFile();
  ?>
	<table>
		<tbody>
			<tr>
				<td style="min-width: 100px"> Task ID </td>
				<td> <?php echo $_POST["problemID"]; ?> </td>
			</tr>
			<tr>
				<td> Task Name </td>
				<td> <?php echo $_POST["problemName"]; ?> </td>
			</tr>
			<tr>
				<td> Time Limit </td>
				<td> <?php echo $_POST["timeLimit"]; ?> s</td>
			</tr>
			<tr>
				<td> Mem Limit </td>
				<td> <?php echo $_POST["memoryLimit"]; ?> <?php echo $_POST["mem_u"]; ?> </td>
			</tr>
			<tr>
				<td> Type </td>
				<td> <?php echo $_POST["problemType"]; ?> </td>
			</tr>
			<tr>
				<td> Origin </td>
				<td> <?php echo $_POST["problemAuthor"]; ?> </td>
			</tr>
			<tr>
				<td> Language </td>
				<td> <?php 
						$init = true;
						foreach(["C++11", "C++14", "C++17", "Python"] as $language){
							if(isset($_POST[$language])){
								echo (!$init?", ":"") . $language; $init = false;
							}
						} ?> </td>
			</tr>
		</tbody>
	</table>

</main>
</body>
</html>