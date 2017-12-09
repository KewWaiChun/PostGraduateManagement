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

    <title>Admin Application Resource Approval Page</title>

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
            <li class="active"><a href="AdminHomePage.php">Home</a></li>
            <li class="dropdown">
              <a id="dLabel" role="button" data-toggle="dropdown" class="btn btn-primary" data-target="#" href="#"">
                Application <span class="caret"></span>
              </a>
              <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                <li><a href="AdminApplicationReservationPage.php">Resource Reservation</a></li>
                <li class="active"><a href="AdminApplicationResourceApprovalPage.php">Resourse Approval</a></li>
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
      <br><br>

      <div class="ridgeborder">
        <table class="table">
          <thead>
            <tr>
      				<th>Student ID</th>
      				<th>Date</th>
      				<th>Purpose</th>
      				<th>Venue</th>
            </tr>
          </thead>
          <tbody>
		    <div class="btn-group-vertical"></div>
            <?php
				include "connect.php";
				$sql="SELECT DISTINCT COUNT(Reserve_ID) AS PendingReq FROM Reservation WHERE Reserve_Status=\"Pending\" AND Admin_ID IS NULL;";
				$result=$conn->query($sql);
				if($result->num_rows>0){
					while($row=$result->fetch_assoc()){
						$tempPending=$row["PendingReq"];
						$sql2="SELECT DISTINCT Student_ID, Reserve_Date, Reserve_Reason, Venue_Detail,Reserve_ID 
						FROM Reservation,Venue WHERE Reservation.Venue_ID = Venue.Venue_ID AND Reserve_Status=\"Pending\" AND Admin_ID IS NULL;";
						$result2=$conn->query($sql2);
						for($x=0;$x<$tempPending;$x++){
							if($result2->num_rows>0){
								while($row=$result2->fetch_assoc()){
									$tempID=$row["Reserve_ID"];
									echo "<tr>";
									echo "<form method=\"post\" action=\"approveSubmit.php\">";
									echo "<td>".$row["Student_ID"]."</td><td>".$row["Reserve_Date"]."</td><td>".$row["Reserve_Reason"]."</td><td> ".$row["Venue_Detail"]."</td>";
									echo "<td><input type=\"submit\" name=\"action\" value=\"Approve\"/></td>";
									echo "<input type=\"hidden\" name=\"passID\" value=\"$tempID\"/>";
									echo "</form>";
									echo "<form method=\"post\" action=\"DisapproveSubmit.php\">";
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
			</div>
          </tbody>
        </table>
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
  </body>
</html>
