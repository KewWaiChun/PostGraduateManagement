<?php
include "connect.php";
session_start();

$adminID = $_SESSION['adm_ID'];
$adminDetailDB = "SELECT Admin_ID, Admin_Name, Admin_Department, Admin_Email, Admin_Contact FROM administrator WHERE Admin_ID = '$adminID'";
$getAdminProfile = $conn->query($adminDetailDB);
while( $adminAllDetail = $getAdminProfile->fetch_assoc())
{
  $adminName = $adminAllDetail['Admin_Name'];
  $adminContact = $adminAllDetail['Admin_Contact'];
  $adminDepartment = $adminAllDetail['Admin_Department'];
  $adminEmail = $adminAllDetail['Admin_Email'];
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

    <title>Admin Profile Page</title>

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
            <li><a href="AdminHomePage.php">Home</a></li>
            <li class="dropdown">
              <a id="dLabel" role="button" data-toggle="dropdown" class="btn btn-primary" data-target="#" href="#"">
                Application <span class="caret"></span>
              </a>
              <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                <li><a href="AdminApplicationReservationPage.php">Resource Reservation</a></li>
                <li><a href="AdminApplicationResourceApprovalPage.php">Resourse Approval</a></li>
                <li><a href="AdminApplicationGraduationApprovalPage.php">Graduation Approval</a></li>
                <li><a href="AdminApplicationAnnouncementPage.html">Announcement</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a id="dLabel" role="button" data-toggle="dropdown" class="btn btn-primary" data-target="#" href="#">
                Subject Management <span class="caret"></span>
              </a>
              <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                <li><a href="AdminSMAddSubjectPage.php">Add Subject</a></li>
                <li><a href="AdminSMEditSubjectPage.php">Edit Subject</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a id="dLabel" role="button" data-toggle="dropdown" class="btn btn-primary" data-target="#" href="#">
                User Management <span class="caret"></span>
              </a>
              <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                <li><a href="AdminAddStudentPage.php">Add Student</a></li>
                <li><a href="AdminAddSupervisorPage.php">Add Supervisor</a></li>
              </ul>
            </li>
            <li><a href="AdminProfilePage.php">Profile</a></li>
            <li><a href="index.html">Log out</a></li>
          </ul>
        </nav>
      </div><!-- masthead -->

      <div class="row">
      <br>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $adminName; ?></h3>
            </div> 
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="img/jiyeon.jpg" class="img-circle img-responsive"> </div>
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td><b>Admin ID</b></td>
                        <td><?php echo $adminID;?></td>
                      </tr>
                      <tr>
                        <td><b>Department</b></td>
                        <td> <?php echo $adminDepartment;?></td>
                      </tr>
                      <tr>
                        <td><b>Contact</b></td>
                        <td><?php echo $adminContact;?></td>
                      </tr>
                      <tr>
                        <td><b>Email</b></td>
                        <td><?php echo $adminEmail;?></td>
                      </tr>
                    </tbody>
                  </table>
                  <a href="AdminEditProfilePage.php" class="btn btn-primary">Edit Profile</a>
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
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files 
          as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
