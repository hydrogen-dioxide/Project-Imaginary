<?php
class Settings{
  public $userID; public $userName; public $realName;
  public $displayName; public $preference;

	// Methods:
	// loadFromSQL($userID);
	// loadFromForm($userID);
	// toHTML();
  // getPreview();
	// updateFile(); =>  need
	// uploadToSQL();

	// getInfo($problemID, $problemName, $timeLimit, $memoryLimit, $memoryUnit);
	// getSubtasks($subtasks);
	// getSamples($samples);
	
	// Static variables:
	// languageList
	// header
	// footer

  function __construct() {
    $preference = array(
      "programmingLanguage" 		=> "C++17",
      "language" 					=> "eng",
      "lightDarkMode" 			=> "dark",
      "tabSize" 					=> "4"
    );

    $this->displyName = "";
    $this->preference = (object) $preference;
  }

  function loadFromSQL($userID){
    include($_SERVER["DOCUMENT_ROOT"]."/php/sql_connect.php");
    $sql = "SELECT userName, displayName, realName, email, preference, description
    FROM user
    WHERE userID = '".$conn->real_escape_string($userID)."'";
    // echo "<pre> $sql </pre>";
    $row = $conn->query($sql)->fetch_assoc() or die($conn->error);
    $this->userID = $userID;
    $this->userName = $row['userName'];
    $this->displayName = $row['displayName'];
    $this->realName = $row['realName'];
    $this->emailAddress = $row['email'];
    $this->preference = json_decode($row['preference']);
    $this->description = $row['description'];
  }

	static function getProfilePicturePath($userID){
	    $imgExtention = array("svg", "gif", "png", "jpeg", "jpg");
		for ($i=0; $i<count($imgExtention); $i++){
			$find = "/assets/user/pfp/$userID.$imgExtention[$i]";
			if (file_exists($_SERVER['DOCUMENT_ROOT'].$find)){
				return $find;
			}
		}
		return "/assets/user/pfp/default-m.png";
	}

  static function updateProfilePicture($userID){
    $original = getProfilePicturePath($userID);
    if($original != "/assets/user/pfp/default-m.png"){
      unlink($original);
    }
    $pfp = $_FILES['pfp']['name'];
    $pfpExploded = explode('.', $pfp);
    $pfpType = $pfpExploded[1];
    $pfpPath="/assets/user/pfp/".$userID.$pfpType;
    move_uploaded_file($_FILES["pfp"]["tmp_name"],$pfpPath);
  }

  function loadFromForm($userID){
  	$preference = array(
		  "programmingLanguage" 		=> $_POST['programmingLanguage'],
		  "language" 					=> $_POST['language'],
		  "lightDarkMode" 			=> $_POST['lightDarkMode'],
		  "tabSize" 					=> $_POST['tabSize']
	  );
    $this->userID = $userID;
    $this->preference = $preference;
    $this->displayName	= $_POST['displayName'];
    $this->description = $_POST['description'];
    updateProfilePicture($userID);
  }
  
  function uploadToSQL(){
    include($_SERVER["DOCUMENT_ROOT"]."/php/sql_connect.php");
    $att = array(
      "displayName"			=> $this->displayName,
      "preference"			=> json_encode($this->preference)
    );

    foreach($att as $key => $value){
      $att[$key] = '"'. $conn->real_escape_string($value) .'"';
    }

    if($conn->query("SELECT userID FROM user WHERE userID = '" . $_POST["id"] . "'")){
      $sql = "UPDATE user\nSET ";
      foreach($att as $key => $value){
        $sql .= $key .'='. $value . ',' . "\n";
      }
      $sql = rtrim($sql, ",\n");
      $sql .= "\n WHERE userID = '" . $conn->real_escape_string($_POST['userID']) . "';";
      echo '<pre>' . htmlspecialchars($sql) . '</pre>';
      $conn->query($sql);
      if($conn->errno) echo $conn->error;
    }else{
      $sql = "INSERT INTO user (";
      foreach($att as $key => $value){
        $sql .= $key . ",";
      }
      $sql = rtrim($sql, ",");
      $sql .= ")\nVALUES (";
      foreach($att as $key => $value){
        $sql .= $value . ", \n";
      }
      $sql = rtrim($sql, ", \n");
      $sql .= ');';
      echo '<pre>' . htmlspecialchars($sql) . '</pre>';
      $conn->query($sql);
      if($conn->errno) echo $conn->error;
    }
  }
}
 ?>