<?php 
  include "connect.php";

  session_start();
  $stud_id = $_SESSION['stu_ID'];

  $month = date('m');
  if($month > 0 && $month <5){
    $term = 1;
  }elseif ($month > 4 && $month <9) {
    $term = 2;
  }else {
    $term = 3;
  }

  $year = date('Y');

  $enrol_subject = "SELECT DISTINCT enrollment.Subject_ID, subject.Subject_Group, subject.Subject_Name, subject.Class_Day, subject.Time, subject.Credit_Hour, subject.Price FROM subject, enrollment WHERE subject.Subject_ID = enrollment.Subject_ID AND subject.Subject_Group = enrollment.Subject_Group AND subject.Term = $term AND enrollment.Enroll_Year = $year AND enrollment.Student_ID = $stud_id";
  $getEnrollSubject = $conn->query($enrol_subject);

  function displayEnrollSubject(){
    if ($GLOBALS['getEnrollSubject']->num_rows > 0) {
      echo "<table cellpadding='0' cellspacing='0' border='0' class='display' id='example' width='100%'><tr><th>Subject ID</th><th>Subject Name</th><th>Subject Group</th><th>Day</th><th>Time</th><th>Credit Hour</th><th>Price</th></tr>";

      while($row = $GLOBALS['getEnrollSubject']->fetch_assoc()) {
            echo "<tr><td>" . $row["Subject_ID"] . "</td><td>" . $row["Subject_Name"] . "</td><td>" . $row["Subject_Group"] . "</td><td>" . $row["Class_Day"] . "</td><td>" . $row["Time"] . "</td><td>" . $row["Credit_Hour"] . "</td><td>" . $row["Price"] . "</td><td>" .
            "<button formaction='drop.php' class='btn btn-default' name='dropsubject' id='dropsubject' value=" . $row["Subject_ID"] . ">Drop</button>" .
            "</td><tr>";
        }

        echo "</table><br>";
    }
    else {
      echo "0 results<br><br>";
    }
  }

?>

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

    <title>Student CSW Enrollment Page</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/justified-nav.css" rel="stylesheet">

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
            <li class="active"><a href="StudentCSWEnrollmentPage.php">Enrollment</a></li>
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

      <div>
      <br><br>
          <div class="dropdown">
            <ul class="dropdown-menu">
              <li><a href="#">HTML</a></li>
              <li><a href="#">CSS</a></li>
              <li><a href="#">JavaScript</a></li>
            </ul>
          </div>
      </div>
      <br>
      <br>
      <div class="ridgeborder">
        <form action="StudentCSWEnrollmentPage.php">
          <?php displayEnrollSubject(); ?>
          <input type="submit" class='btn btn-default' value="Back">
        </form>
      </div>
      <br><br>



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
