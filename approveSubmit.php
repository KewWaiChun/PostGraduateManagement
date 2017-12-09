<?php
	include "connect.php";
	
	session_start();

	$adminID = $_SESSION['adm_ID'];
	if ($_POST['action'] && $_POST['passID']) {
	  $apprvID=$_POST["passID"];
	  $sql="Update Reservation Set Reserve_Status=\"Success\" WHERE Reserve_ID=$apprvID";
	  $result=$conn->query($sql);
	  if($result){
		  echo "<script type='text/javascript'>alert('Success');
			window.location.href='AdminApplicationResourceApprovalPage.php';
			</script>";
			
			$sql="SELECT Student_ID FROM reservation WHERE Reserve_ID=$apprvID";
			$result=$conn->query($sql);
			if ($result->num_rows > 0)
			{
				while($row = $result->fetch_assoc()){
					$Student_ID=$row["Student_ID"];
				}
			}
			
			$sql="SELECT Student_Email FROM Student WHERE Student_ID=$Student_ID";
			$result=$conn->query($sql);
			if ($result->num_rows > 0)
			{
				while($row = $result->fetch_assoc()){
					$Email=$row["Student_Email"];
				}
			}
			
			$to      = "$Email";
			$subject = 'Reminder';
			$message = 
			"Dear student,\nYour reservation ID :$apprvID has been approved.\nRegards,\nAdmin";
			$headers = 'From: mmuxamppserver@gmail.com' . "\r\n" .
				'Reply-To: mmuxamppserver@gmail.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
			mail($to, $subject, $message, $headers);
			
	  }else{
		  echo "<script type='text/javascript'>alert('Failed');
			window.location.href='AdminApplicationResourceApprovalPage.php';
			</script>";
	  }
	  
}

/*
$sql2="SELECT Student_ID, Venue_Detail, Reserve_Date FROM reservation, venue WHERE Reservation.Venue_ID = Venue.Venue_ID AND Reserve_ID=$apprvID;";
		  $result2=$conn->query($sql2);
		  if($result2->num_rows>0){
			  while($row=$result2->fetch_assoc()){
				  $tempVen=$row["Venue_Detail"];
				  $tempDate=$row["Reserve_Date"];
				  $tempStudentID=$row["Student_ID"];
				  $Title="Approval of reservation for resources by Student $tempStudentID";
				  $body="The reservation for $tempVen on $tempDate has been approved. Please take good care of the facilities. Thank You.";
				  $sql3="INSERT INTO announcement VALUES(DEFAULT,\"$Title\",\"$body\",CURDATE(),$adminID);";		//Admin ID////
				  $result3=$conn->query($sql3);
				  if($result3){
					  echo "<script type='text/javascript'>alert('Success');
					window.location.href='AdminApplicationResourceApprovalPage.php';
					</script>";
				  }else{
					  echo "<script type='text/javascript'>alert('Failed');
					window.location.href='AdminApplicationResourceApprovalPage.php';
					</script>";
				  }
			  }
		  }
*/
?>

