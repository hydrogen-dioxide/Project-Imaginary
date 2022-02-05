  <?php include("php/sql_connect.php"); include("Utility.php");?>

  <div id="header-real">

		<a href="/" id="logo" class="unhighlightable"><span id="logo-icon"><img src="/assets/image/logo_icon_1.svg" id="logo-light"><img src="/assets/image/logo_icon_2.svg" id="logo-dark"></span><span id="logo-word"><img src="/assets/image/logo_word.svg"></span><span style="margin-left: 10px; font-size: small;">alpha</span></a>


    <ul id="nav">

      <li><a class="web-section nav-lab unhighlightable" href="/lab.php"><img class="header-page-icon" src="/assets/image/icon_lab.png"><span class="portrait-hide">Lab</span></a></li>

      <li><a class="web-section nav-problems unhighlightable" href="/problems.php"><img class="header-page-icon" src="/assets/image/icon_problems.svg"><span class="portrait-hide">Problems</span></a></li>

      <li><a class="web-section nav-contests unhighlightable" href="/contests.php"><img class="header-page-icon" src="/assets/image/icon_contests.svg"><span class="portrait-hide">Contests</span></a></li>

      <li><a class="web-section nav-leaderboard unhighlightable" href="/leaderboard.php"><img class="header-page-icon" src="/assets/image/icon_leaderboard.svg"><span class="portrait-hide">Leaderboard</span></a></li>

      <li><a class="web-section nav-submissions unhighlightable" href="/submissions.php"><img class="header-page-icon" src="/assets/image/icon_submissions.svg"><span class="portrait-hide">Submissions</span></a></li>

      <li><a class="web-section nav-admin unhighlightable" href="/admin"><img class="header-page-icon" src="/assets/image/icon_admin.svg"><span class="portrait-hide">Admin</span></a></li>

      <div class="nav-user-option web-section">
      <li><a title="My Profile" class="pfp-container web-section nav-myself unhighlightable" href="/user/1.php"><img class="pfp header-page-icon" src="<?php echo Utility::getProfilePicturePath(1); ?>"></a></li>

      <li><a title="My Submissions" class="web-section nav-mysubmission unhighlightable" href="/user/mysubmissions.php"><img class="header-page-icon" src="/assets/image/icon_submissions.svg"></a></li>
      
      <li><a title="Settings" class="web-section nav-settings unhighlightable" href="/settings.php"><img class="header-page-icon" src="/assets/image/icon_settings.svg"></a></li>

      </div>

      <li><a title="" class="web-section unhighlightable" href="https://docs.google.com/document/d/1jzLLl-O__AZFfOGZi48u81EkUnqhtolIGDeJpWN_E_Q/edit">DOC</a></li>

      <li> <a href="/entry.php"  class="web-section unhighlightable">[TEMP] Entry page</a> </li>
        
    </ul>

    <div id="top-right">
      <div id="mode-icon" class="unhighlightable" onclick="changeTheme()"><img src="/assets/image/icon_dark.svg" id="dark-icon" alt="Dark Mode"><img src="/assets/image/icon_light.svg" id="light-icon" alt="Light Mode"></div>
      <div class="unhighlightable" id="clock"></div>
    </div>
    <script>
      // https://stackoverflow.com/questions/29971898/how-to-create-an-accurate-timer-in-javascript
      var interval = 1000; // ms
      var expected = Date.now() + interval;
      step();
      setTimeout(step, interval);
      function step() {
          var dt = Date.now() - expected;
          var now = new Date().getTime();
          const zeroPad = (num, places) => String(num).padStart(places, '0');
          now += 1000 * 60 * 60 * 8; // Hong Kong UTC+8
          var hours = Math.floor((now % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((now % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((now % (1000 * 60)) / 1000);
          document.getElementById("clock").innerHTML = zeroPad(hours, 2) + ":" + zeroPad(minutes, 2) + ":" + zeroPad(seconds, 2);
          expected += interval;
          setTimeout(step, Math.max(0, interval - dt)); // take into account drift
      }
    </script>
  </div>

  <div id="header-space"></div>