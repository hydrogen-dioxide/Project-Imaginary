<!DOCTYPE HTML>
<html>
<head>
  <?php 
    function includeHeader($id="", $title="", $nav="") {
      include($_SERVER['DOCUMENT_ROOT']."/head.php");
    }
    includeHeader("help", "Help", "");
  ?>
</head>

<body>
  <div id="header"></div>
  <div id="back"></div>
  <main>
    <h1> Help </h1>
    <section>
      <h2> Explanation </h2>
      <table>
        <tbody>
          <?php
            function helpLine($a, $b){
              echo "
                <tr>
                  <td style='font-weight: bold;'>$a</td>
                  <td style='text-align: left'>$b</td>
                </tr>
              ";
            }

            helpLine(
              "Problem Statement",
              "
              Statement of the problem. MathJax is currently used to correctly show some mathematical symbols and equations. The problem statement can be written in markdown form (for the sake of simplicity) and will then be converted into HTML form. (A basic knowledge on markdown will suffices)
              "
            );

            helpLine(
              "Test Cases",
              "
              All the tests which will be tested against the participants' code. If a participants' code passes all the given tests within a subtask, the score of the subtask will be given to the participant. Sometimes the subtasks will have dependencies, which means the participant must pass all the test cases of the prior subtask in order to gain score. Sometimes the test cases cannot spot the error in participants' code, then the score is still gained by the participant. Such test cases are indeed 'failed', but the test cases shall still never be changed during contest upon minor mistakes.
              "
            );

            helpLine(
              "Checkers",
              "
              Code responsible to check whether the source code submitted does or doesn't correctly solve the problem. For interactive tasks the code for checkers might be more sophisticated. Sometimes partial score will be given (e.g. problems with scoring curve, or output-only problems), which is also based on the checker. The default checker is to compare whether the output produced by the problem setter's code is the same as the participant's code. Normally one and exactly one checker will be used per problem.
              "
            );

            helpLine(
              "Validators",
              "
              Code responsible to check whether the test cases matchs the constraint set in the problem statement (e.g. to check if a graph is indeed a tree). Normally as long as the correctness of the inputs are guranteed (e.g. test datas are from other sites or the generator of the test cases are very simple), it may be left empty. Multiple validators can be used for a single problem for different subtasks.
              "
            );

            helpLine(
              "Expected Solution(s)",
              "
              The solution(s) which expected to get full scores.
              "
            );

            helpLine(
              "Suboptimal Solution(s)",
              "
              The solution(s) which are expected to get partial scores.
              "
            );

            helpLine(
              "Scorer",
              "
              Uses rarely, there actually exists some problems that require special scoring functions. The default is the sum of the points that the test cases solved.
              "
            );

          ?>
        </tbody>
      </table>
    </section>
  </main>
  <div id="footer"></div>
</body>
</html>