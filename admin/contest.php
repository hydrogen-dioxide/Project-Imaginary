<!DOCTYPE html>

<html>
<head>
<?php 
  function includeHeader($id="", $title="", $nav="") {
    include($_SERVER['DOCUMENT_ROOT']."/head.php");
  }
  includeHeader("admin/contest", "Contest Settings", "contests");
?>
</head>

<body>
  <div id="header"></div>
  <main>
  <form action="/php/update_contest.php" method="POST">
  <h1> Contest Settings </h1>
  <section>
  <h2> Contest Information </h2>
  <table>
    <?php
      echo settingRow(
        "id",
        "text",
        "",
        "",
        "Contest ID"
      );
      
      echo settingRow(
        "name",
        "text",
        "",
        "",
        "Contest Name"
      );

      echo settingRow(
        "start-time",
        "datetime-local",
        "",
        "",
        "Start Time"
      );

      echo settingRow(
        "end-time",
        "datetime-local",
        "",
        "",
        "End Time"
      );

      echo settingRow(
        "writers",
        "text",
        "",
        "",
        "Writers"
      );
    ?>
  </table>
  </section>

  <input style="display:none" id="contestID" value="0">
  <section>
  <h2> Configurations </h2>
  <table>
  <?php
    echo settingRow(
      "pretest",
      "option",
      array(
        array("yes", "own", "no"),
        array("Has pretest", "Own pretest", "No pretest")
      ),
      2,
      "Pretest"
    );

    echo settingRow(
      "scoring",
      "option",
      array(
        array("ysubtask", "nsubtask", "case", "off"),
        array("Per subtask (cumulative)", "Per subtask (non-cumulative)", "Per case", "Off")
      ),
      0,
      "Scoring"
    );

    echo settingRow(
      "selection",
      "option",
      array(
        array("last", "best", "off"),
        array("Last Submission", "Highest Score", "Off")
      ),
      0,
      "Select"
    );

    echo settingRow(
      "results",
      "option",
      array(
        array("public", "first-error", "own", "off"),
        array("Public", "First error per subtask", "Own final results", "Off")
      ),
      0,
      "Results"
    );

    echo settingRow(
      "restrictions",
      "checkbox",
      array(
        "<input type='checkbox' id='max-submission' name='max-submission' value='max-submission'>
        <label for='max-submission'> Max <input name='max-submission-count'type='number'> </input> Submission Per task </label>",

        "<input type='checkbox' id='cooldown' name='cooldown' value='cooldown'>
        <label for='cooldown'> Min <input name='cooldown-period' type='number'> </input> seconds between submissions per task </label>",

        "<input type='checkbox' id='none' name='none' value='none'><label for='none'>None</label>"
      ),
      "",
      "Restrictions"
    );
  ?>
  </table>

  <!-- Four modes: Codeforces, ICPC, NOI, IOI-->
  <!-- detection of contradicting attributes. Wow, exactly J221! -->
  </section>

  <section>
  <h2> Problems </h2> <button> Add Problem </button>
  <table>
    <thead> <th> Problem </th> <th> Max Score </th> <th> Scoring </th></thead>
    <tbody>
      <tr> <td> X0000 - Printing Pages</td> <td> 100 </td> <td> Batch </td></tr>
    </tbody>

    <button onclick="compile_contest(document.getElementById('contestID'))"> Compile Problems </button>
    <pre id="txtResponse"> </pre>
    <script>
      function compile_contest(str){
        if (str.length == 0) {
          document.getElementById("txtResponse").innerHTML = "";
          return;
        } else {
          const xmlhttp = new XMLHttpRequest();
          xmlhttp.onload = function() {
            document.getElementById("txtResponse").innerHTML = this.responseText;
          }
        xmlhttp.open("GET", "../php/compile_contest.php?taskID=" + str);
        xmlhttp.send();
        }
      }
    </script>
  </table>
  </section>

  <section>
  <h2> Contestant </h2>
  <table>
  <?php
    echo settingRow(
      "access",
      "option",
      array(
        array("public", "admin", "invited", "off"),
        array("Public", "Admin", "Invited", "Off")
      ),
      0,
      "Contestant",
      false
    );
  ?>
  </table>

  <!-- pop up when invited is clicked -->

  <div id="invitation" name="invitation">
    <button> Add Role / Character </button>
    <?php include("../../Utility.php"); echo Utility::getUserBlock("1", "Daniel", "..."); ?>
  </div>
  </section>
  </form>
  </main>
  <!-- User-block -->
  <div id="footer"></div>
</body>
</HTML>