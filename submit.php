<?php
include "connect.php";

//declare variables
$username=$_POST['UserID'];
$password=$_POST['psw'];
$Status="";
$Email="";
$Finanace_Status="";

session_start();

$studentTierDB = "SELECT Tier FROM r_student WHERE Student_ID = '$username' ";
//$studentTotalCreditHourDB = "SELECT Total_Credit_Hour FROM csw_student WHERE Student_ID = '$username' ";
$getStudentTier = $conn->query($studentTierDB);
//$getStudentTotalCreditHour = $conn->query($studentTotalCreditHourDB);

function GetFinancialStatus($Term,$Student_ID,$conn)
	{
		//Get today's Month and Year
		$Month=idate("m");
		$Year=idate("Y");
		$Finance_Status =  NULL;
		//Here we determine which term is student is on based on their current year and month

		if ($Term==1)
		{
			//between 1 and 4 is term 1
			$disp = "SELECT Finance_Status FROM finance WHERE YEAR(Due_Date)=($Year) AND MONTH(Due_Date) BETWEEN 1 AND 4 AND Student_ID=($Student_ID)";
		}
		else if ($Term==2)
		{
			//between 5 and 8 is term 2
			$disp = "SELECT Finance_Status FROM finance WHERE YEAR(Due_Date)=($Year) AND MONTH(Due_Date) BETWEEN 5 AND 8 AND Student_ID=($Student_ID)";
		}
		else
		{
			//between 9 and 12 is term 3
			$disp = "SELECT Finance_Status FROM finance WHERE YEAR(Due_Date)=($Year) AND MONTH(Due_Date) BETWEEN 9 AND 12 AND Student_ID=($Student_ID)";
		}
		$result = $conn->query($disp);
		if ($result->num_rows > 0)
		{
		// output data of each row
			while($row = $result->fetch_assoc())
			{
				//here we get the financial status of the student
				$Finance_Status=$row["Finance_Status"];
			}
		}
		else
		{
			//echo "0 results";
		}
		return $Finance_Status;
	}
	
	function ChangeStatus($Finanace_Status,$conn,$Student_ID)
	{
		//Check finance_Status if cleared do nothing
		if ($Finanace_Status=="Uncleared")
		{
			$Status="Barred";
			//This query here will get the student email from database
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
					$to      = "$Email";
					$subject = 'Reminder';
					$message = 
					"Dear student,\nYour Finance Status are uncleared so you will be barred.\nRegards,\nFinance";
					$headers = 'From: mmuxamppserver@gmail.com' . "\r\n" .
						'Reply-To: mmuxamppserver@gmail.com' . "\r\n" .
						'X-Mailer: PHP/' . phpversion();

					mail($to, $subject, $message, $headers);
				}
			}
		}
		else
		{
			//if the student financial status is cleared then it will change the student status back to active
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

if($getStudentTier->num_rows > 0)
{
	while($studentTierDetail = $getStudentTier->fetch_assoc())
	{
	  $studentTier = $studentTierDetail['Tier'];
	}
}
else
{
	$studentTier = NULL;
}


if(is_numeric($username) && $password !=NULL){
	if($username < 1000000 ){

		$admin = "SELECT Admin_ID, Admin_Pass FROM administrator WHERE Admin_ID = '$username' AND Admin_Pass = '$password'";
		$result = $conn->query($admin);
		if ($result->num_rows > 0) {
			$_SESSION['adm_ID'] = $username;
    		// output data of each row
			echo "<script type='text/javascript'>
			window.location.href='AdminHomePage.php';
			</script>";
		} else {
			echo "<script type='text/javascript'>alert('Invalid User ID or Password!');
			window.location.href='index.html';
			</script>";
		}
	}
	elseif($username < 1000000000 ){
		$supervisor = "SELECT Supervisor_ID, Supervisor_Pass FROM supervisor WHERE Supervisor_ID = '$username' AND Supervisor_Pass = '$password'";
		$result = $conn->query($supervisor);
		if ($result->num_rows > 0) {
			$_SESSION['sup_ID'] = $username;

    		
			echo "<script type='text/javascript'>
			window.location.href='SupervisorHomePage.php';
			</script>";
		} else {
			echo "<script type='text/javascript'>alert('Invalid User ID or Password!');
			window.location.href='index.html';
			</script>";
		}
	}
	elseif($username < 10000000000 ){
		$student = "SELECT Student_ID, Student_Pass FROM student WHERE Student_ID = '$username' AND Student_Pass = '$password'";
		$result = $conn->query($student);
		if ($result->num_rows > 0) 
		{
			$_SESSION['stu_ID'] = $username;
			
			if ((idate("m")>0) && (idate("m")<=4))
			{
				$Finanace_Status=GetFinancialStatus(1,$username,$conn);
				if ($Finanace_Status=="Uncleared")
				{
					ChangeStatus($Finanace_Status,$conn,$username);
				}
			}
			else if ((idate("m")>4) && (idate("m")<=8))
			{
				$Finanace_Status=GetFinancialStatus(2,$username,$conn);
				if ($Finanace_Status=="Uncleared")
				{
					ChangeStatus($Finanace_Status,$conn,$username);
				}
			}
			else
			{
				$Finanace_Status=GetFinancialStatus(3,$username,$conn);
				if ($Finanace_Status=="Uncleared")
				{
					ChangeStatus($Finanace_Status,$conn,$username);
				}
			}
			if($studentTier != NULL)
			{
				echo "<script type='text/javascript'>
						window.location.href='StudentRHomePage.php';
					</script>";
			}
			else
			{
				echo "<script type='text/javascript'>
					window.location.href='StudentCSWHomePage.php';
					</script>";
			}

		}
		 else 
		 {
			echo "<script type='text/javascript'>alert('Invalid User ID or Password!');
			window.location.href='index.html';
			</script>";
		}
	}
}
else{
	echo "<script type='text/javascript'>alert('Invalid User ID or Password!');
	window.location.href='index.html';
	</script>";
}
	/****
//sql command




//code access to database
$result = $conn->query($admin);
$result2 = $conn->query($student);
$result3 = $conn->query($supervisor);

if ($result){
	echo "<script type='text/javascript'>
	window.location.href='htmlPage/StudentApplicationPage.html';
	</script>";
}elseif($result2){
	echo "<script type='text/javascript'>
	window.location.href='htmlPage/StudentHomePage.html';
	</script>";
}elseif($result3){
	echo "<script type='text/javascript'>
	window.location.href='htmlPage/SupervisorResultPage.html';
	</script>";
}else{
	echo "<script type='text/javascript'>alert('Invalid User ID or!');
	window.location.href='index.html';
	</script>";
}


//print data
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $temp[] = $row;
    }
} else {
    echo "0 results";
}
***/
?>