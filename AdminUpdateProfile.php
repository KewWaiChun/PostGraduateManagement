<?php
include "connect.php";
session_start();

$adminID = $_SESSION['adm_ID'];
//declare Variables
$department = $_POST['department'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$message= "Error!! \\n";

function checkDepartment($department,$message)
{
	if(strlen($department) <= 25)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function checkContact($contact,$message)
{
	if($contact != NULL)
	{
		if(is_numeric($contact) && strlen($contact)<=11)
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


if(checkDepartment($department,$message) == false)
{
	$message = $message . "Department's Error! \\n";
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



if(checkDepartment($department,$message) && checkContact($contact,$message) && checkEmail($email,$message))
{
	if($department != NULL)
	{
		$adminUpdateDBDepartment= "UPDATE administrator SET Admin_Department ='$department' WHERE Admin_ID = '$adminID'";
		$conn->query($adminUpdateDBDepartment);
	}
	if($contact != NULL)
	{
		$adminUpdateDBContact = "UPDATE administrator SET Admin_Contact ='$contact' WHERE Admin_ID = '$adminID'";
		$conn->query($adminUpdateDBContact);
	}
	if($email != NULL)
	{
		$adminUpdateDBEmail = "UPDATE administrator SET Admin_Email ='$email' WHERE Admin_ID = '$adminID'";
		$conn->query($adminUpdateDBEmail);
	}
	echo "<script type='text/javascript'>alert('Upadate Successful!');
			window.location.href='AdminProfilePage.php';
		</script>";
}
else
	{
		alert($message);
		echo "<script type='text/javascript'>
				window.location.href='AdminEditProfilePage.html';
			</script>";
	}











/*$supervisorUpdateAll = "UPDATE supervisor SET Supervisor_Contact = '$contact', Supervisor_Email = '$email' , Supervisor_Faculty = '$faculty' , Supervisor_Room = '$room' WHERE Supervisor_ID ='supervisorID' "
$supervisorUpdateCheck = $conn->query($supervisorUpdateAll);



*/


?>