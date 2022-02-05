<!DOCTYPE html>

<head>
<?php 
  function includeHeader($id="", $title="", $nav="") {
    include($_SERVER['DOCUMENT_ROOT']."/head.php");
  }
  includeHeader("contest/0/set", "Contest Settings", "contests");
  include($_SERVER['DOCUMENT_ROOT'].'/php/sql_connect.php');
?>
</head>
  <div id="header"></div>
  <main>
	<h1> Contest Statistics </h1>
    <div class="table-container">
      <table>
        <thead> 
          <tr> <td>Problem #</td> <td>Problem </td> <td>solved User</td> <td>Attempted user</td> <td> Accepted rate </td> <td>Mean</td>  <td>Standard Deviation</td> </tr>
        </thead>
        <tbody>
          <tr> <td> 0000 </td> <td>	Printing Pages </td> <td> 37 </td> <td>61 </td> <td>60.5%</td> <td>66.8</td> <td>27.41 </td> </tr>
          <tr> <td> 0001 </td> <td>	Electronic Strip </td> <td> 25 </td> <td>50 </td> <td>50%</td> <td>45.3</td> <td>34.68 </td> </tr>
        </tbody>
      </table>
    </div>
  </main>
  <div id="footer"></div>
</html>