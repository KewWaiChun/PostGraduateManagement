<?php

include "connect.php";
session_start();

$studentID = $_SESSION['stu_ID'];

$sql="SELECT DISTINCT Grad_Status
	FROM Graduation
	WHERE Student_ID=$studentID;";		//Student ID/////

$result=$conn->query($sql);

if($result->num_rows>0){
	while($row=$result->fetch_assoc()){
		if($row["Grad_Status"]=="Success"){
			echo "<script type='text/javascript'>alert('The application was approved');
			window.location.href='StudentCSWApplicationGraduationPage.php';
			</script>";
		}else{
			echo "<script type='text/javascript'>alert('Please wait for approval');
			window.location.href='StudentCSWApplicationGraduationPage.php';
			</script>";
		}
	}
}else{
	$sql2="INSERT INTO graduation VALUES(DEFAULT,CURDATE(),\"Pending\",$studentID)";

	$result=$conn->query($sql2);
	if ($result){
		echo "<script type='text/javascript'>alert('Success');
		window.location.href='StudentCSWApplicationGraduationPage.php';
		</script>";
			
	}else{
		echo "<script type='text/javascript'>alert('Failed');
		window.location.href='StudentCSWApplicationGraduationPage.php';
		</script>";
	}
}
?>