<? include("sql_connect.php");
	function dbg($str){
		echo "$str: ".$_POST[$str]."<br>";
	}

  $userID = 1;
  
  include("SettingsClass.php");
  $settings = new Settings();
  $settings->loadFromForm($userID);
  $settings->uploadToSQL();
  // To be added.
	dbg('emailAddress');
	dbg('oldPassword');
	dbg('newPassword');
	dbg('repeatNewPassword');
?>