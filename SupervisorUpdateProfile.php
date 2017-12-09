<?php
include "connect.php";
session_start();

$supervisorID = $_SESSION['sup_ID'];
//declare Variables

$contact = $_POST['contact'];
$email = $_POST['email'];
$message= "Error!! \\n";


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
		$supervisorUpdateDBContact = "UPDATE supervisor SET Supervisor_Contact ='$contact' WHERE Supervisor_ID = '$supervisorID'";
		$conn->query($supervisorUpdateDBContact);
	}
	if($email != NULL)
	{
		$supervisorUpdateDBEmail = "UPDATE supervisor SET Supervisor_Email ='$email' WHERE Supervisor_ID = '$supervisorID'";
		$conn->query($supervisorUpdateDBEmail);
	}
	echo "<script type='text/javascript'>alert('Upadate Successful!');
			window.location.href='SupervisorProfilePage.php';
		</script>";
}
else
	{
		alert($message);
		echo "<script type='text/javascript'>
				window.location.href='SupervisorEditProfilePage.php';
			</script>";
	}











/*$supervisorUpdateAll = "UPDATE supervisor SET Supervisor_Contact = '$contact', Supervisor_Email = '$email' , Supervisor_Faculty = '$faculty' , Supervisor_Room = '$room' WHERE Supervisor_ID ='supervisorID' "
$supervisorUpdateCheck = $conn->query($supervisorUpdateAll);



*/


?>