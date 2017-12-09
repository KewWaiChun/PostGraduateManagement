<?php

$ReDate=$_POST['Date'];
$ReVenueID=$_POST['ReVenue'];
$RePurpose=$_POST['RePurpose'];
$testDate=false;
$testEmpty=false;
include "connect.php";
session_start();

$adminID = $_SESSION['adm_ID'];

if(empty($ReDate)||empty($RePurpose)||($RePurpose=="(In 255 words...)")){
	$testEmpty=true;
}else{
	try {
		$date = new DateTime($ReDate);
	} catch (Exception $e) {
		$testDate=true;
	}
}

if($testEmpty==false){
	if($testDate==false){
		$sql="SELECT DISTINCT COUNT(Reserve_Status) AS IsReserved FROM reservation WHERE Reserve_Status=\"Success\" AND Venue_ID=$ReVenueID AND Reserve_Date=\"$ReDate\";";
		$result=$conn->query($sql);
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				if($row["IsReserved"]>0){
					$replaceSQL="SELECT Reserve_ID FROM reservation WHERE Reserve_Status=\"Success\" AND Venue_ID=$ReVenueID AND Reserve_Date=\"$ReDate\";";
					$resultReplace=$conn->query($replaceSQL);
					if($resultReplace->num_rows>0){
						while($row=$resultReplace->fetch_assoc()){
							$tempReID=$row["Reserve_ID"];
						}
					}
					$chgSQL="Update Reservation Set Reserve_Status=\"Rejected\" WHERE Reserve_ID=$tempReID;";
					$chgResult=$conn->query($chgSQL);
					if($chgResult){
							$newSQL="INSERT INTO Reservation VALUES(DEFAULT,\"$ReDate\",\"$RePurpose\",\"Success\",$adminID,NULL,$ReVenueID);";		//Admin ID////
							$runnewSQL=$conn->query($newSQL);
							if($runnewSQL){
								echo "<script type='text/javascript'>alert('Success, existing reservation made will be rejected.');
								window.location.href='AdminApplicationReservationPage.php';
								</script>";
							}else{
								echo "<script type='text/javascript'>alert('Failed');
								window.location.href='AdminApplicationReservationPage.php';
								</script>";
							}
					}else{
						echo "<script type='text/javascript'>alert('Failed');
						window.location.href='AdminApplicationReservationPage.php';
						</script>";
					}
				}else{
					$newSQL="INSERT INTO Reservation VALUES(DEFAULT,\"$ReDate\",\"$RePurpose\",\"Success\",$adminID,NULL,$ReVenueID);";   //Admin ID////
					$runnewSQL=$conn->query($newSQL);
					if($runnewSQL){
						echo "<script type='text/javascript'>alert('Success');
						window.location.href='AdminApplicationReservationPage.php';
						</script>";
					}else{
						echo "<script type='text/javascript'>alert('Failed');
						window.location.href='AdminApplicationReservationPage.php';
						</script>";
					}
				}
			break;
			}
		}
	}else{
		echo "<script type='text/javascript'>alert('Please enter a valid date.');
		window.location.href='AdminApplicationReservationPage.php';
		</script>";
	}
}else{
	echo "<script type='text/javascript'>alert('Please enter all information.');
	window.location.href='AdminApplicationReservationPage.php';
	</script>";
}

?>