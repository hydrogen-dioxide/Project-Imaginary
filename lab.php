  <!doctype html>
<html>
<head>
<?php 
  function includeHeader($id="", $title="", $nav="") {
    include($_SERVER['DOCUMENT_ROOT']."/head.php");
  }
  includeHeader("lab", "Lab", "lab");
?>
<script type="text/javascript" id="MathJax-script" async
  src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-chtml.js"></script>
</head>
<body>
<div id="header"></div>

<main>
  <center>
    <h1 class="sp"> LABORATORY - OIistry</h1>
  </center>

<h1> Some fun stuff... </h1>

<form autocomplete="off">
<label for="id">Problem ID or Name:</label> <input id="id" type="text" onkeyup="showHint(this.value)"> <button onclick="showProblem(document.getElementById('id').value)" type="button"> Enter </button>
</form>
Suggestion: <span id="txtHint"></span>
<span id="txtProblem"></span>

<script>
function showHint(str){
  if (str.length == 0) {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  xmlhttp.open("GET", "gethint.php?q=" + str);
  xmlhttp.send();
  }
}

function showProblem(str) {
  if (str.length == 0) {
    document.getElementById("txtProblem").innerHTML = "";
    return;
  } else {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
      document.getElementById("txtProblem").innerHTML = this.responseText;
      MathJax.typeset();
    }
  xmlhttp.open("GET", "php/compile_problem.php?problemID=" + str);
  xmlhttp.send();
  }
}

</script>
</main>
<div id="footer"></div>
</body>
</html>