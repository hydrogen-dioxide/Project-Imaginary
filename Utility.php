<?php

/* Class utility:
It stores all the stuff of visual component into functions.
Incentive: there might be lots of different page adapting the same style. It is wise to migrate them together.
 */
class Utility{
  // getProfilePicturePath($userID);
  // getVerdictClass($verdict);
  // squote($s);
  // dquote($s);
  
  // getUserBlock($userID, $userName, $userDisplay);
  // getProblemBlock($problemID, $problemName);
  // getContestBlock($contestID, $contestName);

  // getUserBlockFromSQL($userID);
  // getProblemBlockFromSQL($problemID);
  // getContestBlock($contestID);

  // getUserRow($userID, $userName, $userDisplay, $rank, $solved);
  // getProblemRow($problemID, $problemName, $solved, $attempted);
  // getSubmissionRow($submissionID, $submissionTime, $userID, $userName, $userDisplay, $problemID, $problemName, $language, $verdict, $verdictClass, $runtime, $memory);
  // getContestRow($contestID, $contestName, $contestantCount);
	static $userBlockFormat = '';
	static $problemBlockFormat = '';
  static $contestBlockFormat = '';

	static $userRowFormat = '';
	static $problemRowFormat = '';
	static $submissionRowFormat = '';
	static $contestRowFormat = '';

	static $problemCardFormat = '';
	static $announcementCardFormat = '';

  static $connectSQLPath = 'php/sql_connect.php';
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

  static function getVerdictName($short){
    $short = strtolower($short);
    $verdictSimpList = array("ac", "wa", "tle", "re", "ce", "ps", "sk", "inc");
    $verdictNameList = array("Accepted", "Wrong Answer", "Time Limit Exceeded", "Runtime Error", "Compilation Error", "Partial Score", "Skipped", "Including Subtask");
    for ($i=0; $i<count($verdictSimpList); $i++){
      if ($verdictSimpList[$i] == $short){
        return $verdictNameList[$i];
      }
    }
    return "";
  }
  
	static function squote($s) { return "'".$s."'"; }
	static function dquote($s) { return '"'.$s.'"'; }

	static function getUserBlock($userID, $userName, $userDisplay) : string{
		return sprintf(Utility::$userBlockFormat, $userID, Utility::getProfilePicturePath($userID),
						$userName, $userDisplay);
	}

  static function getUserBlockFromSQL($userID){
    include(Utility::$connectSQLPath);
    $res = $conn->query("SELECT userID, userName, displayName FROM user    WHERE userID = '" . $conn->real_escape_string($userID) . "'");
    if($res){
			$row = $res->fetch_row();
      return Utility::getUserBlock(...$row);
    }else{
      return "No such user.";
    }
  }

	static function getProblemBlock($problemID, $problemName) : string{
		return sprintf(Utility::$problemBlockFormat, $problemID, $problemName);
	}

  static function getProblemBlockFromSQL($problemID){
    include(Utility::$connectSQLPath);
    $res = $conn->query("SELECT problemID, problemName FROM problem    WHERE problemID = '" . $conn->real_escape_string($problemID) . "'");
    if($res){
			$row = $res->fetch_row();
      return Utility::getProblemBlock(...$row);
    }else{
      return "No such problem.";
    }
  }

	static function getContestBlock($contestID, $contestName) : string{
		return sprintf(Utility::$contestBlockFormat, $contestID, $contestName);
	}

  static function getContestBlockFromSQL($contestID){
    include(Utility::$connectSQLPath);
    $res = $conn->query("SELECT contestID, contestName FROM contest    WHERE contestID = '" . $conn->real_escape_string($contestID) . "'");
    if($res){
			$row = $res->fetch_row();
      return Utility::getContestBlock(...$row);
    }else{
      return "No such contest.";
    }
  }

	static function getUserRow($userID, $userName, $userDisplay, $rank, $solved) : string{
		return sprintf(Utility::$userRowFormat, $userID, Utility::getProfilePicturePath($userID),
						$userName, $userDisplay, $rank, $solved);
	}

	static function getProblemRow($problemID, $problemName, $solved, $attempted){
		return sprintf(Utility::$problemRowFormat, $problemID, $problemName, $solved, $attempted);
	}

