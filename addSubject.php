<?php
	include "connect.php";

	//get user input from previous page	
	$subjectName = $_POST["subjectName"];
	$subjectID = $_POST["subjectID"];
	$subjectGroup = $_POST["subjectGroup"];
	if(isset($_POST['credithour'])){
        $credithour = $_POST["credithour"];
	}
	$subjectTime = $_POST["subjectTime"];
	$subjectDay = $_POST["subjectDay"];
	$classVenue = $_POST["classVenue"];
	if(isset($_POST['finalTime'])){
        $finalTime = $_POST["finalTime"];
	}
	if(isset($_POST['finalDate'])){
        $finalDate = $_POST["finalDate"];
	}
	if(isset($_POST['finalVenue'])){
        $finalVenue = $_POST["finalVenue"];
	}
	if(isset($_POST['price'])){
        $price = $_POST["price"];
	}
	
	$term = $_POST["term"];
	$sgc = $_POST["sgc"];
	$message= "Error!! \\n";

//-------------------------------------------------------------------------------------------------//

	if($sgc=="tutorial"){
		$credithour = NULL;
		$price = NULL;
		$finalVenue = NULL;
		$finalDate = NULL;
		$finalTime = NULL;
		
		function checkCH($credithour, $message){
			return true;
		}
	}else{
		function checkCH($credithour, $message){
			if($credithour==NULL){
				return false;
			}else{ 
				//validate the credit hour is integer or not
				if(is_numeric($credithour)){
					if($credithour<5 && $credithour>0){
						return true;
					}else{
						return false;
					}
				}else{
					return false;
				}
			}
		}
	}


	//validate the subject group categories
	function checkSGC($sgc, $message){
		if($sgc==NULL){
			return false;
		}else{
    		return true;
		}
	}

	//validate the term
	function checkT($term, $message){
		if($term==NULL){
			return false;
		}else{ 
    		if(is_numeric($term)){
    			if($term<4 && $term>0){
    				return true;
    			}else{
    				return false;
    			}
    		}else{
    			return false;
    		}
		}
	}

	//validate the subject day
	function checkSD($subjectDay, $message){
		if($subjectDay==NULL){
			return false;
		}else{ 
    		return true;
		}
	}

	//validate the class venue
	function checkCV($classVenue, $message){
		if($classVenue==NULL){
			return false;
		}else{ 
    		return true;
		}
	}

	//validate the subject name
	function checkSN($subjectName, $message){
		if($subjectName==NULL){
			return false;
		}else{ 
			return true;
		}
	}

	//validate the subject time
	function checkST($subjectTime, $message){
		if($subjectTime==NULL){
			return false;
		}else{ 
			return true;
		}
	}

	//validate the subject id
	function checkSI($subjectID, $message){
		if($subjectID==NULL){
			return false;
		}else{ 
			if(strlen($subjectID)<=7){
				return true;
			}else{
				return false;
			}
		}
	}

	//validate the subject group
	function checkSG($subjectGroup, $message){
		if($subjectGroup==NULL){
			return false;
		}else{ 
			if(is_numeric($subjectGroup) && strlen($subjectGroup)<=2){
				return true;
			}else{
				return false;
			}
		}
	}

//-------------------------------------------------------------------------------------------------//

	if(checkSN($subjectName, $message) == false){
		$message = $message . "Subject name cannot be null! \\n";
	}
	if(checkSI($subjectID, $message) == false){
		$message = $message . "Subject ID cannot be null and the length is not longer than 7! \\n";
	}
	if(checkSGC($sgc, $message) == false){
		$message = $message . "Subject Group Categories cannot be null! \\n";
	}
	if(checkSG($subjectGroup, $message) == false){
		$message = $message . "Subject Group cannot be null! \\n";
	}
	if(checkCH($credithour, $message) == false){
		$message = $message . "Credit hour must be more than 0 and less than 5! \\n";
	}
	if(checkST($subjectTime, $message) == false){
		$message = $message . "Time cannot be null! \\n";
	}
	if(checkSD($subjectDay, $message) == false){
		$message = $message . "Day cannot be null! \\n";
	}
	if(checkCV($classVenue, $message) == false){
		$message = $message . "Class venue cannot be null! \\n";
	}
	if(checkT($term, $message) == false){
		$message = $message . "Term must be more than 0 and less than 4! \\n";
	}

	//-------------------------------------------------------------------------------------------------//

	function alert($text){
	    echo '<script type="text/javascript">alert("'.$text.'")</script>';
	}

	//-------------------------------------------------------------------------------------------------//
	if(checkCH($credithour, $message)&&checkSD($subjectDay, $message)&&checkCV($classVenue, $message)&&checkSN($subjectName, $message)&&checkSI($subjectID, $message)&&checkSGC($sgc, $message)&&checkSG($subjectGroup, $message)&&checkST($subjectTime, $message)&&checkT($term, $message)){
		$cvenue="SELECT Venue_ID FROM venue WHERE Venue_Detail = '$classVenue'";
		$getCvenue = $conn->query($cvenue);
		while($row = $getCvenue->fetch_assoc()){
			$claVenue = $row["Venue_ID"];
		}
		if($sgc=="lecture"){
			$fvenue="SELECT Venue_ID FROM venue WHERE Venue_Detail = '$finalVenue'";
			$getFvenue = $conn->query($fvenue);
			while($row = $getFvenue->fetch_assoc()){
				$finVenue = $row["Venue_ID"];
			}
			//add "TC" in front of the subject group
			$subGroup="TC".strval($subjectGroup);
			$sub="INSERT INTO subject VALUES ('$subjectID', '$subGroup', '$subjectName', $credithour, '$finalDate', '$finalTime', $price, '$subjectTime', '$subjectDay', $term, '$finVenue', '$claVenue')";
		}
		if($sgc=="tutorial"){
			$subGroup="TT".strval($subjectGroup);
			$sub="INSERT INTO subject VALUES ('$subjectID', '$subGroup', '$subjectName', NULL, NULL, NULL, NULL, '$subjectTime', '$subjectDay', $term, NULL, '$claVenue')";
		}
		if($conn->query($sub)){
			$message = "Added!!";
		}else{
			$message = "Fail to add subject!!";
		}
		alert($message);
		echo '<script type="text/javascript">window.location.href = "AdminSMAddSubjectPage.php"</script>';

	}else{
		alert($message);
		echo '<script type="text/javascript">window.location.href = "AdminSMAddSubjectPage.php"</script>';
	}
?>