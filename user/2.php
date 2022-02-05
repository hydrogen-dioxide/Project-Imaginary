<!DOCTYPE HTML>
<html>

  <head>
    <title> User | TWGSS Online Judge</title>
    <link rel="stylesheet" type="text/css" href="/style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/assets/image/icon.png">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
      $(document).ready(function(){
      $("#header").load("/header.html", null, function () { $('.nav-' + location.pathname.split("/")[1]).addClass('active'); });
      $("#footer").load("/footer.html");
      });
    </script>
  </head>

  <body>
    <div id="header"></div>
    <main>
      <h1 style="text-transform: none">Jack Wong
        <a class="rank" href="/leaderboard.php" title="Leaderboard"><img src="/assets/image/icon_leaderboard.png" height="12px">#999</a>
      </h1>
      <div style="display: flex; flex-direction: row">
        <img class="pfp" src="/assets/image/pfp-test-transparent.png" width="128px" height="128px">
        <div style="width: 13px"> </div>
        <div>
          Name: Jack Wong <br>
          Class: 5C <br>
          <button> Direct Message </button>
          <button> Add as friend </button>
        </div>
      </div>
      
      <section id="description">
      <h2> Personal Description </h2>
      <p> Hi I would like to relax. </p>
      </section>

      <section id="contest"> 
      <h2> Participated Contests <div class="count">2</div> </h2>
      <button onclick="location.href='/contest/0000'"> Beta Round #1 </button> <button onclick="location.href='/contest/0001'"> Beta Round #2 </button>
      </section>
      
      <section id="problem">
      <h2> Solved Problems <div class="count">2</div> </h2>
      <button class="prob-button" onclick="location.href='/problem/0000'"> 0000 </button> 
      <button class="prob-button" onclick="location.href='/problem/0001'"> 0001 </button>
      </section>
    </main>
    <div id="footer"></div>
  </body>
</html>
<!--
	  <a href="/setting.php"> Setting </a>
      <br>
	  <a href="/admin/index.html"> Admin </a>
-->