<!DOCTYPE HTML>
<html>
<head>
<?php 
  function includeHeader($id="", $title="", $nav="") {
    include($_SERVER['DOCUMENT_ROOT']."/head.php");
  }
  includeHeader("submission/index.php", "Submission #$submissionID", "submissions");
?>
</head>
<?php
  include($_SERVER['DOCUMENT_ROOT']."/php/SubmissionClass.php");
  $submission = new Submission(); $submission->loadFromSQL($submissionID);
  $results = $submission->results;
  $userID = $submission->userID;
  $problemID = $submission->problemID;
  $contestID = $submission->contestID;
  $verdict = strtolower($submission->verdict);
  $score = $submission->score;
  $runtime = $submission->runtime;
  $memory = $submission->memory / 1024;
  $sourceCode = $submission->sourceCode;

?>
<?php include($_SERVER['DOCUMENT_ROOT']."/Utility.php"); ?>
<body>
  <div id="header"></div>
  <main>
  <h1 class='page-head'>
    <div class="page-head-id"><?php echo $submissionID ?></div>
    <div class="page-head-name">Submission #</div>
  </h1>
	<h1>Submission #<?php echo $submissionID ?> </h1>
  <div class="multi-container">
    <section>
      <h2> Information </h2>
      <div class="table-container">
        <table>
          <tbody>
            <tr>
              <td>User</td>
              <td data-href=<?php echo "/user/".$userID;?>><?php echo Utility::getUserBlockFromSQL($userID);?></td>
            </tr>

            <tr>
              <td>Problem</td>
              <td data-href=<?php echo "/problem/".$problemID;?>><?php echo Utility::getProblemBlockFromSQL($problemID);?></td>
            </tr>

            <?php
              if (!is_null($contestID)){
                echo "
                  <tr>
                    <td>Contest</td>
                    <td data-href=/contest/".$contestID.">".Utility::getContestBlockFromSQL($contestID)."</td>
                  </tr>
                ";
              }
            ?>

            <tr>
              <td>Verdict</td>
              <td class=<?php echo $verdict;?>><?php echo Utility::getVerdictName($verdict);?></td>
            </tr>

            <tr>
              <td>Score</td>
              <td><?php echo round($score, 3);?></td>
            </tr>

            <tr>
              <td>Runtime</td>
              <td><?php echo number_format($runtime, 3, '.', '');?> s</td>
            </tr>

            <tr>
              <td>Memory</td>
              <td><?php echo number_format($memory, 3, '.', '');?> MB</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
    
    <section>
      <h2> Details </h2>
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>Subtask</th>
              <th>Test</th>
              <th>Verdict</th>
              <th>Runtime</th>
              <th>Memory</th>
              <th>Score</th>
            </tr>
          </thead>
          <tbody>
            <?php
              function submissionCaseRow($subtask, $test, $verdict, $time, $memory, $score, $including=null){
                $verdictSimpList = array("ac", "wa", "tle", "re", "ce", "ps", "sk", "inc");
                $verdictNameList = array("Accepted", "Wrong Answer", "Time Limit Exceeded", "Runtime Error", "Compilation Error", "Partial Score", "Skipped", "Including Subtask");
                $verdict = strtolower($verdict);

                $memory = $memory / 1024;

                $verdictName = "";
                for ($i=0; $i<count($verdictSimpList); $i++){
                  if ($verdictSimpList[$i] == $verdict){
                    $verdictName = $verdictNameList[$i];
                    break;
                  }
                }
                if ($verdict == "wa" || $verdict == "tle" || $verdict == "re" || $verdict == "ce" || $verdict == "sk"){
                  $score = "";
                }else{
                  $score = number_format($score, 3, '.', '');
                }

                if ($verdict == "sk"){
                  return "
                    <tr>
                      <td>$subtask</td>
                      <td>$test</td>
                      <td class=$verdict colspan='4'>$verdictName</td>
                    </tr>
                  ";
                }

                if ($verdict == "inc"){
                  return "
                    <tr>
                      <td>$subtask</td>
                      <td class=$verdict colspan='4'>$verdictName $including</td>
                      <td>$score</td>
                    </tr>
                  ";
                }

                return "
                  <tr>
                    <td>$subtask</td>
                    <td>$test</td>
                    <td class=$verdict>$verdictName</td>
                    <td>".number_format($time, 3, '.', '')." s</td>
                    <td>".number_format($memory, 3, '.', '')." MB</td>
                    <td>$score</td>
                  </tr>
                ";
              }

              for ($i=0; $i<count($results["testcases"]); $i++){
                $now = $results["testcases"][$i];
                echo submissionCaseRow(
                  $now["subtask"],
                  $now["subtaskCase"],
                  $now["verdict"],
                  $now["runtime"],
                  $now["memory"],
                  $now["score"],
                  $now["including"],
                );
              }
            ?>
          </tbody>
        </table>
      </div>
    </section>

    <section>
      <h2> Result </h2>
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>Subtask</th>
              <th>Verdict</th>
              <th>Score</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php
              function submissionSubtaskRow($subtask, $verdict, $total, $score){
                $verdict = strtolower($verdict);
                $verdictName = Utility::getVerdictName($verdict);
                $score = number_format($score, 3, '.', '');

                return "
                  <tr>
                    <td>$subtask</td>
                    <td class=$verdict>$verdictName</td>
                    <td>".round($score, 3)."</td>
                    <td>$total</td>
                  </tr>
                ";
              }

              for ($i=0; $i<count($results["subtasks"]); $i++){
                $now = $results["subtasks"][$i];
                echo submissionSubtaskRow(
                  $now["subtask"],
                  $now["verdict"],
                  $now["totalScore"],
                  $now["score"],
                );
              }
            ?>
          </tbody>
        </table>
      </div>
    </section>
  </div>
  
  <section>
    <h2>Source Code</h2>
      <textarea name="source_code_text" cols="80" rows="20" class="code" type="text" style="resize: none; tab-size: 2;" ><?php echo $sourceCode; ?></textarea>
  </section>
  </main>
  <div id="footer"></div>
</body>
</HTML>
