<!DOCTYPE HTML>
<html>

<head>
<?php 
  function includeHeader($id="", $title="", $nav="") {
    include($_SERVER['DOCUMENT_ROOT']."/head.php");
  }
  includeHeader("admin/user", "User profile", "admin");
?>
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