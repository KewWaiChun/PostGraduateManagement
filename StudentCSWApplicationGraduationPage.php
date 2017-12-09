<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Student CSW Application Graduation Page</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/justified-nav.css" rel="stylesheet">

    <link href="css/custom.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>
    <script type="text/javascript" src="Scripts/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="Scripts/bootstrap.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
      <div class="masthead">
        <nav>
          <ul class="nav nav-justified">
            <li><a href="StudentCSWHomePage.php">Home</a></li>
            <li class="dropdown">
              <a id="dLabel" role="button" data-toggle="dropdown" class="btn btn-primary" data-target="#" href="#"">
                Application <span class="caret"></span>
              </a>
              <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                <li><a href="StudentCSWApplicationResourcePage.php">Resource Reservation</a></li>
                <li class="active"><a href="StudentCSWApplicationGraduationPage.php">Graduation</a></li>
              </ul>
            </li>
            <li><a href="StudentCSWEnrollmentPage.php">Enrollment</a></li>
            <li class="dropdown">
              <a id="dLabel" role="button" data-toggle="dropdown" class="btn btn-primary" data-target="#" href="#"">
                Academic <span class="caret"></span>
              </a>
              <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                <li><a href="StudentCSWAcademicTimetablePage.php">TimeTable</a></li>
                <li><a href="StudentCSWAcademicExamSlipPage.php">Exam Slip</a></li>
                <li><a href="StudentCSWAcademicResultSlipPage.php">Result Slip</a></li>
              </ul>
            </li>
            <li><a href="StudentCSWFinancialPage.php">Finance</a></li>
            <li><a href="StudentCSWProfilePage.php">Profile</a></li>
            <li><a href="index.html">Log Out</a></li>
          </ul>
        </nav>
      </div><!-- masthead -->
      <br><br>

      <div>
        <div class="hotel_reserve_box">
          <h3 style="text-align: center">Graduation</h3><br>
          <?php
				include "connect.php";
				session_start();

				$studentID = $_SESSION['stu_ID'];
				
				$sql="SELECT DISTINCT Student_Name, Student_Course, Student_Mode, Student_Faculty
				FROM Student
				WHERE Student_ID=$studentID;";					//Student ID////////
				
				$sql2="SELECT DISTINCT Grad_Status
				FROM Graduation
				WHERE Student_ID=$studentID;";					//Student ID////////
				
				$result=$conn->query($sql);
				$result2=$conn->query($sql2);
				
				if($result->num_rows>0){
					while($row=$result->fetch_assoc()){
						echo "<tr><td>Name: ".$row["Student_Name"]."</td></tr>";
						echo "<br>";
						if($row["Student_Mode"]=="C"){
							$tempMode="Coursework";
						}else{
							$tempMode="Research";
						}
						echo "<tr><td>Mode: $tempMode</td></tr>";
						echo "<br>";
						echo "<tr><td>Course: ".$row["Student_Course"]."</td></tr>";
						echo "<br>";
						echo "<tr><td>Faculty: ".$row["Student_Faculty"]."</td></tr>";	
						echo "<br>";
						if($result2->num_rows>0){
							while($row2=$result2->fetch_assoc()){
								echo "<tr><td>Application Status: ".$row2["Grad_Status"]."</td></tr>";	
								echo "<br>";
							}
						}else{
							echo "<tr><td>Application Status: -</td></tr>";	
							echo "<br>";
						}
					}
				}
		  ?>
		  <form id="Gradtab" action="GradSubmit.php" method="post">
			<input type="submit" value="Submit">
		  </form>
        </div> <!-- hotel_reserve-box -->
      </div>



      <!-- Site footer -->
      <footer class="footer">
        <p>&copy; Easy A Company, Inc.</p>
      </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files 
          as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
