<?php
	include "connect.php";
	
	$Status="";
	$Email="";
	$Finanace_Status="";
	$Student_ID=$username; <!-- $username -->
	
	function GetFinancialStatus($Term,$Student_ID,$conn)
	{
		//Get today's Month and Year
		$Month=idate("m");
		$Year=idate("Y");
		if ($Term==1)
		{
			$disp = "SELECT Finance_Status FROM finance WHERE YEAR(Due_Date)=($Year) AND MONTH(Due_Date) BETWEEN 1 AND 4 AND Student_ID=($Student_ID)";
		}
		else if ($Term==2)
		{
			$disp = "SELECT Finance_Status FROM finance WHERE YEAR(Due_Date)=($Year) AND MONTH(Due_Date) BETWEEN 5 AND 8 AND Student_ID=($Student_ID)";
		}
		else
		{
			$disp = "SELECT Finance_Status FROM finance WHERE YEAR(Due_Date)=($Year) AND MONTH(Due_Date) BETWEEN 9 AND 12 AND Student_ID=($Student_ID)";
		}
		$result = $conn->query($disp);
		if ($result->num_rows > 0)
		{
		// output data of each row
			while($row = $result->fetch_assoc())
			{
				//echo "Finance_Status: " . $row["Finance_Status"]. "<br>";
				$Finanace_Status=$row["Finance_Status"];
			}
		}
		else
		{
			//echo "0 results";
		}
		return $Finanace_Status;
	}
	
	function ChangeStatus($Finanace_Status,$conn,$Student_ID)
	{
		//Check finance_Status if cleared do nothing
		if ($Finanace_Status=="Uncleared")
		{
			$Status="Barred";
		}
		else
		{
			$Status="Active";
		}
		//update the status to database
		$sql = "UPDATE student SET Student_Status='$Status' WHERE Student_ID=($Student_ID)";
		if ($conn->query($sql) == TRUE)
		{
			//echo "Record updated successfully <br>";
		}
		else
		{
			//echo "Error Updating Record: " . $conn->error."<br>";
		}
	}
	
	function DisplayNotification($Status,$Student_ID,$conn)
	{
		$disp="SELECT Finance_Status FROM finance WHERE Student_ID=($Student_ID)";
		$result = $conn->query($disp);
		if ($result->num_rows > 0)
		{
		// output data of each row
			while($row = $result->fetch_assoc())
			{
				//uncomment this line to see Finanace_Status get from database
				//echo "Finance_Status: " . $row["Finance_Status"]. "\n <br>";
				$Status=$row["Finance_Status"];
			}
		}
		If ($Status=="Uncleared")
		{
			$disp="SELECT Student_Email FROM student WHERE Student_ID=($Student_ID)";
			$result = $conn->query($disp);
			if ($result->num_rows > 0)
			{
			// output data of each row
				while($row = $result->fetch_assoc())
				{
					//uncomment this line if you want to check student email get from database
					//echo "Student_Email: " . $row["Student_Email"]. "\n <br>";
					$Email=$row["Student_Email"];
				}
			}
			$to      = "$Email";
			$subject = 'Reminder';
			$message = 
			"Dear student,\nYour Finance Status are $Status so you will be barred.\nRegards,\nFinance";
			$headers = 'From: mmuxamppserver@gmail.com' . "\r\n" .
				'Reply-To: mmuxamppserver@gmail.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();

			if(mail($to, $subject, $message, $headers))
				echo "Message has been sent";
			else
			{
				echo "Message has not been sent";
			}
		}
	}
	
	if ((idate("m")>0) && (idate("m")<=4))
	{
		GetFinancialStatus(1,$username,$conn);
		ChangeStatus($Finanace_Status,$conn,$username);
	}
	else if ((idate("m")>4) && (idate("m")<=8))
	{
		GetFinancialStatus(2,$username,$conn);
		ChangeStatus($Finanace_Status,$conn,$username);
	}
	else
	{
		GetFinancialStatus(3,$username,$conn);
		ChangeStatus($Finanace_Status,$conn,$username);
	}
	DisplayNotification($Status,$username,$conn);
?>