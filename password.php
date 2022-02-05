<!DOCTYPE HTML>

<html style="height:100%;">
<head>
	<title>TWGSS Online Judge</title>
  <link rel="stylesheet" type="text/css" href="/style.css">
	<link rel="stylesheet" type="text/css" href="/entry.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="/assets/image/icon.svg">
	<script src="/assets/js/include.js">
	</script>
	<script src="/assets/js/theme.js">
	</script>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">
	</script>
</head>

<body style="width:100%; height:100%; display: flex; flex-direction: rows; flex-wrap: wrap; center; overflow: hidden;" onload="switch_panel(1);">
    <!-- Hardcoded sizes, The writer is afraid of compatiability. -->
    <div style="height:10%; width:inherit;"> </div>
    <div style="margin: 0 auto">
        <div class="unhighlightable" style="display: flex;margin-bottom: 40px; justify-content: center;">
          <img src="/assets/image/logo.svg" style="height: 40px">
        </div>

        <div style="width: 100%; display: flex; flex-direction: rows; flex-wrap: wrap;">

          <h1 style="margin:auto; margin-left: 0px;"> Welcome! </h1>
          
          <button id="login-btn" class="btn btn-on" onclick="window.location=https://www.youtube.com/watch?v=dQw4w9WgXcQ" style="border-top-left-radius: 2.5px;"> RESET PASSWORD </button> 
        </div>
        <form action="/php/reset_password.php" method="post" onkeydown="return event.key != 'Enter';">
            <table id="login_register_table" style="white-space: nowrap; height: 245px; width: 435px; ">
                <tbody id="login_register_panel">
                    <!-- login panel -->
                    <tr class="login_panel"> <td> Username / Email </td><td> <input name="login_userID" type="Text" placeholder="" /> </td></tr>
                    
                    <tr class="login_panel"> <td colspan="2"> <input class="btn submit" type="submit" name="login_submit" value="Login"> </td> </tr>
                </tbody>
            </table>
        </form>
        <?php 
            if(isset($_COOKIE['message'])){
                echo '<div class="status-msg">'. $_COOKIE['message'] . '</div>';
                setcookie('message', "", time() - 3600, "/");
            } ?>

        <script>
            // 0: register; 1: login
            function switch_panel(is_login) {
                var elem = document.getElementById('login_register_panel');
                const button_on = document.querySelector('.btn-on');
                const button_off = document.querySelector('.btn-off');
                document.getElementById("login-btn").className = (is_login == 1 ? "btn btn-on" : "btn btn-off");
                document.getElementById("register-btn").className = (is_login == 1 ? "btn btn-off" : "btn btn-on");
                for (var x = 0; x < elem.children.length; x++) {
                    if ((elem.children[x].className == "login_panel") == (is_login == 1)) {
                        elem.children[x].style.display = "table-row";
                    } else {
                        elem.children[x].style.display = "none";
                    }
                }
            }
        </script>

    </div>
    <div id="footer"> ©2022&emsp;TWGSS Olympiad in Informatics Team </div>
</body>
</html>