<?php
	include "connect.php";

	session_start();

	$subject = $_SESSION['sub'];
	$group = $_SESSION['grp'];
	$todayDate = date("Y-m-d");
	$supervisorID = $_SESSION['sup_ID'];

	if(isset($_POST["pstudent"])){
		$present = $_POST["pstudent"];
	} else {
		$present = NULL;
	}

	if(isset($_POST["astudent"])){
		$absent = $_POST["astudent"];
	} else {
		$absent = NULL;
	}

	if (sizeof($present) > 0){
		for($i = 0; $i < sizeof($present); $i++){
			$prt = "INSERT INTO attendance VALUES ($present[$i], '$subject', '$todayDate', '$group', 'T', '$supervisorID')";
			$exc = $conn->query($prt);
		}
	}

	if (sizeof($absent) > 0){
		for($i = 0; $i < sizeof($present); $i++){
			$abt = "INSERT INTO attendance VALUES ($absent[$i], '$subject', $todayDate, '$group', 'F', '$supervisorID')";
			$exc = $conn->query($abt);
		}
	}

	echo "<script type='text/javascript'>window.location.href='SupervisorAttendancePage.php'; </script>";
?>