<!-- Beginning of php form -->
<?php include("sql_connect.php"); include("session.php");
	function sendDiscordMsg($content, $username = null){
		// URL FROM DISCORD WEBHOOK SETUP
		global $DC_WEBHOOK; // Defined in secret_info.php;
		$url = $DC_WEBHOOK;
		$headers = [ 'Content-Type: application/json; charset=utf-8' ];
		$POST = [ 'username' => ($username == null ? "Anonymous" : $username), 'content' => "$content" ];

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
		$response   = curl_exec($ch);
	}

	if(isset($_POST['login_submit'])){
		$msg = "Success";
		$login_error = 0;
		$login_mode = "";
		if(!(isset($_POST['login_userID']) && !empty($_POST['login_userID']) AND isset($_POST['login_password']) && !empty($_POST['login_password']))){
			$msg = "Error: Some fields are empty.";
			$login_error = 1;
		}

		// prevent mysql injection?
		$userID = $_POST['login_userID'];
		$password = $_POST['login_password'];


		// Check connection
		if ($conn->connect_error) {
			$msg = "Error: unable to connect to SQL server. Please contact the server admin.";
			$error = 1;
			echo "Unable to connect to the SQL server" . "<br>";
		}

		echo "SQL Connected successfully" . "<br>";
		// ***** end of SQL connection *****

		if(!$login_error && preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $userID)){
			$login_mode = "email";
		}else if(!$login_error && (strlen($userID) <= 15 && preg_match("^[_a-zA-Z0-9\-]*^", $userID))){ // Need to add criteria for username. HKOI mode or Codeforces mode?
			$login_mode = "username";
		}else{
			$msg = "Error: Incorrect username/email or password.";
			$login_error = 1;
		}

		do{
			if($login_mode == "email"){
				$search = $conn->query("SELECT userID, username, email, hash FROM `login` WHERE email='$userID' AND password='$password'");
				$row = mysqli_fetch_assoc($search);
				$msg = "Login success. Login mode: " . $login_mode . '.<br>' . "UserID: " . $row['userID'] . ", username: " . $row['username'] . ", email: " . $row['email'];
				$realUserID = $row['userID'];
				if(mysqli_num_rows($search) == 0){
					$msg = "Error: Incorrect username/email or password.";
					$login_error = 1;
					break;
				}
			}else{
				$search = $conn->query("SELECT userID, username, email, hash FROM `login` WHERE username='$userID' AND password='$password'");
				$row = mysqli_fetch_assoc($search);
				$msg = "Login success. Login mode: " . $login_mode . '.<br>' . "UserID: " . $row['userID'] . ", username: " . $row['username'] . ", email: " . $row['email'];
				$realUserID = $row['userID'];
				if(mysqli_num_rows($search) == 0){
					$msg = "Error: Incorrect username/email or password.";
					$login_error = 1;
					break;
				}
			}
		}while(0);
		setcookie('message', $msg, 0, "/");
		if(!$login_error){
			session_start();
			regenerateSession(1);
			loadUser($realUserID);
			if(isset($_COOKIE['target'])){
				echo "Location: " . $_COOKIE['target'];
				header("Location: " . $_COOKIE['target']);
			}else{
				header("Location: /main.php");
			}
			
		}else{
			$_COOKIE['message'] = "Error!";
			header("Location: /entry.php");
		}
	}else if(isset($_POST['register_submit'])){
		$msg = "Success";
		$error = 0;

		do{
			// ***** start of SQL connection *****
			$sql_servername =	$SQL_SERVERNAME;
			$sql_username   =	$SQL_USERNAME;
			$sql_password   =	$SQL_PASSWORD;
			$sql_database   = $SQL_DATABASE;
			// Create connection
			$conn = new mysqli($sql_servername, $sql_username, $sql_password, $sql_database);

			// Check connection
			if ($conn->connect_error) {
				$msg = "Error: unable to connect to SQL server. Please contact the server admin.";
				$error = 1;
				echo "Unable to connect to the SQL server" . "<br>";
				break;
			}

			echo "SQL Connected successfully" . "<br>";
			// ***** end of SQL connection *****
			if(!(isset($_POST['username']) && !empty($_POST['username']) AND 
					isset($_POST['email']) && !empty($_POST['email']) AND 
					isset($_POST['password']) && !empty($_POST['password']) AND 
					isset($_POST['confirm_password']) && !empty($_POST['confirm_password']))){
				$msg = "Error: Some fields are empty.";
				$error = 1;
				break;
			}
			$username = $_POST['username'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$confirm_password = $_POST['confirm_password'];
			if(!$error && $password != $confirm_password){
				$msg = "Error: Password does not match with confirm password.";
				$error = 1;
				break;
			}

			if(!$error && strlen($username) > 15){
				$msg = "Error: Length of username must not exceed 15.";
				$error = 1;
				break;
			}

			if(!$error && !preg_match("^[_a-zA-Z0-9\-]*^", $username)){
				$msg = "Error: Username contain illegal symbols other than a-z, A-Z, 0-9, '-' and '_'.";
				$error = 1;
				break;
			}

			if(!$error && !preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email)){
				$msg = "Error: Email is not valid.";
				$error = 1;
				break;
			} 

			$search = $conn->query("SELECT userID, username, email, hash FROM `login` WHERE username='$username'");
			if(!$error && (mysqli_num_rows($search) > 0)){
				$msg = "Error: Username already taken.";
				$error = 1;
				break;
			}
			
			$search = $conn->query("SELECT userID, username, email, hash FROM `login` WHERE email='$email'");
			if(!$error && (mysqli_num_rows($search) > 0)){
				$msg = "Error: Email already in use.";
				$error = 1;
				break;
			}
			
			$msg = "Registration successful. <br> Please check your email to verify your account. <br> <i> Not receiving the email? </i> Check the junk folder, or <br> click here to resend the verification email.";
			$code_6 = sprintf('%06d', rand(1, 999999)); $hash = hash('md5', $code_6);
			$to = $email;
			$subject = 'TWGSS Online Judge email verification';
			$link = "http://twgss-online-judge-test.cf/php/verify.php?email=" . $email . "&hash=" . $hash;
			echo $link . "<br>";
			$message = "Hi " . $username . ", \r\n \r\n" . "Your registration has been approved, and your link for verification is $link. \r\n\r\nBest Regards, \r\nThe TWGSS Online Judge";
			echo $message . "<br>";
			$headers = 'From: registration@twgss-online-judge-test.cf' . '\r\n';

			if(mail($to, $subject, $message, $headers)){
				echo "Mail sended successfully." . "<br>";
			} else {
				$msg = "Error: unable to send the email. Please contact the server admin.";
				$error = 1;
				echo "Error in mailing" . "<br>";
				// break;
			}

			$sql = "INSERT INTO `login` (`username`, `password`, `email`, `hash`)
					VALUES ('$username', '$password', '$email', '$hash');";
			$conn->query($sql);

			$discord_msg = $username . ' with email ' . $email . 'has registrated. Wow, it works!';
			sendDiscordMsg($discord_msg, "registrationBOT"); // SENDS MESSAGE TO DISCORD
		} while(0);
		setcookie('message', $msg, 0, "/");
		header("Location: /entry.php");
	}
?>
<!-- End of php form -->