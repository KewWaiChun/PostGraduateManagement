<?php
include "connect.php";
session_start();

$message= "Error!! \\n";
$adminID = $_SESSION['adm_ID'];
$announcementTitle = $_POST['announcementTitleInput'];
$announcementDetail = $_POST['announcementDetailInput'];
$todayDate = date("Y-m-d");


function checkAnnouncementTitle($announcementTitle,$message)
{
	if(strlen($announcementTitle) <= 100 && $announcementTitle != NULL)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function checkAnnouncementDetail($announcementDetail,$message)
{
	if(strlen($announcementDetail) <= 255 && $announcementDetail != NULL)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function alert($text)
{
	echo '<script type="text/javascript">alert("'.$text.'")</script>';
}

if(checkAnnouncementTitle($announcementTitle,$message) == false)
{
	$message = $message . "Title Error! \\n";
}

if(checkAnnouncementDetail($announcementDetail,$message) == false)
{
	$message = $message . "Details Error! \\n";
}

if(checkAnnouncementTitle($announcementTitle,$message) && checkAnnouncementDetail($announcementDetail,$message))
{
	$addAnnouncement = "INSERT INTO announcement (Announce_ID, Announce_Title, Announce_Details, Announce_Date, Admin_ID) VALUES (DEFAULT, '$announcementTitle', '$announcementDetail', '$todayDate', '$adminID')";
	$conn->query($addAnnouncement);

	echo "<script type='text/javascript'>alert('Upadate Successful!');
			window.location.href='AdminApplicationAnnouncementPage.html';
		</script>";
}
else
	{
		alert($message);
		echo "<script type='text/javascript'>
				window.location.href='AdminApplicationAnnouncementPage.html';
			</script>";
	}




?>