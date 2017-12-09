<?php
	include "connect.php";

	session_start();
	$dropsubject = $_GET['dropsubject'];
	$studentID = $_SESSION['stu_ID'];
	$year = date("Y");

	$subjectToDrop = "DELETE FROM enrollment WHERE Subject_ID = '$dropsubject' AND Student_ID = '$studentID'";
	if($conn->query($subjectToDrop) === TRUE ){

		$outstanding = "SELECT Outstanding_Fees FROM finance WHERE Student_ID = '$studentID'";
		$exec = $conn->query($outstanding);

		while($row1 = $exec->fetch_assoc()){
			$fees = $row1['Outstanding_Fees'];
		}

		$subPrice = "SELECT Price FROM subject WHERE Subject_ID = '$dropsubject' AND Price IS NOT NULL";
		$exc = $conn->query($subPrice);
		while($row = $exc->fetch_assoc()){
		  $tempPrice = $row['Price'];
		}

		$newOutstanding = $fees - $tempPrice;

		if($newOutstanding==0){
			$updateStatus = "UPDATE finance SET Finance_Status = 'Cleared' WHERE Student_ID = $studentID";
			if($conn->query($updateStatus)){}
		}

		$updateOutstanding = "UPDATE finance SET Outstanding_Fees = $newOutstanding WHERE Student_ID = $studentID";
		if($conn->query($updateOutstanding)){}

		$curCreditHour = "SELECT CurrentCredit_Hour FROM result WHERE Student_ID = '$studentID'";
		$exe = $conn->query($curCreditHour);
		while($row = $exe->fetch_assoc()){
			  $tempCCH = $row['CurrentCredit_Hour'];
		}

		$creditHour = "SELECT Credit_Hour FROM subject WHERE Subject_ID = '$dropsubject' AND Credit_Hour IS NOT NULL";
		$execute = $conn->query($creditHour);
		while($row = $execute->fetch_assoc()){
			  $tempCH = $row['Credit_Hour'];
		}

		$totalCH = $tempCCH - $tempCH;

		$updateCH = "UPDATE result SET CurrentCredit_Hour = $totalCH WHERE Student_ID = $studentID";
		if($conn->query($updateCH)){}

		$resultID = "SELECT Result_ID FROM result WHERE Student_ID = '$studentID'";
		$getResultID = $conn->query($resultID);
		while($row = $getResultID->fetch_assoc()){
			$resID = $row['Result_ID'];
		}

		$delRow = "DELETE FROM subject_result WHERE Result_ID = $resID AND Current_Year = $year AND Subject_ID = '$dropsubject'";
		if($conn->query($delRow)){}
		
		echo "<script type='text/javascript'>alert('Sucessfully drop subject.');
		window.location.href='StudentCSWCartPage.php';
		</script>";
	} else {
		echo "<script type='text/javascript'>alert('Fail to drop Subject');
		window.location.href='StudentCSWChooseGroupPage.php';
		</script>";
	}
?>