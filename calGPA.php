<?php 
	include "connect.php";
	session_start();

	$resID = $_SESSION['resID'];
	$subID = array();

	$year = date('Y');
	$month = date('m');
	if($month > 0 && $month <5){
		$term = 1;
	}elseif ($month > 4 && $month <9) {
		$term = 2;
	}else {
		$term = 3;
	}

	for($i = 0; $i < sizeof($resID); $i++){
		$mark = "SELECT DISTINCT Marks FROM subject_result, subject WHERE subject_result.Result_ID = $resID[$i] AND subject_result.Current_Year = $year AND subject_result.Subject_ID = subject.Subject_ID AND subject.Term = $term";
		$getMark = $conn->query($mark);

		while($row = $getMark->fetch_assoc()){
			$marks[] = $row["Marks"];
		}

		$sub = "SELECT DISTINCT subject_result.Subject_ID FROM subject_result, subject WHERE subject_result.Result_ID = $resID[$i] AND subject_result.Current_Year = $year AND subject_result.Subject_ID = subject.Subject_ID AND subject.Term = $term";
		$getMark = $conn->query($sub);

		while($row = $getMark->fetch_assoc()){
			$subID[] = $row["Subject_ID"];
		}

		$tempGpa = 0;

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
		$tempGpa = $tempGpa + $gpa;

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

		$totalGpa = ($tempGpa/$tempCH)*4;

		$setgpa = "UPDATE result SET GPA = $totalGpa WHERE Result_ID = $resID[$i]";
		$setGPA = $conn->query($setgpa);
	}
	header("Location: calCGPA.php");
?>