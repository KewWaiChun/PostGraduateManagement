<?php
$PreDate=$_POST['Date'];
$Time=$_POST['Time'];
$Time2=$_POST['AMPM'];
$testDate=false;
$testEmpty=false;
include "connect.php";
session_start();

$studentID = $_SESSION['stu_ID'];

if(empty($PreDate)||empty($Time)){
	$testEmpty=true;
}else{
	if(preg_match("/(1[012]|0[0-9]):([0-5][0-9])/", $Time)){
		$testDate=false;
	}else{
		$testDate=true;
	}
	
	try {
    $date = new DateTime($PreDate);
	} catch (Exception $e) {
		$testDate=true;
	}
}

if($testEmpty==false){
	if($testDate==false){
		$PreTime=$Time . $Time2;
		$sql="SELECT r_student.Supervisor_ID FROM r_student WHERE Student_ID=$studentID";	//Student ID//////
		$result=$conn->query($sql);
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				$tempSuperID = $row["Supervisor_ID"];
			}
		}

		$sql2="INSERT INTO presentation VALUES(DEFAULT,\"Pending\",\"$PreDate\",\"$PreTime\",$studentID,$tempSuperID)";  //Student ID//////

		$result=$conn->query($sql2);
		if ($result){
			echo "<script type='text/javascript'>alert('Success');
			window.location.href='StudentRApplicationMonitoringPage.php';
			</script>";
				
		}else{
			echo "<script type='text/javascript'>alert('Failed');
			window.location.href='StudentRApplicationMonitoringPage.php';
			</script>";
		}
	}else{
		echo "<script type='text/javascript'>alert('Enter a valid date/time.');
		window.location.href='StudentRApplicationMonitoringPage.php';
		</script>";
	}
}else{
	echo "<script type='text/javascript'>alert('Please enter all information.');
	window.location.href='StudentRApplicationMonitoringPage.php';
	</script>";
}
?>