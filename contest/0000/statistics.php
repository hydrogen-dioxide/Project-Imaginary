<!DOCTYPE html>

<html>
  <head>
  <title>TWGSS Online Judge</title>
  <link rel="stylesheet" type="text/css" href="/style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/assets/image/icon.png">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
    $("#header").load("/header.html", null, function () { $('.nav-contests').addClass('active'); });
    $("#footer").load("/footer.html");
    });
  </script>

<html>
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