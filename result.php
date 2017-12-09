<?php
	include "connect.php";

	session_start();

	$month = date('m');
	if($month > 0 && $month <5){
		$term = 1;
	}elseif ($month > 4 && $month <9) {
		$term = 2;
	}else {
		$term = 3;
	}

	$subject = $_SESSION['sub'];
	$year = date("Y");
	$supervisorID = $_SESSION['sup_ID'];


	$stud = $_POST['student'];

	for($i = 0; $i < sizeof($stud); $i++){
		$resultID = "SELECT Result_ID FROM result WHERE Student_ID = '$stud[$i]'";
		$exec = $conn->query($resultID);

		while($row = $exec->fetch_assoc()){
			$resID[$i] = $row["Result_ID"];
			$_SESSION['resID'] = $resID;
		}
	}
	
	if(isset($_POST["mark"])){
		$mark = $_POST["mark"];
		for($i = 0; $i < sizeof($stud); $i++){
			if($mark[$i] >= 0){
				if($mark[$i] <= 100)
				{
					$abt = "UPDATE subject_result SET Marks = $mark[$i] WHERE Result_ID = $resID[$i] AND Subject_ID = '$subject' AND Supervisor_ID = $supervisorID";
					$exc = $conn->query($abt);

					header("Location: calGPA.php");
				} else {
					echo "<script type='text/javascript'>alert('Please enter valid Grade.');
					window.location.href='SupervisorResultPage.php';
					</script>";
				}
			} else {
				echo "<script type='text/javascript'>alert('Please enter valid Grade.');
				window.location.href='SupervisorResultPage.php';
				</script>";
			}
		}
		echo "<script type='text/javascript'>window.location.href='SupervisorResultPage.php'; </script>";
	} else {
		echo "<script type='text/javascript'>alert('Please enter valid Grade.');
		window.location.href='SupervisorResultPage.php';
		</script>";
	}
?>