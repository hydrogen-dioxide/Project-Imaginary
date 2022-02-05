<!DOCTYPE HTML>
<html manifest="/test.appcache">

<head>
<?php 
  function includeHeader($id="", $title="", $nav="") {
    include($_SERVER['DOCUMENT_ROOT']."/head.php");
  }
  includeHeader("problem/$problemID/index", "Problem", "problems");

  include($_SERVER['DOCUMENT_ROOT']."/php/ProblemClass.php");
  $problem = new Problem(); $problem->loadFromSQL($problemID);
?>
<script type="text/javascript" id="MathJax-script" async
  src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js">
</script>
</head>

<body>
	<div id='header'></div>
  <main>
    <?php 
      echo $problem->toHTML();   
    ?>
  </main>
  <div id='footer'></div>
</body>
</html>