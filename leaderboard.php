<!DOCTYPE html>

<html>
  <head>
  <title>TWGSS Online Judge</title>
  <link rel="stylesheet" type="text/css" href="/style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/assets/image/icon.svg">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="/assets/js/include.js"></script>
  <script>
    $(document).ready(function(){
    $("#header").load("/header.html", null, function () { $('.nav-leaderboard').addClass('active'); });
    $("#footer").load("/footer.html");
    });
  </script>

<html>
  <div id="header"></div>
  <main>
	<h1> <img class="page-icon" src="/assets/image/icon_leaderboard.svg"> Leaderboard </h1>
  <div class="table-container">
    <table class="big-table">
      <thead>
        <tr>
          <th> Rank </th>
          <th> User </th>
          <th title="Problems Solved"> <img class="table-head-icon" src="/assets/image/icon_solved.svg"></th>
        </tr>
      </thead>

      <tbody>
        <?php 
          function user($userID, $userName, $userDisplay,$solved, $rank){
            return sprintf("<tr data-href='/user/%s.html'>
                              <td class='numbers'> %s </td>
                              <td style='text-align: left;'> 
                                <div class='user-block'>
                                  <div class='user-basic'>
                                      <img class='pfp' src='/assets/user/pfp/%s.webp'>
                                    <span class='user-name'>%s</span>
                                  </div>
                                  <span class='user-display'>%s </span>
                                </div>
                              </td>
                              <td class='numbers'> %s </td>
                            </tr>"
                            , $userID, $rank, $userID, $userName, $userDisplay, $solved);
          }

          echo user("1", "daniel", "lonely christmas", 571, 1);
          echo user("2", "jack", "TFT 14.148", 155, 2);
          echo user("3", "duncan", "yee", 114, 3);
        ?>
      </tbody>
    </table>
  </div>
  </main>
  <div id="footer"></div>
</html>