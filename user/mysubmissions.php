<!doctype html>
<html>

<head>
  <?php 
    function includeHeader($id="", $title="", $nav="") {
      include($_SERVER['DOCUMENT_ROOT']."/head.php");
    }
    includeHeader("user/mysubmissions.php", "My Submissions", "mysubmission");
  ?>

	<style>
		.boxed {
			width: 20%;
  	  height: 80px;
		}
	</style>
</head>

<body>
	<div id="header"></div>

      <main>
			<center>
				<table style="width:100%">
          <thead>
            <tr>
							<th> Submission ID </th>
              <th> Date / Time </th>
              <th class='my_sub_user_bold'> User: Daniel Hsieh<button class="nav-button" href="#"><img class="nav-icon white-pic" src="/assets/image/icon_cross.png"></button></th>
              <th> Task </th>
              <th> Language </th>
              <th> Result </th>
              <th> Time </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td> 0 </td>               <td> 2021-11-26 15:38:19 </td>
              <td> Daniel Hsieh </td>
              <td> IDK </td>
              <td> C++ </td>
              <td class="ac"> Accepted </td>
              <td> 0.000 </td>
            </tr>
            <tr>
              <td> 0 </td>               <td> 2021-11-26 15:38:19 </td>
              <td> Daniel Hsieh </td>
              <td> IDK </td>
              <td> C# </td>
              <td class="tle"> Time Limit Exceeded </td>
              <td> 0.000 </td>
            </tr>
            <tr>
              <td> 0 </td>               <td> 2021-11-26 15:38:19 </td>
              <td> Daniel Hsieh </td>
              <td> IDK </td>
              <td> C++ </td>
              <td class="ac"> Accepted </td>
              <td> 0.000 </td>
            </tr>
            <tr>
              <td> 0 </td>               <td> 2021-11-26 15:38:19 </td>
              <td> Daniel Hsieh </td>
              <td> IDK </td>
              <td> C++ </td>
              <td class="wa"> Wrong Answer </td>
              <td> 0.000 </td>
            </tr>
            <tr>
              <td> 0 </td>               <td> 2021-11-26 15:38:19 </td>
              <td> Daniel Hsieh </td>
              <td> IDK </td>
              <td> C++ </td>
              <td class="ac"> Accepted </td>
              <td> 0.000 </td>
            </tr>
            <tr>
              <td> 0 </td>               <td> 2021-11-26 15:38:19 </td>
              <td> Daniel Hsieh </td>
              <td> IDK </td>
              <td> C++ </td>
              <td class="re"> Runtime Error </td>
              <td> 0.000 </td>
            </tr>
            <tr>
              <td> 0 </td>               <td> 2021-11-26 15:38:19 </td>
              <td> Daniel Hsieh </td>
              <td> IDK </td>
              <td> C++ </td>
              <td class="ce"> Compilation Error </td>
              <td> 0.000 </td>
            </tr>
            <tr>
              <td> 0 </td>               <td> 2021-11-26 15:38:19 </td>
              <td> Daniel Hsieh </td>
              <td> IDK </td>
              <td> C++ </td>
              <td class="ac"> Accepted </td>
              <td> 0.000 </td>
            </tr>
            <tr>
              <td> 0 </td>               <td> 2021-11-26 15:38:19 </td>
              <td> Daniel Hsieh </td>
              <td> IDK </td>
              <td> Python </td>
              <td class="wa"> Wrong Answer </td>
              <td> 0.000 </td>
            </tr>
            <tr>
              <td> 0 </td>               <td> 2021-11-26 15:38:19 </td>
              <td> Daniel Hsieh </td>
              <td> IDK </td>
              <td> C </td>
              <td class="ac"> Accepted </td>
              <td> 0.000 </td>
            </tr>
            <tr>
              <td> 0 </td>               <td> 2021-11-26 15:38:19 </td>
              <td> Daniel Hsieh </td>
              <td> IDK </td>
              <td> C++ </td>
              <td class="ac"> Accepted </td>
              <td> 0.000 </td>
            </tr>
            <tr>
              <td> 0 </td>               <td> 2021-11-26 15:38:19 </td>
              <td> Daniel Hsieh </td>
              <td> IDK </td>
              <td> C++ </td>
              <td class="ac"> Accepted </td>
              <td> 0.000 </td>
            </tr>
            <tr>
              <td> 0 </td>               <td> 2021-11-26 15:38:19 </td>
              <td> Daniel Hsieh </td>
              <td> IDK </td>
              <td> C++ </td>
              <td class="ac"> Accepted </td>
              <td> 0.000 </td>
            </tr>
          </tbody>
				</table> 
				<br><br>
					<div class="boxed">
						<button class="nav-button" href="#"><img class="nav-icon" src="/assets/image/icon_left.png"></button>
						<button disabled>1</button>
						<button class="nav-button" href="#"><img class="nav-icon" src="/assets/image/icon_right.png"></button>
					</div>			
				</center>

  
      </main>
      <div id="footer"></div>
   </body>
</html>
<!--
   <a href="/setting.php"> Setting </a>
      <br>
   <a href="/admin/index.html"> Admin </a>
   -->