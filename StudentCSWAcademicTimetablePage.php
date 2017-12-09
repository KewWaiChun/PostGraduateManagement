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

    <title>Student CSW Timetable Page</title>

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
                <li><a href="StudentCSWApplicationGraduationPage.php">Graduation</a></li>
              </ul>
            </li>
            <li><a href="StudentCSWEnrollmentPage.php">Enrollment</a></li>
            <li class="dropdown">
              <a id="dLabel" role="button" data-toggle="dropdown" class="btn btn-primary" data-target="#" href="#"">
                Academic <span class="caret"></span>
              </a>
              <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                <li class="active"><a href="StudentCSWAcademicTimetablePage.php">TimeTable</a></li>
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
      <br><br><br>
      <div class="ridgeborder" >
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
          <thead>
              <tr id="horizontalline">
                <th>Day</th>
                <th>Subject ID</th>
                <th>Subject Name</th>
                <th>Group</th>
                <th>Time</th>
                <th>Venue</th>
              </tr>
          </thead>
          <tbody>
		  <tr>
            <?php

				include "connect.php"; 
				session_start();
				$studentID = $_SESSION['stu_ID'];

				$monthnum = date('m');
				if($monthnum>=1 && $monthnum<=4){
					$Term = 1;
				}elseif ($monthnum>=5 && $monthnum<=8){
					$Term = 2;
				}else{
					$Term = 3;
				}

				$yearnum=date('Y');

				// GET ALL TIME TABLE RECORDS FROM DB // 
				$sql="SELECT DISTINCT subject.Subject_ID, subject.Subject_Group, Subject_Name, Time, Class_Day, Venue_Detail
				FROM Subject, Enrollment, student, Venue
				WHERE student.Student_ID = enrollment.Student_ID AND subject.Subject_ID=enrollment.Subject_ID AND 
				subject.Subject_Group=enrollment.Subject_Group AND Venue.Venue_ID = Subject.Class_Venue AND Term=$Term AND Enroll_Year=$yearnum AND student.Student_ID=$studentID;";
				//Student ID///////

				$result=$conn->query($sql);
				$data=array();
				while($row = mysqli_fetch_array($result)){
					$data[]=$row;
				}
				$days=array("Monday","Tuesday","Wednesday","Thursday","Friday");
				if($result->num_rows>0){
					for($x=0;$x<5;$x++){
						foreach($data as $row){ 
							if($row["Class_Day"]==$days[$x]){
								echo "<tr>";
								echo "<td>".$row["Class_Day"]."</td><td>".$row["Subject_ID"]."</td><td>".$row["Subject_Name"]."</td><td> ".$row["Subject_Group"]."</td><td>". $row["Time"]."</td><td>". $row["Venue_Detail"]."</td>";
								echo "</tr>";
							}
						}
					} 
				}
			?>
</table>
          </tbody>
        </table>
      </div><!--ridgeborder-->
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
