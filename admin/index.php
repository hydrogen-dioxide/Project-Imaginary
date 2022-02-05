
<!DOCTYPE HTML>
<html>

<head>
<?php 
  function includeHeader($id="", $title="", $nav="") {
    include($_SERVER['DOCUMENT_ROOT']."/head.php");
  }
  includeHeader("admin", "Admin", "admin");
?>
<style>
  .b {
      display: inline-block;
      position: relative;
      margin: 1%;
      float: left;
      width: 23%;
      height: 400px;
      color: black: 
      background-color: white;
  }
</style>
</head>

  <body>

    <div id="header"></div>
    <main>


			
      <h1> <img class="page-icon" src="/assets/image/icon_admin.svg"> Admin functions </h1>

      <section class="b">
        <h2>Total Question</h2>
        <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 10K+</h3>
      </section>

			<section class="b">
				<h2>Total account</h2>
				<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 5+</h3>
			</section>

			<section class="b">
				<h2>Total Visitor</h2>
				<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1300+</h3>
			</section>


      <button onclick="location.href='/admin/sql.php'"> SQL Functions </button>
      <br>
      <button onclick="location.href='/admin/user.php'"> User Management </button>
      <br>
      <button onclick="location.href='/admin/problem.php'"> Propose New Problem </button>
      <br>
      <button onclick="location.href='/admin/contest.php'"> Propose New Contest </button>
      <section>
			<h2>Chart</h2>
			<canvas id="newuser_questiondone" style="width:100%;max-width:600px"></canvas>
      </section>

      <section>
			<h2>Favourite Coding Language</h2>
			<center><canvas id="language_type" style="width:80%;max-width:400px"></canvas></center>
      </section>

			
    </main>
    <div id="footer"></div>
  </body>
	<script>
			var xValues = [100,200,300,400,500,600,700,800,900,1000];
			
			new Chart("newuser_questiondone", {
			  type: "line",
			  data: {
			    labels: xValues,
			    datasets: [{ 
			      data: [860,1140,1060,1060,1070,1110,1330,2210,7830,2478],
			      borderColor: "red",
			      fill: false
			    }, { 
			      data: [1600,1700,1700,1900,2000,2700,4000,5000,6000,7000],
			      borderColor: "blue",
			      fill: false
			    }]
			  },
			  options: {
			    legend: {display: false}
			  }
			});
			</script>
	<script>
var xValues = ["C++", "C+", "C#", "Python", "Java"];
var yValues = [55, 49, 44, 24, 15];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];

new Chart("language_type", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "World Wide Wine Production 2018"
    }
  }
});
</script>

</html>