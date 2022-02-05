<!DOCTYPE html>
<html>
<head>
<?php 
  function includeHeader($id="", $title="", $nav="") {
    include($_SERVER['DOCUMENT_ROOT']."/head.php");
  }
  includeHeader("404", "Not Found", "404");
?>
</head>

<body>
<div id="header"></div>
  <main>
  <center>
    <h1 class="sp"> Not Found </h1>
    <h2> a.k.a. <span class="inline-code">find the typo</span> </h2>
  </center>
  </main>
  <div id="footer"></div>
</body>
</html>