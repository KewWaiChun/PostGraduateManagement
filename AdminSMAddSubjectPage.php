<?php
  include "connect.php";

  $venue="SELECT Venue_Detail FROM venue";
  $getV=$conn->query($venue);
  $getv=$conn->query($venue);
  function displayVenueList(){
    if ($GLOBALS['getV']->num_rows > 0) {
      while($row = $GLOBALS['getV']->fetch_assoc()) {
        echo "<option value=" . $row["Venue_Detail"] . ">" . $row["Venue_Detail"] . "</option>";
      }
    }
  }
  function displayVenueList2(){
    if ($GLOBALS['getv']->num_rows > 0) {
      while($row = $GLOBALS['getv']->fetch_assoc()) {
        echo "<option value=" . $row["Venue_Detail"] . ">" . $row["Venue_Detail"] . "</option>";
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
          <form name="myform" action="addSubject.php" method="post">
            <h3> Add Subject </h3><br>
            <b>Subject Name &nbsp:</b> <input type="text" name="subjectName" placeholder="Ex: Subject Name"/><br><br>
            <b>Subject ID &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</b> <input type="text" name="subjectID" placeholder="Ex: SNQ0001" /><br><br>
            <b>Subject Group Category:</b>
            <select style="width:39%" name="sgc" onChange="dis_able()">
              <option> </option>
              <option value="lecture">Lecture</option>
              <option value="tutorial">Tutorial</option>
            </select><br><br>
            <b>Subject Group :</b> <input type="text" name="subjectGroup" placeholder="Ex: 02" /><br><br>
            <b>Credit Hour &nbsp&nbsp&nbsp&nbsp&nbsp: </b><input enable type="text" id='ch' name="credithour" placeholder="0< credit hour <5" /><br><br>
            <b>Class Time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</b> <input type="text" name="subjectTime" placeholder="Ex: 9:00am" /><br><br>
            <b>Class Day &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</b> <input type="text" name="subjectDay" placeholder="Ex: Monday" /><br><br>
            <b>Class Venue&nbsp&nbsp&nbsp&nbsp&nbsp:</b>
            <select id='classVenue' name='classVenue'>
              <option> </option>
              <?php displayVenueList(); ?>
            </select> <br><br>
            <b>Final Time&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: </b><input enable type="text" id='ft' name="finalTime" placeholder="Ex: 4:30pm" /><br><br>
            <b>Final Date&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: </b><input enable type="text" id='fd' name="finalDate" placeholder="Ex: 2017-3-31" /><br><br>
            <b>Final Venue &nbsp&nbsp&nbsp&nbsp&nbsp: </b>
            <select id='fv' name='finalVenue'>
              <option> </option>
              <?php displayVenueList2(); ?>
            </select> <br><br>
            <b>Price &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: </b><input id='p' enable type="text" name="price" placeholder="Ex: 1200.30" /><br><br>
            <b>Term &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: </b><input type="text" name="term" placeholder="only 1/2/3" /><br><br>
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
