<?php
	include "connect.php";
	
	session_start();

	$adminID = $_SESSION['adm_ID'];
	if ($_POST['action'] && $_POST['passID']) {
	  $apprvID=$_POST["passID"];
	  $sql="Update Reservation Set Reserve_Status=\"Rejected\" WHERE Reserve_ID=$apprvID";
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
			"Dear student,\nYour reservation ID :$apprvID has been disapproved.\nRegards,\nAdmin";
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