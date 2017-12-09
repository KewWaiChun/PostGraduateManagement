<?php
  include "connect.php";
  
  session_start();
  $subject = $_POST['choosesub'];
  $_SESSION['sub'] = $subject;

  $subjectDetails="SELECT DISTINCT Subject_Name, Credit_Hour, Price, Term FROM subject WHERE Subject_ID = '$subject' AND Credit_Hour IS NOT NULL";
  $getSubject=$conn->query($subjectDetails);
  function displaySubList(){
    while($row = $GLOBALS['getSubject']->fetch_assoc()) {
      echo "<b>Subject Name : " . $row['Subject_Name'] . "</b><br>";
      echo "<b>Credit Hour &nbsp&nbsp&nbsp&nbsp: " . $row['Credit_Hour'] . "</b><br>";
      echo "<b>Price &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: " . $row['Price'] . "</b><br>";
      echo "<b>Term &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: " . $row['Term'] . "</b><br>";
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

    <title>Admin Subject Management Add Subject Page</title>

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

  <script language="javascript">
    function dis_able()
    {
      if(document.myform.sgc.value == 'tutorial')
      {
        document.myform.finalTime.disabled=1;
        document.getElementById('ft').value= " ";
        document.myform.finalDate.disabled=1;
        document.getElementById('fd').value= " ";
        document.myform.finalVenue.disabled=1;
        document.getElementById('fv').value= " ";
        document.myform.price.disabled=1;
        document.getElementById('p').value= " ";
        document.myform.credithour.disabled=1;
        document.getElementById('ch').value= " ";
      }else{
        document.myform.finalTime.disabled=0;
        document.myform.finalDate.disabled=0;
        document.myform.finalVenue.disabled=0;
        document.myform.price.disabled=0;
        document.myform.credithour.disabled=0;
      }
    }
  </script>

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
                <li class="active"><a href="AdminSMAddSubjectPage.php">Add Subject</a></li>
                <li><a href="AdminSMEditSubjectPage.php">Edit Subject</a></li>
                <li><a href="AdminSMRemoveSubjectPage.php">Remove Subject</a></li>
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
      <br>
      <div>
        <div class="managementBox">
          <form name="myform" action="removeSubject.php" method="get">
            <h3> Remove Subject </h3><br>
            <?php displaySubList() ?>
            <br><br>
            <div style="text-align:center">  
              <input type="submit" value="Remove" />
              <input formaction="AdminSMRemoveSubjectPage.php" type="submit" value="Back" />
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
