<?php
include "connect.php";
session_start();

//declare variable
$adminID = $_SESSION['adm_ID'];
$group = $_SESSION['grp'];
$subject = $_SESSION['sub'];
$sgc = $_POST['sgc'];

if($sgc == 'tutorial'){
	$creditHour=0;
	$finalTime="";
	$finalDate="";
	$finalVenue="";
	$price=0;
}else{
	$creditHour = $_POST['credithour'];
	$finalTime = $_POST['finalTime'];
	$finalDate = $_POST['finalDate'];
	$finalVenue = $_POST['fvenue'];
	$price = $_POST['price'];
}
$subjectName = $_POST['subjectName'];
$subjectID = $_POST['subjectID'];
$subjectGroup = $_POST['subjectGroup'];
$subjectDay =$_POST['subjectDay'];
$subjectTime = $_POST['subjectTime'];
$classVenue = $_POST['classVenue'];
$term = $_POST['term'];
$message= "Error!! \\n";

function checkTerm($term,$message)
{
	if($term!=NULL)
	{
		if(strlen($term) <= 11 && is_numeric($term))
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

function checkPrice($price,$message,$sgc) 
{
	if($sgc == "tutorial")
	{
		return true;
	}
	else
	{
		if($price != NULL)
		{
			if(is_float($price) || is_numeric($price))
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
}

function checkFinalVenue($finalVenue,$message,$sgc)
{
	if($sgc == "tutorial")
	{
		return true;
	}
	else
	{
		if($finalVenue!=NULL)
		{
			if(strlen($finalVenue) <= 11)
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
}

function checkSGC($sgc ,$message)
{
	if($sgc==NULL)
	{
		return false;
	}
	else
	{
		return true;
	}
}

function checkFinalDate($finalDate,$message,$sgc)
{
	if($sgc == "tutorial")
	{
		return true;
	}
	else
	{
		if($finalDate==NULL)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}

function checkSubjectName($subjectName,$message)
{
	if($subjectName!=NULL)
	{
		if(strlen($subjectName) <= 50)
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

function checkSubjectID($subjectID,$message)
{
	if($subjectID != NULL)
	{
		if(strlen($subjectID)<=7)
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

function checkSubjectGroup($subjectGroup,$message)
{
	if($subjectGroup !=NULL)
	{
		if(strlen($subjectGroup)<=5)
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

function checkCreditHour($creditHour,$message,$sgc)
{
	if($sgc == "tutorial")
	{
		return true;
	}
	else
	{
		if($creditHour !=NULL)
		{
			if(is_numeric($creditHour))
			{
				if($creditHour<5 || $creditHour>0){
					return true;
				}else{
					return false;
				}
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
}

function checkSubjectDay($subjectDay,$message)
{
	if($subjectDay !=NULL)
	{
		if(strlen($subjectDay)<=10)
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

function checkSubjectTime($subjectTime,$message) 
{
	if($subjectTime !=NULL)
	{
		if(strlen($subjectTime)<=10)
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

function checkFinalTime($finalTime,$message,$sgc) 
{
	if($sgc == "tutorial")
	{
		return true;
	}
	else
	{
		if($finalTime ==NULL)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}

if(checkTerm($term,$message) == false)
{
	$message = $message . "Term Error! \\n";
}
if(checkPrice($price,$message,$sgc) == false)
{
	$message = $message . "Price Error! \\n";
}
if(checkFinalVenue($finalVenue,$message,$sgc) == false)
{
	$message = $message . "Final Venue Error! \\n";
}
if(checkSGC($sgc ,$message) == false)
{
	$message = $message . "Subject Group Catagory Error! \\n";
}
if(checkFinalDate($finalDate,$message,$sgc) == false)
{
	$message = $message . "Final Date Error! \\n";
}
if(checkSubjectName($subjectName,$message) == false)
{
	$message = $message . "Subject Name Error! \\n";
}
if(checkSubjectID($subjectID,$message) == false)
{
	$message = $message . "Subject ID Error! \\n";
}
if(checkSubjectGroup($subjectGroup,$message) == false)
{
	$message = $message . "Subject Group Error! \\n";
}
if(checkCreditHour($creditHour,$message,$sgc) == false)
{
	$message = $message . "Credit Hour Error! \\n";
}
if(checkSubjectDay($subjectDay,$message) == false)
{
	$message = $message . "Class Day Error! \\n";
}
if(checkSubjectTime($subjectTime,$message) == false)
{
	$message = $message . "Class Time Error! \\n";
}
if(checkFinalTime($finalTime,$message,$sgc) == false)
{
	$message = $message . "Final Time Error! \\n";
}

function alert($text){
    echo '<script type="text/javascript">alert("'.$text.'")</script>';
}

if(checkTerm($term,$message)&& checkPrice($price,$message,$sgc)&& checkFinalVenue($finalVenue,$message,$sgc)&& checkSGC($sgc ,$message)&& checkFinalDate($finalDate,$message,$sgc)&& checkSubjectName($subjectName,$message)&& checkSubjectID($subjectID,$message)&& checkSubjectGroup($subjectGroup,$message) && checkCreditHour($creditHour,$message,$sgc)&& checkSubjectDay($subjectDay,$message)&& checkSubjectTime($subjectTime,$message)&& checkFinalTime($finalTime,$message,$sgc))
{
	if($subjectName != NULL)
	{
		$subjectNameUpdateDB = "UPDATE subject SET Subject_Name = '$subjectName' WHERE Subject_ID = '$subject' AND Subject_Group='$group'";
		$conn->query($subjectNameUpdateDB);
	}

	if($subjectID !=NULL)
	{
		$subjectIDUpdateDB = "UPDATE subject SET Subject_ID = '$subjectID' WHERE Subject_ID = '$subject' AND Subject_Group='$group'";
		$conn->query($subjectIDUpdateDB);
	}

	if($subjectGroup !=NULL)
	{
		$subjectGroupUpdateDB = "UPDATE subject SET Subject_Group = '$subjectGroup' WHERE Subject_ID = '$subject' AND Subject_Group='$group'";
		$conn->query($subjectGroupUpdateDB);
	}

	if($creditHour !=NULL)
	{
		$subjectCreditHourUpdateDB = "UPDATE subject SET Credit_Hour = $creditHour WHERE Subject_ID = '$subject' AND Subject_Group='$group'";
		$conn->query($subjectCreditHourUpdateDB);
	}

	if($subjectDay !=NULL)
	{
		$subjectSubjectDayUpdateDB = "UPDATE subject SET Class_Day = '$subjectDay' WHERE Subject_ID = '$subject' AND Subject_Group='$group'";
		$conn->query($subjectSubjectDayUpdateDB);
	}

	if($subjectTime !=NULL)
	{
		$subjectTimeUpdateDB = "UPDATE subject SET Time = '$subjectTime' WHERE Subject_ID = '$subject' AND Subject_Group='$group'";
		$conn->query($subjectTimeUpdateDB);
	}

	if($finalTime !=NULL)
	{
		$subjectFinalExamUpdateDB = "UPDATE subject SET FinalExa_Time = '$finalTime' WHERE Subject_ID = '$subject' AND Subject_Group='$group'";
		$conn->query($subjectFinalExamUpdateDB);
	}

	if($finalDate !=NULL)
	{
		$subjectFinalDateUpdateDB = "UPDATE subject SET FinalExa_Date = '$finalDate' WHERE Subject_ID = '$subject' AND Subject_Group='$group'";
		$conn->query($subjectFinalDateUpdateDB);
	}

	if($classVenue !=NULL)
	{
		$cvenue="SELECT Venue_ID FROM venue WHERE Venue_Detail = '$classVenue'";
		$getCvenue = $conn->query($cvenue);
		while($row = $getCvenue->fetch_assoc()){
			$claVenue = $row["Venue_ID"];
		}
		$subjectClassVenueUpdateDB = "UPDATE subject SET Class_Venue = $claVenue WHERE Subject_ID = '$subject' AND Subject_Group='$group'";
		$conn->query($subjectClassVenueUpdateDB);
	}

	if($finalVenue !=NULL)
	{
		$fvenue="SELECT Venue_ID FROM venue WHERE Venue_Detail = '$finalVenue'";
		$getFvenue = $conn->query($fvenue);
		while($row = $getFvenue->fetch_assoc()){
			$finVenue = $row["Venue_ID"];
		}
		$subjectFinalVenueUpdateDB = "UPDATE subject SET FinalExa_Venue = $finVenue WHERE Subject_ID = '$subject' AND Subject_Group='$group'";
		$conn->query($subjectFinalVenueUpdateDB);
	}

	if($price !=NULL)
	{
		$subjectPriceUpdateDB = "UPDATE subject SET Price = $price WHERE Subject_ID = '$subject' AND Subject_Group='$group'";
		$conn->query($subjectPriceUpdateDB);
	}

	if($term !=NULL)
	{
		$subjectTermUpdateDB = "UPDATE subject SET Term = $term WHERE Subject_ID = '$subject' AND Subject_Group='$group'";
		$conn->query($subjectTermUpdateDB);
	}

	echo "<script type='text/javascript'>alert('Upadate Successful!');
		window.location.href='AdminSMEditSubjectPage.php';
		</script>";

}
else
{
	alert($message);
	echo "<script type='text/javascript'>
		window.location.href='AdminSMEditSubjectPage.php';
		</script>";
}

?>