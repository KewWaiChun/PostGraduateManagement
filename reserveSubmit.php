<?php
$ReDate=$_POST['Date'];
$ReVenueID=$_POST['ReVenue'];
$RePurpose=$_POST['RePurpose'];
$testEmpty=false;
$testDate=false;
include "connect.php";
session_start();

$studentID = $_SESSION['stu_ID'];

if(empty($ReDate)||empty($RePurpose)||($RePurpose=="(In 255 words...)")){
	$testEmpty=true;
}else{
	try {
		$date = new DateTime($ReDate);
	} catch (Exception $e) {
		$testDate=true;
	}
}

if($testEmpty==false){
	if($testDate==false){
		$sql="INSERT INTO Reservation VALUES(DEFAULT,\"$ReDate\",\"$RePurpose\",\"Pending\",NULL,$studentID,$ReVenueID);";			//Student ID//////

		$result=$conn->query($sql);

		if($result){
			echo "<script type='text/javascript'>alert('Success');
				window.location.href='StudentCSWApplicationResourcePage.php';
				</script>";
					
			}else{
				echo "<script type='text/javascript'>alert('Failed');
				window.location.href='StudentCSWApplicationResourcePage.php';
				</script>";
		}
	}else{
		echo "<script type='text/javascript'>alert('Please enter valid date.');
		window.location.href='StudentCSWApplicationResourcePage.php';
		</script>";
	}
}else{
	echo "<script type='text/javascript'>alert('Please enter all information.');
	window.location.href='StudentCSWApplicationResourcePage.php';
	</script>";
}

?>