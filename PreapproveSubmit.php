<?php
	include "connect.php";

	if ($_POST['action'] && $_POST['passID']) {
	  $apprvID=$_POST["passID"];
	  $sql="Update Presentation Set Pre_Status=\"Success\" WHERE Pre_ID=$apprvID";
	  $result=$conn->query($sql);
	  if($result){
		  echo "<script type='text/javascript'>alert('Success');
			window.location.href='SupervisorApplicationPage.php';
			</script>";
			
			$sql="SELECT Student_ID FROM Presentation WHERE Pre_ID=$apprvID";
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
			"Dear student,\nYour Presentation ID :$apprvID has been approved.\nRegards,\nAdmin";
			$headers = 'From: mmuxamppserver@gmail.com' . "\r\n" .
				'Reply-To: mmuxamppserver@gmail.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
			mail($to, $subject, $message, $headers);
	  }else{
		  echo "<script type='text/javascript'>alert('Failed');
			window.location.href='SupervisorApplicationPage.php';
			</script>";
	  }
}

/*
$sql2="SELECT Student_ID, Pre_Date,Supervisor_Name FROM presentation, Supervisor WHERE Supervisor.Supervisor_ID = Presentation.Supervisor_ID AND Pre_ID=$apprvID;";
		  $result2=$conn->query($sql2);
		  if($result2->num_rows>0){
			  while($row=$result2->fetch_assoc()){
				  $tempDate=$row["Pre_Date"];
				  $tempSuper=$row["Supervisor_Name"];
				  $tempStudentID=$row["Student_ID"];
				  $Title="Approval of presentation by Student $tempStudentID";
				  $body="The application for presentation on $tempDate has been approved. Please contact your supervisor, $tempSuper, for more details.";
				  $sql3="INSERT INTO announcement VALUES(DEFAULT,\"$Title\",\"$body\",CURDATE(),10000);";		//Admin ID////
				  $result3=$conn->query($sql3);
				  if($result3){
					  echo "<script type='text/javascript'>alert('Success');
					window.location.href='SupervisorApplicationPage.php';
					</script>";
				  }else{
					  echo "<script type='text/javascript'>alert('Failed');
					window.location.href='SupervisorApplicationPage.php';
					</script>";
				  }
			  }
		  }
*/
?>