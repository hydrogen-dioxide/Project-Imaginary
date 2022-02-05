<!-- $taskID = "TO_BE_REPLACED" -->

<!DOCTYPE HTML>
<html>
<head>
<?php 
  function includeHeader($id="", $title="", $nav="") {
    include($_SERVER['DOCUMENT_ROOT']."/head.php");
  }
  includeHeader("problem/TO_BE_REPLACED/stats", "Statistics", "problems");
?>
</head>
<body>
	<div id="header"> </div>
  <main>
    <h1> Statistics </h1>
    <section>
    <h2> Solved Time </h2>
    <canvas id="chart-time" width="160" height="90"></canvas>
    <script>
      Chart.defaults.font.family = getComputedStyle(document.documentElement).getPropertyValue('--default-font');
      const ctx = document.getElementById('chart-time');
      const myChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: [
            <?php
              include($_SERVER['DOCUMENT_ROOT']."/php/sql_connect.php");
              $problemID = "SAMPLE";
              $res = $conn->query("SELECT timeLimit FROM problem where problemID = '".$conn->real_escape_string($problemID)."'");
              $TL = $res->fetch_row()[0];
              function setLabel($timeLimit){
                $output = "";
                for ($i=0; $i<=10; $i++){
                  $output .= "'" . sprintf('%.1f', floatval($timeLimit) * $i / 10) . "'" . ", ";
                }
                return $output;
              }
              echo setLabel($TL);
            ?>
            ],
              datasets: [{
                  data: [1,2, 1,3],
                  backgroundColor: 'rgba(31, 78, 121, 0.5)',
                  borderColor: 'rgba(128, 128, 128, 1)',
                  borderWidth: 1
              }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true,
                ticks: {
                  precision: 0
                }
              }
            },
            plugins: {
              legend: {
                display: false
              },
              tooltip: {
                displayColors: false,
                callbacks: {
                  title: function() {}
                },
                xAlign: 'center',
                yAlign: 'top',
                cornerRadius: 2.5
              }
            }
          }
      });
    </script>
    </section>
  </main>
  <div id="footer"> </div>
</body>
</html>