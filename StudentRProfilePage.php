<?php
include "connect.php";
session_start();

$studentID = $_SESSION['stu_ID'];
$studentDetailDB = "SELECT Student_ID, Student_Name, Student_Mode, Student_Status, Student_Course, Student_Faculty, Student_Contact, Student_Email FROM student WHERE Student_ID = '$studentID' ";
$studentTierDB = "SELECT Tier FROM r_student WHERE Student_ID = '$studentID' ";
$getStudentProfile = $conn->query($studentDetailDB);
$getStudentTier = $conn->query($studentTierDB);
while( $studentAllDetail = $getStudentProfile->fetch_assoc())
{
  $studentName = $studentAllDetail['Student_Name'];
  $studentCourse = $studentAllDetail['Student_Course'];
  $studentFaculty = $studentAllDetail['Student_Faculty'];
  $studentStatus = $studentAllDetail['Student_Status'];
  $studentMode = $studentAllDetail['Student_Mode'];
  $studentContact = $studentAllDetail['Student_Contact'];
  $studentEmail = $studentAllDetail['Student_Email'];
}

while($studentTierDetail = $getStudentTier->fetch_assoc())
{
  $studentTier = $studentTierDetail['Tier'];
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

    <title>Student R Profile Page</title>

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
            <li><a href="StudentRHomePage.php">Home</a></li>
            <li class="dropdown">
              <a id="dLabel" role="button" data-toggle="dropdown" class="btn btn-primary" data-target="#" href="#"">
                Application <span class="caret"></span>
              </a>
              <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                <li><a href="StudentRApplicationResourcePage.php">Resource Reservation</a></li>
                <li><a href="StudentRApplicationMonitoringPage.php">Appointment</a></li>
                <li><a href="StudentRApplicationGraduationPage.php">Graduation</a></li>
              </ul>
            </li>
            <li><a href="StudentREnrollmentPage.php">Enrollment</a></li>
            <li><a href="StudentRFinancialPage.php">Finance</a></li>
            <li class="active"><a href="StudentRProfilePage.php">Profile</a></li>
            <li><a href="index.html">Log Out</a></li>
          </ul>
        </nav>
      </div><!-- masthead -->
      <div class="row">
      <br>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $studentName;?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="img/jiyeon.jpg" class="img-circle img-responsive"> </div>
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td><b>Student ID</b></td>
                        <td><?php echo $studentID;?></td>
                      </tr>
                      <tr>
                        <td><b>Course</b></td>
                        <td><?php echo $studentCourse;?></td>
                      </tr>
                      <tr>
                        <td><b>Faculty</b></td>
                        <td><?php echo $studentFaculty;?></td>
                      </tr>
                      <tr>
                        <td><b>Status</b></td>
                        <td><?php echo $studentStatus;?></td>
                      </tr>
                      <tr>
                        <td><b>Mode</b></td>
                        <td><?php echo $studentMode;?></td>
                      </tr>
                      <tr>
                        <td><b>Tier</b></td>
                        <td><?php echo $studentTier;?></td>
                      </tr>
                      <tr>
                        <td><b>Contact</b></td>
                        <td><?php echo $studentContact;?></td>
                      </tr>
                      <tr>
                        <td><b>Email</b></td>
                        <td><?php echo $studentEmail;?></td>
                      </tr>
                    </tbody>
                  </table>
                  <a href="StudentREditProfilePage.php" class="btn btn-primary">Edit Profile</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Site footer -->
      <footer class="footer" style="clear: both">
        <p>&copy; Easy A Company, Inc.</p>
      </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
