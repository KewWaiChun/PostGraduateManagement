<?php
	include "connect.php";

	session_start();
	$hasPaid = $_GET['Amount'];
	$CCNo = $_GET['CreditCardNumber'];
	$TotOut = $_SESSION['totalOutstanding'];
	$studentID = $_SESSION['stu_ID'];

	function alertC(){
		echo "<script type='text/javascript'>alert('You have enter invalid Credit Card Number.');
		window.location.href='StudentFinancialPage.php';
		</script>";
	}

	function alertA(){
		echo "<script type='text/javascript'>alert('You have enter invalid amount.');
		window.location.href='StudentFinancialPage.php';
		</script>";
	}

	if ($CCNo == NULL){
		alertC();
	} else if(!filter_var($CCNo, FILTER_VALIDATE_INT)){
		alertC();
	} else if($hasPaid == NULL){ 
		alertA();
	} else if(!filter_var($hasPaid, FILTER_VALIDATE_INT)){
		alertA();
	} else {
		if ($hasPaid > $TotOut){
			alertA();
		} else {
			$TotOut = $TotOut - $hasPaid;
		}
	}

	$upTotOut = "UPDATE finance SET Outstanding_Fees='$TotOut' WHERE Student_ID='$studentID'";
	$exc = $conn->query($upTotOut);
	
	header("Location: StudentFinancialPage.php");
?>