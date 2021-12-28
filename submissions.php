<!DOCTYPE html>
<html>

<head>
	<title>TWGSS Online Judge</title>
	<link rel="stylesheet" type="text/css" href="/style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="/assets/image/icon.svg">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">
	</script>
  <script src="/assets/js/include.js"></script>
	<script>
		$(document).ready(function(){
    $("#header").load("/header.html", null, function () { $('.nav-submissions').addClass('active'); });
    $("#footer").load("/footer.html");
    });
	</script>

	<html>
	<div id="header"></div>
	<main>
		<h1> <img class="page-icon" src="/assets/image/icon_submissions.svg"> All Submissions </h1>

		<div class="table-container">
			<table style="width:100%">
				<thead>
					<tr>
						<th> ID </th>
            <th> Date & Time </th>
						<th> User </th>
            <th> Problem </th>
            <th> Language </th>
						<th> Verdict </th>
						<th> <img class="table-head-icon" src="/assets/image/icon_timelimit.svg"> Runtime</th>
						<th> <img class="table-head-icon" src="/assets/image/icon_memlimit.svg"> Memory</th>
					</tr>
				</thead>
				<tbody>
          <?php
            function submission($submissionID, $date, $time, $userID, $userName, $userDisplay, $problemID, $problemName, $language, $verdict, $verdictClass, $runtime, $memory){
              return sprintf("<tr>
                              <td data-href='submission/%s.html' class='numbers'> %s </td>
                              <td class='numbers'> %s %s </td>
                              <td style='text-align: left;' data-href='/user/%s.html'> 
                                <div class='user-block'>
                                  <div class='user-basic'>
                                      <img class='pfp' src='/assets/user/pfp/%s.webp'>
                                    <span class='user-name'>%s</span>
                                  </div>
                                  <span class='user-display'>%s </span>
                                </div>
                              </td>

                              <td data-href='/problem/%s'>
                                <div class='small-problem-block'>
                                  <div class='small-problem-basic'><span class='small-problem-id'>%s</span></div><span class='small-problem-name'>%s</span></div>
                              </td>

                              <td> %s </td>
                              <td class='%s'> %s </td>
                              <td class='numbers'> %s </td>
                              <td class='numbers'> %s </td> </tr>"
              , $submissionID, $submissionID, $date, $time,$userID, $userID, $userName, $userDisplay, $problemID, $problemID, $problemName, $language, $verdictClass, $verdict, $runtime, $memory);
            }

            echo submission("1", "27/12", "00:00:00", "1", "daniel", "Lonely Christmas rip", "X0001", "Printing Pages", "C++20", "Accepted", "ac", "0.023 s", "89.64MB");
            echo submission("2", "27/12", "00:00:01", "2", "jack", "Lonely Christmas Pro Max", "X0002", "Electrical Strip", "C++23", "Wrong Answer", "wa", "", "");
          ?>
				</tbody>
			</table>
		</div>
	</main>
	<div id="footer"></div>

	</html>