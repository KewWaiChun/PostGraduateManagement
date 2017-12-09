<?php
	include "connect.php";

	session_start();
	$subject = $_SESSION['sub'];

	$sub="DELETE FROM subject WHERE Subject_ID = '$subject'";
	if($conn->query($sub)){
		header("Location: AdminSMRemoveSubjectPage.php");
	}else{
		echo "<script type='text/javascript'>alert('Fail to remove Subject " . $subject . "');
		window.location.href='AdminSMRemoveSubjectPage.php';
		</script>";
	}


?>