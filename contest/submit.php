<!DOCTYPE html>
<html>

<head>
<?php 
  function includeHeader($id="", $title="", $nav="") {
    include($_SERVER['DOCUMENT_ROOT']."/head.php");
  }
  includeHeader("contest/0/submit", "Problem Submit", "");
?>
</head>
<body>
  <div id="header"></div>
  <main>
    <h1> <img class="page-icon" src="/assets/image/icon_submit.svg"> Problem Submit </h1>
    <label for="problemID">Problem ID:</label>
    <select name="problemID">
      <?php
        function problemOpt($id, $name){
          echo "<option value='$id'>$id-$name</option>";
        }
        include($_SERVER['DOCUMENT_ROOT'].'/php/sql_connect.php');
        $res = $conn->query("SELECT problemList FROM contest WHERE contestID = '" . $contestID . "';");
        if($res){
          $row = $res->fetch_row()[0];
          echo $row;
          $row = json_decode($row, true);
          foreach($row as $probID){
            $probName = $conn->query("SELECT problemName FROM problem WHERE problemID = '" . $probID . "'")->fetch_row()[0];
            problemOpt($probID, $probName);
          }
        }
      ?>
    </select>
    <br> <br>
    <label for="languages">Language:</label>
    <select name="languages" id="languages">
      <?php
        function langOpt($id, $name){
          echo "<option value='$id'>$name</option>";
        }
        langOpt("C", "C");
        langOpt("C++20", "C++20");
        langOpt("Python", "Python");
      ?>
    </select> 
    <br> <br>
    <textarea name="source_code_text" cols="80" rows="20" class="code" type="text" style="resize: none; tab-size: 4;" ></textarea> <br>
    <script src="/assets/js/code_style.js"></script>
    <button class="btn save" name="submit" type="submit"> Submit </button>
  </main>
  <div id="footer"></div>
</body>
</html>