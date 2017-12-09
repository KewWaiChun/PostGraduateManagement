<?php
  include "connect.php";

  $supID="SELECT Supervisor_ID FROM supervisor";
  $getSID=$conn->query($supID);
  function displaySupList(){
    if ($GLOBALS['getSID']->num_rows > 0) {
      while($row = $GLOBALS['getSID']->fetch_assoc()) {
        echo "<option value=" . $row["Supervisor_ID"] . ">" . $row["Supervisor_ID"] . "</option>";
      }
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
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" href="../../favicon.ico" />

    <title>Admin User Management Add Subject Page</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/justified-nav.css" rel="stylesheet" />
    <link href="css/custom.css" rel="stylesheet" />

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
              <a id="dLabel" role="button" data-toggle="dropdown" class="btn btn-primary" data-target="#" href="#">
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
                <li class="active"><a href="AdminAddStudentPage.php">Add Student</a></li>
                <li><a href="AdminAddSupervisorPage.php">Add Supervisor</a></li>
              </ul>
            </li>
            <li><a href="AdminProfilePage.php">Profile</a></li>
            <li><a href="index.html">Log out</a></li>
          </ul>
        </nav>
      </div><!-- masthead -->
      <br>
      <div>
        <div class="managementBox">
          <form name="myform" action="addStudent.php" method="get">
            <h3> Add Student </h3><br>
            <b>Student Name &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</b> <input type="text" name="studentName" placeholder="Student Name"/><br><br>
            <b>Student Password :</b> <input type="text" name="studentPass" placeholder="Student Password"/><br><br>
            <b>Student Mode &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</b>
            <select style="width:39%" name="studentMode">
              <option> </option>
              <option value="C">Coursework</option>
              <option value="R">Research</option>
            </select><br><br>
            <b>Student Course &nbsp&nbsp&nbsp&nbsp&nbsp:</b> <input type="text" name="studentCourse" placeholder="Master Of Computer Science(HONS)" /><br><br>
            <b>Student Faculty &nbsp&nbsp&nbsp&nbsp&nbsp: </b>
            <select style="width:39%" name="studentFaculty">
              <option> </option>
              <option value="FCI">FCI</option>
              <option value="FOE">FOE</option>
              <option value="FCM">FCM</option>
              <option value="FOM">FOM</option>
            </select><br><br>
            <b>Student Contact &nbsp&nbsp&nbsp&nbsp:</b> <input type="text" name="studentContact" placeholder="0123456789" /><br><br>
            <b>Student Email &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</b> <input type="text" name="studentEmail" placeholder="student@mail.com" /><br><br>
            <b>Supervisor &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</b> 
            <select name='supervisor'>
              <option> </option>
              <?php displaySupList(); ?>
            </select> <br><br>            
            <div style="text-align:center">  
              <input type="submit" value="Submit" />
            </div>
          </form>
        </div>
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
