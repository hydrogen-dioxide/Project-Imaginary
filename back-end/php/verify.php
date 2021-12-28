<!-- Beginning of php form -->
<?php include("secret_info.php");
	if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){

		$email =$_GET['email']; // Set email variable
		$hash = $_GET['hash']; // Set hash variable
                 
		$search = $conn->query("SELECT email, hash, active FROM `login` WHERE email='$email' AND hash='$hash' AND active='0'") or die($conn->error());
		$match  = mysqli_num_rows($search);

		if($match > 0){
			// Success
			$conn->query("UPDATE `login` SET active='1' WHERE email='$email' AND hash='$hash' AND active='0'") or die($conn->error());
			$msg = "Your account has been activated, you can now login to your account.";
			$error = 0;
		}else{
			// No match -> invalid url or account has already been activated.
			$msg = "Error: the url is either invalid or you already have activated your account.";
			$error = 1;
		}
	}else{
		$msg = "Error: the url is either invalid or you already have activated your account.";
		$error = 1;
	}
	setcookie('message', $msg, 0, "/");
	header("Location: ../entry_page.php");
?>