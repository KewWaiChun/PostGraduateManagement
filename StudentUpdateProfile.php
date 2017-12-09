<?php
include "connect.php";
session_start();

$studentID = $_SESSION['stu_ID'];
//declare Variables
$contact = $_POST['contact'];
$email = $_POST['email'];
$message= "Error!! \\n";

$studentTotalCreditHourDB = "SELECT Total_Credit_Hour FROM csw_student WHERE Student_ID = '$studentID' ";
$studentTierDB = "SELECT Tier FROM r_student WHERE Student_ID = '$studentID' ";
$getStudentTotalCreditHour = $conn->query($studentTotalCreditHourDB);
$getStudentTier = $conn->query($studentTierDB);

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

while($studentTotalCreditHourDetail = $getStudentTotalCreditHour->fetch_assoc())
{
  $studentTotalCreditHour = $studentTotalCreditHourDetail['Total_Credit_Hour'];
}



function checkContact($contact,$message)
{
	if($contact != NULL)
	{
		if(is_numeric($contact) && strlen($contact)<=12)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	else
	{
		return true;
	}
}

function checkEmail($email,$message)
{
	if ($email != NULL)
	{
		if(strlen($email)<=25 && filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	else
	{
		return true;
	}
}

if(checkContact($contact,$message) == false)
{
	$message = $message . "Contact Error! \\n";
}

if(checkEmail($email,$message) == false)
{
	$message = $message . "Email Error!";
}

function alert($text){
    echo '<script type="text/javascript">alert("'.$text.'")</script>';
  }

$finalMessage = wordwrap($message, 40, "\n", false);



if(checkContact($contact,$message) && checkEmail($email,$message))
{
	if($contact != NULL)
	{
		$supervisorUpdateDBContact = "UPDATE student SET Student_Contact ='$contact' WHERE Student_ID = '$studentID'";
		$conn->query($supervisorUpdateDBContact);
	}
	if($email != NULL)
	{
		$supervisorUpdateDBEmail = "UPDATE student SET Student_Email ='$email' WHERE Student_ID = '$studentID'";
		$conn->query($supervisorUpdateDBEmail);
	}
	if($studentTier != NULL)
	{
		echo "<script type='text/javascript'>alert('Upadate Successful!');
			window.location.href='StudentRProfilePage.php';
		</script>";
	}
	else
	{
		echo "<script type='text/javascript'>alert('Upadate Successful!');
			window.location.href='StudentCSWProfilePage.php';
		</script>";
	}
}
else
	{
		if($studentTier != NULL)
		{
			alert($message);
			echo "<script type='text/javascript'>
					window.location.href='StudentREditProfilePage.php';
				</script>";
		}
		else
		{
			alert($message);
			echo "<script type='text/javascript'>
					window.location.href='StudentCSWEditProfilePage.php';
				</script>";
		}
		
	}











/*$supervisorUpdateAll = "UPDATE supervisor SET Supervisor_Contact = '$contact', Supervisor_Email = '$email' , Supervisor_Faculty = '$faculty' , Supervisor_Room = '$room' WHERE Supervisor_ID ='supervisorID' "
$supervisorUpdateCheck = $conn->query($supervisorUpdateAll);



*/


?>