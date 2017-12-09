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

    <title>Student R Application Appointment Page</title>

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
            <li><a href="StudentRHomePage.php">Home</a></li>
            <li class="dropdown">
              <a id="dLabel" role="button" data-toggle="dropdown" class="btn btn-primary" data-target="#" href="#"">
                Application <span class="caret"></span>
              </a>
              <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                <li><a href="StudentRApplicationResourcePage.php">Resource Reservation</a></li>
                <li class="active"><a href="StudentRApplicationMonitoringPage.php">Appointment</a></li>
                <li><a href="StudentRApplicationGraduationPage.php">Graduation</a></li>
              </ul>
            </li>
            <li><a href="StudentREnrollmentPage.php">Enrollment</a></li>
            <li><a href="StudentRFinancialPage.php">Finance</a></li>
            <li><a href="StudentRProfilePage.php">Profile</a></li>
            <li><a href="index.html">Log Out</a></li>
          </ul>
        </nav>
      </div><!-- masthead -->
      <br><br>

      <div>
        <div class="hotel_reserve_box">
          <h3 style="text-align: center">Appointment</h3><br>
          <?php
				include "connect.php";
				session_start();

				$studentID = $_SESSION['stu_ID'];
				
				$sql="SELECT DISTINCT Pre_Status
				FROM Presentation
				WHERE Student_ID=$studentID;";			//Student ID/////////
				
				$result=$conn->query($sql);
				
				
		  ?>
          <form id="Pretab" action="PreSubmit.php" method="post" class="form-inline well">
		    Date: <input type="text" name="Date" placeholder="yyyy-mm-dd or yyyy/mm/dd"><br>
			<div class="form-group">
				Time: <input type="text" name="Time" placeholder="hh:mm"><br>
			</div>
			<div class="form-group">
				<select name="AMPM">
					<option value="AM">AM</option>
					<option value="PM">PM</option>
				</select>
			</div>
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
