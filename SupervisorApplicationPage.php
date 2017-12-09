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

    <title>Supervisor Application Page</title>

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
            <li><a href="SupervisorHomePage.php">Home</a></li>
            <li class="active"><a href="SupervisorApplicationPage.php">Application</a></li>
            <li><a href="SupervisorAttendancePage.php">Attendance</a></li>
            <li><a href="SupervisorResultPage.php">Result</a></li>
            <li><a href="SupervisorTimetablePage.php">TimeTable</a></li>
            <li><a href="SupervisorProfilePage.php">Profile</a></li>
            <li><a href="index.html">Log out</a></li>
          </ul>
        </nav>
      </div> <!-- mast head -->
      <br><br>

      <div>
        <div id="floatleft" class="ridgeborder">
          <h3 >Pending </h3>
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Time</th>
                <th>Date</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
				include "connect.php";
				session_start();

				$supervisorID = $_SESSION['sup_ID'];
				$sql="SELECT DISTINCT COUNT(Pre_ID) AS PendingReq FROM Presentation WHERE Pre_Status=\"Pending\" AND Supervisor_ID=$supervisorID;";		//Supervisor ID/////
				$result=$conn->query($sql);
				if($result->num_rows>0){
					while($row=$result->fetch_assoc()){
						$tempPending=$row["PendingReq"];
						$sql2="SELECT DISTINCT Student_ID, Pre_Time, Pre_Date, Pre_ID 
						FROM Presentation WHERE Pre_Status=\"Pending\" AND Supervisor_ID=$supervisorID;";			//Supervisor ID//////
						$result2=$conn->query($sql2);
						for($x=0;$x<$tempPending;$x++){
							if($result2->num_rows>0){
								while($row=$result2->fetch_assoc()){
									$tempID=$row["Pre_ID"];
									echo "<tr>";
									echo "<form method=\"post\" action=\"PreapproveSubmit.php\">";
									echo "<td>".$row["Student_ID"]."</td><td>".$row["Pre_Time"]."</td><td>".$row["Pre_Date"]."</td><td> ";
									echo "<td><input type=\"submit\" name=\"action\" value=\"Approve\"/></td>";
									echo "<input type=\"hidden\" name=\"passID\" value=\"$tempID\"/>";
									echo "</form>";
									echo "<form method=\"post\" action=\"PreDisapproveSubmit.php\">";
									echo "<td><input type=\"submit\" name=\"action\" value=\"Reject\"/></td>";
									echo "<input type=\"hidden\" name=\"passID\" value=\"$tempID\"/>";
									echo "</form>";
									echo "</tr>";
								}
							}
						}
					}
				}else{}
			?>
            </tbody>
          </table>
        </div><!--floatleft -->
        <div id="floatright" class="ridgeborder">
        <h3> Approved </h3>
        <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Time</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              <?php
				include "connect.php";
				$sql="SELECT DISTINCT COUNT(Pre_ID) AS PendingReq FROM Presentation WHERE Pre_Status=\"Success\" AND Supervisor_ID=$supervisorID;";  //Supervisor ID////
				$result=$conn->query($sql);
				if($result->num_rows>0){
					while($row=$result->fetch_assoc()){
						$tempPending=$row["PendingReq"];
						$sql2="SELECT DISTINCT Student_ID, Pre_Time, Pre_Date
						FROM Presentation WHERE Pre_Status=\"Success\" AND Supervisor_ID=$supervisorID;";			//Supervisor ID////
						$result2=$conn->query($sql2);
						for($x=0;$x<$tempPending;$x++){
							if($result2->num_rows>0){
								while($row=$result2->fetch_assoc()){
									echo "<tr>";
									echo "<td>".$row["Student_ID"]."</td><td>".$row["Pre_Time"]."</td><td>".$row["Pre_Date"]."</td><td> ";
									echo "</tr>";
								}
							}
						}
					}
				}else{}
			?>
            </tbody>
          </table>



        </div><!--floatright-->

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
