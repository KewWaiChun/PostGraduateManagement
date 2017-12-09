<?php
include "connect.php";
session_start();

$supervisorID = $_SESSION['sup_ID'];
$supervisorDetailDB = "SELECT Supervisor_ID,Supervisor_Name,Supervisor_Contact,Supervisor_Email,Supervisor_Faculty,Supervisor_Room FROM supervisor WHERE Supervisor_ID = '$supervisorID' ";
$getSupervisorProfile = $conn->query($supervisorDetailDB);
while( $supervisorAllDetail = $getSupervisorProfile->fetch_assoc())
{
  $supervisorName = $supervisorAllDetail['Supervisor_Name'];
  $supervisorContact = $supervisorAllDetail['Supervisor_Contact'];
  $supervisorEmail = $supervisorAllDetail['Supervisor_Email'];
  $supervisorFaculty = $supervisorAllDetail['Supervisor_Faculty'];
  $supervisorRoom = $supervisorAllDetail['Supervisor_Room'];
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

    <title>Supervisor Edit Profile Page</title>

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
        <nav><!-- navigation Bar-->
          <ul class="nav nav-justified">
            <li><a href="SupervisorHomePage.php">Home</a></li>
            <li><a href="SupervisorApplicationPage.php">Application</a></li>
            <li><a href="SupervisorAttendancePage.php">Attendance</a></li>
            <li><a href="SupervisorResultPage.php">Result</a></li>
            <li><a href="SupervisorTimetablePage.php">TimeTable</a></li>
            <li class="active"><a href="SupervisorProfilePage.php">Profile</a></li>
            <li><a href="index.html">Log out</a></li>
          </ul>
        </nav>
      </div> <!-- mast head -->

      <!--custom design for supervisor to edit profile page-->
      <div class="row">
      <br>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $supervisorName;?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="img/jiyeon.jpg" class="img-circle img-responsive"> </div>
                <div class=" col-md-9 col-lg-9 ">
                  <form action="SupervisorUpdateProfile.php" method="post">
                    <table class="table table-user-information">
                      <tbody>
                        <tr>
                          <td><b>Supervisor ID</b></td>
                          <td><?php echo $supervisorID;?></td>
                        </tr>
                        <tr>
                          <td><b>Faculty</b></td>
                          <td><?php echo $supervisorFaculty;?></td>
                        </tr>
                        <tr>
                          <td><b>Room</b></td>
                          <td><?php echo $supervisorRoom;?></td>
                        </tr>
                        <tr>
                          <td><b>Contact</b></td>
                          <td>
                              <input type="text" placeholder="0109724232" name="contact"br>
                          </td>
                        </tr>
                        <tr>
                          <td><b>Email</b></td>
                          <td>
                              <input type="text" placeholder="example@gmail.com" name="email"br>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <div style="text-align:center">
                      <input type="submit" value="Update">
                    </div>
                  </form>
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
