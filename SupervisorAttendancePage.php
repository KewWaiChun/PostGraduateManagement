<?php
  include "connect.php";

  session_start();

  $supervisorID = $_SESSION['sup_ID'];
  $todayDate = date("Y-m-d");
  $chooseSub ="SELECT DISTINCT Subject_ID FROM subject_supervisor WHERE Supervisor_ID = '$supervisorID'";
  $GLOBALS['exc'] = $conn->query($chooseSub);

  function showSub(){
    while ($row = $GLOBALS['exc']->fetch_assoc()){
      $sub = $row['Subject_ID'];
      echo "<button class='btn btn-default' name='choosesub' id='choosesub' value=" . $sub . ">" . $sub . "</button>";
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

    <title>Supervisor Attendace Page</title>

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
            <li><a href="SupervisorHomePage.php">Home</a></li>
            <li><a href="SupervisorApplicationPage.php">Application</a></li>
            <li class="active"><a href="SupervisorAttendancePage.php">Attendance</a></li>
            <li><a href="SupervisorResultPage.php">Result</a></li>
            <li><a href="SupervisorTimeTablePage.php">TimeTable</a></li>
            <li><a href="SupervisorProfilePage.php">Profile</a></li>
            <li><a href="index.html">Log out</a></li>
          </ul>
        </nav>
      </div>

      <div>
      <br><br>
      </div>
      <br>
      <br>
      <div >
      <table>
        <form action="SupervisorGroupAttendance.php" method="post">
          <?php showSub() ?> 
        </form>
      <table>
      </div>
      <br><br>







      <!-- Site footer -->
      <footer class="footer">
        <p>&copy; Easy A Company, Inc.</p>
      </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
