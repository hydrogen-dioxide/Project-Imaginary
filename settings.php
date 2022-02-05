<!DOCTYPE HTML>
<html>
<head>
  <?php 
    function includeHeader($id="", $title="", $nav="") {
      include($_SERVER['DOCUMENT_ROOT']."/head.php");
    }
    includeHeader("settings", "Settings", "settings");
  ?>
  <script
			  src="https://code.jquery.com/jquery-3.6.0.min.js"
			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
			  crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<?php
  include($_SERVER['DOCUMENT_ROOT']."/php/SettingsClass.php");
  $hash = "0";
  $userID = 1;
  $settings = new Settings();
  $settings->loadFromSQL($userID);
  /*echo $preference->programmingLanguage;
  echo $preference->language;
  echo $preference->lightDarkMode;
  echo $preference->tabSize;*/
?>
<body>
  <div id="header"></div>
  <main>
	<h1> <img class="page-icon" src="/assets/image/icon_settings.svg"> Settings</h1>
  <form action="php/update_settings.php" method="POST" enctype="multipart/form-data">
	<section>
    <input style="display: none;" name="hash" value="<?php echo $hash; ?>">
    <input style="display: none;" name="userID" value="<?php echo $settings->userID; ?>">
    <h2> Basic Information </h2>
    <div class="table-container">
      <table>
        <tbody>
          <tr>
            <td> Username </td>
            <td> <?php echo $settings->userName; ?> </td>
          </tr>

          <tr>
            <td> Display Name </td>
            <td> <input type="text" name="displayName" value="<?php echo $settings->displayName ?>">  </td>
          </tr>

          <tr>
            <td> Real Name </td>
            <td> <?php echo $settings->realName; ?> </td> <!-- idk if it is good to use realName? maybe lead to some sort of privacy problem? -->
          </tr>

          <tr>
            <td> Email Address </td>
            <td> <input type="email" name="emailAddress" value="<?php echo $settings->emailAddress; ?>"> </td>
          </tr>

          <tr>
            <td> Programming Language </td>
            <td>
              <select name="programmingLanguage">
                <option value="cpp11" <?php if($settings->preference->programmingLanguage == "cpp11") echo "checked" ?> >C++</option>
                <option value="c" <?php if($settings->preference->programmingLanguage == "c") echo "checked" ?> >C</option>
                <option value="py" <?php if($settings->preference->programmingLanguage == "py") echo "checked" ?> >Python</option>
              </select>
            </td>
          </tr>

          <!--tr>
            <td> Colour Theme (NO USE, quick toggle already in header) </td>
            <td>
              <input name="theme" type="radio" value=0>Light 
              <input name="theme" type="radio" value=0>Dark
            </td>
          </tr-->

          <tr>
            <td> Language </td>
            <td>
              <input name="language" type="radio" value="eng" <?php if($settings->preference->language == "eng") echo "checked" ?>>English
              <input name="language" type="radio" value="chi" <?php if($settings->preference->language == /*"chi"*/"eng") echo "checked" ?>><!--繁體中文-->英文
            </td>
          </tr>

          <tr>
            <td> Tab size </td>
            <td>
              <input name="tabSize" type="radio" value="2" <?php if($settings->preference->tabSize == "2") echo "checked" ?>>2 spaces
              <input name="tabSize" type="radio" value="4" <?php if($settings->preference->tabSize == "4") echo "checked" ?>>4 spaces
              <input name="tabSize" type="radio" value="8" <?php if($settings->preference->tabSize == "8") echo "checked" ?>>8 spaces
            </td>
          </tr>
        </tbody>
      </table>
    </div>
	</section>

  <section>
	  <h2> Appearance </h2>
    <div class="table-container">
      <table>
        <tbody>
          <tr>
            <td> Dark mode / Light mode
            </td>
            <td> 
              <input name="lightDarkMode" type="radio" value="dark" <?php if($settings->preference->lightDarkMode == "dark") echo "checked" ?>>Dark mode
              <input name="lightDarkMode" type="radio" value="light" <?php if($settings->preference->lightDarkMode == "light") echo "checked" ?>>Light mode
            </td>
          </tr>
          <tr>
            <td> Profile Picture </td>
            <td> <input type="file" id="pfp" name="pfp" accept="image/svg+xml, image/gif, image/png, image/jpeg, image/jpg"></td>
          </tr>

          <tr>
            <td> Personal Description </td>
            <td> <textarea name="description" cols="30" rows="6" class="code" type="text" style="resize: none; white-space: pre-wrap; overflow-wrap: normal;"><?php echo $settings->description ?></textarea> </td>
          </tr>
        </tbody>
      </table>
    </div>
	</section>

  <section>
	  <h2> Change Password </h2>
    <div class="table-container">
      <table>
        <tbody>
          <tr>
            <td> Old Password </td>
            <td> <input type="password" name="oldPassword"> </td>
          </tr>

          <tr>
            <td> New Password </td>
            <td> <input type="password" name="newPassword"> </td>
          </tr>

          <tr>
            <td> Repeat New Password </td>
            <td> <input type="password" name="repeatNewPassword"> </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>

  <button type="submit" id="confirm_pass"> Confirm Changes </button>
	<!--<script>
    
		$('#confirm_pass').on('click', function(){
			Swal.fire({
				position: 'top-end',
				icon: 'success',
				title: 'Your password have been saved',
				showConfirmButton: false,
				timer: 1500
			})
		})
	</script>-->
  </main>
  <div id="footer"></div>
</body>
</html>