	static function getSubmissionRow($submissionID, $submissionTime, $userID, $userName, $userDisplay,
									 $problemID, $problemName, $language, $verdict, $verdictClass, $runtime, $memory){
		return sprintf(Utility::$submissionRowFormat, $submissionID, $submissionTime,
						$userID, Utility::getProfilePicturePath($userID), $userName, $userDisplay,
						$problemID, $problemName, $language, $verdict, $verdictClass, $runtime, $memory);
	}

	static function getContestRow($contestID, $contestName, $contestantCount){
		return sprintf(Utility::$contestRowFormat, $contestID, $contestName, $contestantCount);
	}

	static function getUserRowFromSQL($userID){
		include_once(Utility::$connectSQLPath);
		$res = $conn->query("SELECT userID, userName, displayName, rank, solved
								WHERE userID = " . "'" . $conn->real_escape_string($userID) ."'");
		if($res){
			$row = $res->fetch_row();
			return getUserRow(...$row);
		}else{
			return "No such user.";
		}
	}

	static function getProblemRowFromSQL($problemID){
		include_once(Utility::$connectSQLPath);
		$res = $conn->query("SELECT problemID, problemName, solved, attempted
								WHERE problemID = " . "'" . $conn->real_escape_string($userID) ."'");
		if($res){
			$row = $res->fetch_row();
			return getProblemRow(...$row);
		}else{
			return "No such problem.";
		}
	}

	static function getSubmissionRowFromSQL($submissionID){
		include_once(Utility::$connectSQLPath);
            $res = $conn->query("
              SELECT s.submissionID, s.submissionTime, s.userID, u.userName, u.displayName,
					s.problemID,p.problemName, s.language, s.verdict, s.runtime, s.memory
              FROM submission s
              LEFT JOIN user u ON s.userID = u.userID
              LEFT JOIN problem p ON s.problemID = p.problemID
								WHERE s.submissionID = " . "'" . $conn->real_escape_string($submissionID) ."'");
		if($res){
			$row = $res->fetch_row();
			return getSubmissionRow(...$row);
		}else{
			return "No such submission";
		}
	}

	static function getContestRowFromSQL($contestID){
		include_once(Utility::$connectSQLPath);
		$res = $conn->query("SELECT contestID, contestName, contestantCount
								WHERE contestID = " . "'" . $conn->real_escape_string($contestID) ."'");
		if($res){
			$row = $res->fetch_row();
			return getContestRow(...$row);
		}else{
			return "No such contest";
		}
	}

	static function getProblemCard($problemID, $problemName, $solved, $attempted){
		return sprintf(Utility::$problemCardFormat, $problemID, $problemName, $solved, $attempted);
	}

	static function getAnnouncementCard($announcementTitle, $announcementDate, $announcementContent){
		return sprintf(Utility::$announcementCardFormat, $announcementTitle,
			$announcementDate, $announcementContent);
	}

  public static function redirect($location = null, $ignoreAbort = true)
  {
      header('Connection: close');
      ob_start();

      header('Content-Length: 0');
      header('Location: ' . $location);
      ob_end_flush();
      flush();

      if ($ignoreAbort) {
          ignore_user_abort(true);
      }
  }
}

/* A general note: it might be better to use associated array instead of indexing. Only change it if I have time. */

// userBlockFormat: userID, pfpPath, userName, userDisplay
Utility::$userBlockFormat = '
<a class="user-link" href="/user/%1$s">
  <div class="user-block">
	<div class="user-basic">
	  <img class="pfp" src="%2$s">
	  <span class="user-name">%3$s</span>
	</div>
	<span class="user-display">%4$s</span>
 </div>
</a>';
// problemBlockFormat: problemID, problemName
Utility::$problemBlockFormat = '
<a class="small-problem-link" href="/problem/%1$s">
    <div class="small-problem-block">
    <div class="small-problem-basic"><span class="small-problem-id">%1$s</span></div>
    <span class="small-problem-name">%2$s</span>
   </div>
</a>';

// contestBlockFormat: contestID, contestName
Utility::$contestBlockFormat = '
<a class="small-problem-link" href="/contest/%1$s">
    <div class="small-problem-block">
    <div class="small-problem-basic"><span class="small-problem-id">%1$s</span></div>
    <span class="small-problem-name">%2$s</span>
   </div>
</a>';


// userRowFormat: userID, pfpPath, userName, userDisplay, rank, solved;
Utility::$userRowFormat = '
<tr data-href="/user/%1$s">
	<td class="numbers">%5$s</td>
	<td style="text-align: left;">
	<div class="user-block">
		<div class="user-basic">
			<img class="pfp" src="%2$s">
		<span class="user-name">%3$s</span>
		</div>
		<span class="user-display">%4$s</span>
	</div>
	</td>
	<td class="numbers">%6$s</td>
</tr>';
// problemRowFormat: problemID, problemName, solved, attempted
Utility::$problemRowFormat = '
<tr data-href="/problem/%1$s">
	<td class="numbers">%1$s</td>
	<td>%2$s</td>
	<td class="numbers">%3$s</td>
	<td class="numbers">%4$s</td>
</tr>';
//                            1              2           3       4        5           6           7          8           9        10         11           12      13
// submissionRowFormat: submissionID, submissionTime, userID, userPFP, userName, userDisplay, problemID, problemName, language, verdict, verdictClass, runtime, memory
Utility::$submissionRowFormat = '
<tr>
	<td data-href="submission/%1$s" class="numbers">%1$s</td>
	<td class="numbers">%2$s</td>
	<td style="text-align: left;" data-href="/user/%3$s">
	<div class="user-block">
		<div class="user-basic">
			<img class="pfp" src="%4$s">
		<span class="user-name">%5$s</span>
		</div>
		<span class="user-display">%6$s</span>
	</div>
	</td>

	<td style="text-align: left;" data-href="/problem/%7$s">
	<div class="small-problem-block">
		<div class="small-problem-basic"><span class="small-problem-id">%7$s</span></div><span class="small-problem-name">%8$s</span></div>
	</td>

	<td>%9$s</td>
	<td class="%11$s">%10$s</td>
	<td class="numbers">%12$s</td>
	<td class="numbers">%13$s</td>
</tr>';
// contestRowFormat: contestID, contestName, contestantCount
Utility::$contestRowFormat = '
<tr data-href="/contest/%1$s">
  <td class="numbers">%1$s</td>
  <td>%2$s</td>
  <td class="numbers">%3$s</td>
</tr>';
// problemCardFormat: problemID, problemName, solved, attempted
Utility::$problemCardFormat = '
<a class="problem-stat-link" href="/problem/%1$s">
<div class="problem-stat-block">
    <div class="problem-block">
      <div class="problem-id">%1$s</div>
      <div class="problem-name">%2$s</div>
    </div>
    <div class="all-stats-block">
      <div class="stat-block mini" title="Solved">
        <span class="stat-label"><img src="/assets/image/icon_solved.svg"></span><span class="stat-no">%3$s</span>
      </div>
      <div class="stat-block mini" title="Attempted">
		    <span class="stat-label"><img src="/assets/image/icon_attempted.svg"></span><span class="stat-no">%4$s</span>
      </div>
    </div>
</div>
</a>';
// announcementCardFormat: announcementDate, announcementTitle, announcementContent
Utility::$announcementCardFormat = '
<div class="ann-card">
	<div class="ann-head">
		<span class="ann-date">%1$s</span>
		<span class="ann-title">%2$s</span>
	</div>
	<div class="ann-content">%3$s</div>
</div>';

/*
echo Utility::getUserBlock("1", "Daniel", "Lonely Christmas rip :(") . '<br>';
echo Utility::getProblemBlock("X0000", "Printing Pages (TESTING)");
echo Utility::getUserRow("1", "daniel", "lonely christmas", 571, 1);
echo Utility::getProblemRow("X0000", "Printing Pages (TESTING)", 1, 5);
echo Utility::getSubmissionRow("1", "27/12", "00:00:00", "1", "Daniel", "Lonely Christmas rip", "X0001",
"Printing Pages", "C++20", "Accepted", "ac", "0.023 s", "89.64MB");*/
?>