<?php include("sql_connect.php");

class Session{

function loadUser($userID){ // loadUser info. Some maybe stored in the cookie, while currently the userID is stored in the session.
	$result = $conn->query("SELECT userID, username, email FROM `login` WHERE `userID` = '$userID';");
	if($conn->errno) echo $conn->error;
	if(mysqli_num_rows($result) == 0) return false;
	$row = mysqli_fetch_assoc($result);
	$_SESSION['userID'] = $userID;
	$_SESSION['username'] = $row['username'];
	$_SESSION['email'] = $row['email'];
	return true;
}

function regenerateSession($reload = false) // https://www.php.net/manual/en/function.session-regenerate-id.php
{
    // This token is used by forms to prevent cross site forgery attempts
    if(!isset($_SESSION['nonce']) || $reload)
        $_SESSION['nonce'] = bin2hex(openssl_random_pseudo_bytes(32));

    if(!isset($_SESSION['IPaddress']) || $reload)
        $_SESSION['IPaddress'] = $_SERVER['REMOTE_ADDR'];

    if(!isset($_SESSION['userAgent']) || $reload)
        $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];

    // Set current session to expire in 3 hours
    $_SESSION['OBSOLETE'] = true;
    $_SESSION['EXPIRES'] = time() + 60 * 60 * 3;

    // Create new session without destroying the old one
    session_regenerate_id(false);

    // Grab current session ID and close both sessions to allow other scripts to use them
    $newSession = session_id();
    session_write_close();

    // Set session ID to the new one, and start it back up again
    session_id($newSession);
    session_start();

    // Don't want this one to expire
    unset($_SESSION['OBSOLETE']);
    unset($_SESSION['EXPIRES']);
}

function checkSession()
{
    try{
        if($_SESSION['OBSOLETE'] && ($_SESSION['EXPIRES'] < time())){
            echo "Expired"; throw new Exception('Attempt to use expired session.');
		}

        if(!is_numeric($_SESSION['userID'])){
            echo "No session"; throw new Exception('No session started.');
		}

        if($_SESSION['IPaddress'] != $_SERVER['REMOTE_ADDR']){
            echo "IP mismatch"; throw new Exception('IP Address mixmatch (possible session hijacking attempt).');
		}

        if($_SESSION['userAgent'] != $_SERVER['HTTP_USER_AGENT']){
            echo "useragent mismatch"; throw new Exception('Useragent mixmatch (possible session hijacking attempt).');
		}

        if(!loadUser($_SESSION['userID'])){
			echo "User not exist"; throw new Exception('Attempted to log in user that does not exist with ID: ' . $_SESSION['userID']);
		}

        if(!$_SESSION['OBSOLETE'] && mt_rand(1, 100) == 5){
            regenerateSession();
        }
        return true;

    }catch(Exception $e){
        return false;
    }
}

}


?>