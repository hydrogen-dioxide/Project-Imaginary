<!DOCTYPE HTML>
<html>

<head>
<?php 
  function includeHeader($id="", $title="", $nav="") {
    include($_SERVER['DOCUMENT_ROOT']."/head.php");
  }
  includeHeader("admin/sql", "SQL management", "admin");
?>
</head>

  <body>
    <div id="header"></div>
    <main>
      <h1> SQL management </h1>
      <button> SQL start </button>
      <button> SQL nuke </button>
    </main>
    <div id="footer"></div>
  </body>
</html>
<!--
	  <a href="/setting.php"> Setting </a>
      <br>
	  <a href="/admin/index.html"> Admin </a>
-->