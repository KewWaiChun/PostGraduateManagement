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

    <title>Admin Application Graduation Approval Page</title>

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
                <li class="active"><a href="AdminApplicationGraduationApprovalPage.php">Graduation Approval</a></li>
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

      <div>
        <div id="floatleft" class="ridgeborder">
          <h3 >Coursework Students </h3>
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Total Credit Hour</th>
                <th>Finance Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
				include "connect.php";

        //Retrieve pending application from coursework students.
				$sql="SELECT DISTINCT COUNT(graduation.Student_ID) AS PendingReq FROM csw_student,graduation WHERE graduation.Student_ID=csw_student.Student_ID AND Grad_Status=\"Pending\";";
				$result=$conn->query($sql);
				if($result->num_rows>0){
					while($row=$result->fetch_assoc()){
						$tempPending=$row["PendingReq"];
						$sql2="SELECT DISTINCT Finance_Status, Total_Credit_Hour, csw_student.Student_ID, Grad_ID FROM csw_student, finance,graduation WHERE csw_student.Student_ID = finance.Student_ID aND graduation.Student_ID=csw_student.Student_ID AND Grad_Status=\"Pending\";";
						$result2=$conn->query($sql2);
						for($x=0;$x<$tempPending;$x++){
							if($result2->num_rows>0){
								while($row=$result2->fetch_assoc()){
									$tempID=$row["Grad_ID"];
									echo "<tr>";
                  //Aprove Button
									echo "<form method=\"post\" action=\"GradapproveSubmit.php\">";
									echo "<td>".$row["Student_ID"]."</td><td>".$row["Total_Credit_Hour"]."</td><td>".$row["Finance_Status"]."</td><td> ";
									echo "<td><input type=\"submit\" name=\"action\" value=\"Approve\"/></td>";
									echo "<input type=\"hidden\" name=\"passID\" value=\"$tempID\"/>";
									echo "</form>";
                  //Reject button
									echo "<form method=\"post\" action=\"GradDisapproveSubmit.php\">";
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
        <h3> Research Student </h3>
        <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Tier</th>
                <th>Finance Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
				include "connect.php";
				$sql="SELECT DISTINCT COUNT(graduation.Student_ID) AS PendingReq FROM r_student,graduation WHERE graduation.Student_ID=r_student.Student_ID AND Grad_Status=\"Pending\";";
				$result=$conn->query($sql);
				if($result->num_rows>0){
					while($row=$result->fetch_assoc()){
						$tempPending=$row["PendingReq"];
            //Retrieve pending application from coursework students.
						$sql2="SELECT DISTINCT Finance_Status, Tier, r_student.Student_ID, Grad_ID FROM r_student, finance,graduation WHERE r_student.Student_ID = finance.Student_ID AND graduation.Student_ID=r_student.Student_ID AND Grad_Status=\"Pending\";";
						$result2=$conn->query($sql2);
						for($x=0;$x<$tempPending;$x++){
							if($result2->num_rows>0){
								while($row=$result2->fetch_assoc()){
									$tempID=$row["Grad_ID"];
									echo "<tr>";
                  //Approve button 
									echo "<form method=\"post\" action=\"GradapproveSubmit.php\">";
									echo "<td>".$row["Student_ID"]."</td><td>".$row["Tier"]."</td><td>".$row["Finance_Status"]."</td><td> ";
									echo "<td><input type=\"submit\" name=\"action\" value=\"Approve\"/></td>";
									echo "<input type=\"hidden\" name=\"passID\" value=\"$tempID\"/>";
									echo "</form>";
                  //Reject button 
									echo "<form method=\"post\" action=\"GradDisapproveSubmit.php\">";
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
