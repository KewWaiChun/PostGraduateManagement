<?php
	include "connect.php";

	session_start();

	$supervisorID = $_SESSION['sup_ID'];
	$subject = $_POST['choosesub'];
	$year = date("Y");

	$list = "SELECT DISTINCT Student_ID, Marks FROM subject_result, result WHERE subject_result.Result_ID = result.Result_ID AND subject_result.Subject_ID = '$subject' AND subject_result.Current_Year = '$year' AND Supervisor_ID = '$supervisorID'";
	$GLOBALS['exc'] = $conn->query($list);

	function showList(){
		$var = 0;
	    while ($row = $GLOBALS['exc']->fetch_assoc()){
	      echo "<tr><td>" . $row["Student_ID"] . "</td><td>" . "<input name='student[]' id='student' type='hidden' value='" . $row["Student_ID"] . "'></td><td>" . "<input name='mark[]' id='mark' type='type' value='" . $row["Marks"] . "'></td></tr>";
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
            <li><a href="SupervisorAttendancePage.php">Attendance</a></li>
            <li class="active"><a href="SupervisorResultPage.php">Result</a></li>
            <li><a href="SupervisorTimeTablePage.php">TimeTable</a></li>
            <li><a href="SupervisorProfilePage.php">Profile</a></li>
            <li><a href="index.html">Log out</a></li>
          </ul>
        </nav>
      </div>

      <div>
      <br><br>
      </div>
      <div>
      	<table cellpadding='0' cellspacing='0' border='0' class='display' id='example' width='100%'>
  		<tr id="horizontalline">
            <th><?php echo $subject ?></th>
        </tr>
      </table>
      <br><br>
      </div>
      <div>
      	<form action="result.php" method="post">
      		<table cellpadding='0' cellspacing='0' border='0' class='display' id='example' width='100%'>
      		<tr id="horizontalline">
                <th>Student ID</th>
                <th></th>
                <th>Marks</th>
             </tr>
          	<?php showList() ?>
          	</table>
          	<br>
          	<input type="submit" class='btn btn-default' value="Submit" />
          	<input formaction="SupervisorResultPage.php" type="submit" class='btn btn-default' value="Back" />
      	</form>
      </div>
      	<br>
     	<br>
      	<div>
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