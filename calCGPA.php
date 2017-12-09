<?php 
	include "connect.php";
	session_start();

	$resID = $_SESSION['resID'];
	$subID = array();

	for($i = 0; $i < sizeof($resID); $i++){
		$mark = "SELECT DISTINCT Marks FROM subject_result WHERE subject_result.Result_ID = $resID[$i]";
		$getMark = $conn->query($mark);

		while($row = $getMark->fetch_assoc()){
			$marks[] = $row["Marks"];
		}

		$sub = "SELECT Subject_ID FROM subject_result WHERE Result_ID = $resID[$i]";
		$getMark = $conn->query($sub);

		while($row = $getMark->fetch_assoc()){
			$subID[] = $row["Subject_ID"];
		}

		$tempCGpa = 0;

		if($marks[$i] >= 40){
			if($marks[$i] >= 40 && $marks[$i] < 50){
				$gpa = 1;
			} else if($marks[$i] >= 50 && $marks[$i] < 60) {
				$gpa = 2;
			} else if($marks[$i] >= 60 && $marks[$i] < 80) {
				$gpa = 3;
			} else {
				$gpa = 4;
			} 
		} else {
			$gpa = 0;
		}
		$tempCGpa = $tempCGpa + $gpa;

		$tempCH = 0;

		for($k = 0; $k < sizeof($subID); $k++){
			$credit = "SELECT Credit_Hour FROM subject WHERE Subject_ID = '$subID[$k]' AND Credit_Hour IS NOT NULL";
			$getCredit = $conn->query($credit);

			while($row = $getCredit->fetch_assoc()){
				$chour[$k] = $row["Credit_Hour"];
			}
			$tempCH = $tempCH + $chour[$k];
		}

		unset($subID);

		$totalCGpa = ($tempCGpa/$tempCH)*4;

		$setgpa = "UPDATE result SET CGPA = $totalCGpa WHERE Result_ID = $resID[$i]";
		$setGPA = $conn->query($setgpa);
	}

	echo "<script type='text/javascript'>window.location.href='SupervisorResultPage.php'; </script>";
?>