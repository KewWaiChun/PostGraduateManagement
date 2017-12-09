<?php
	include "connect.php";

	$supervisorName = $_GET["supervisorName"];
	$supervisorPass = $_GET["supervisorPass"];
	$supervisorContact = $_GET["supervisorContact"];
	$supervisorEmail = $_GET["supervisorEmail"];
	$supervisorFaculty = $_GET["supervisorFaculty"];
	$supervisorRoom = $_GET["supervisorRoom"];
	$message= "Error!! \\n";

	//validate student name
	function checkSupName($supervisorName, $message){
		if($supervisorName==NULL){
			return false;
		}else{
    		return true;
		}
	}

	//validate student pass
	function checkSupPass($supervisorPass, $message){
		if($supervisorPass==NULL){
			return false;
		}else{
			//student pass must not more than 15
    		if(strlen($supervisorPass)<=15){
    			return true;
    		}else{
    			return false;
    		}
		}
	}

	//validate supervisor faculty
	function checkSupFaculty($supervisorFaculty, $message){
		if($supervisorFaculty==NULL){
			return false;
		}else{
			//supervisor faculty must "FCI" or "FOE" or "FCM" or "FOM"
    		if($supervisorFaculty=="FCI" || $supervisorFaculty=="FOE" || $supervisorFaculty=="FOM" || $supervisorFaculty=="FCM"){
    			return true;
    		}else{
    			return false;
    		}
		}
	}

	//validate supervisor contact
	function checkSupContact($supervisorContact, $message){
		if($supervisorContact==NULL){
			return false;
		}else{
			//supervisor contact must in integer and not more than 12
    		if(is_numeric($supervisorContact) && strlen($supervisorContact)<=12){
    			return true;
    		}else{
    			return false;
    		}
		}
	}

	//validate supervisor email format
	function checkSupEmail($supervisorEmail,$message){
		if ($supervisorEmail != NULL){
			if(strlen($supervisorEmail)<=25 && filter_var($supervisorEmail, FILTER_VALIDATE_EMAIL)){
				return true;
			}
			else{
				return false;
			}
		}else{
			return false;
		}
	}

	//validate supervisor room format
	function checkSupRoom($supervisorRoom,$message){
		if ($supervisorRoom != NULL){
			if(strlen($supervisorRoom)<=10){
				return true;
			}
			else{
				return false;
			}
		}else{
			return false;
		}
	}

	if(checkSupName($supervisorName, $message)==false){
		$message = $message . "Supervisor name cannot be null! \\n";
	}

	if(checkSupPass($supervisorPass, $message)==false){
		$message = $message . "Supervisor password cannot be null and not more than 15 words! \\n";
	}

	if(checkSupContact($supervisorContact, $message)==false){
		$message = $message . "Supervisor contact cannot be null and must in integer and not more than 12 digits! \\n";
	}

	if(checkSupEmail($supervisorEmail, $message)==false){
		$message = $message . "Supervisor email cannot be null and must in correct format! \\n";
	}

	if(checkSupFaculty($supervisorFaculty, $message)==false){
		$message = $message . "Supervisor faculty cannot be null! \\n";
	}

	if(checkSupRoom($supervisorRoom, $message)==false){
		$message = $message . "Supervisor room cannot be null and must not more than 10 words! \\n";
	}

	function alert($text){
	    echo '<script type="text/javascript">alert("'.$text.'")</script>';
	}

	if(checkSupName($supervisorName, $message)&&checkSupPass($supervisorPass, $message)&&checkSupContact($supervisorContact, $message)&&checkSupEmail($supervisorEmail, $message)&&checkSupFaculty($supervisorFaculty, $message)&&checkSupRoom($supervisorRoom, $message)){		

		$sup="INSERT INTO supervisor VALUES (DEFAULT, '$supervisorName', '$supervisorPass', $supervisorContact, '$supervisorEmail', '$supervisorFaculty', '$supervisorRoom', 'Active')";
		if($conn->query($sup)){
			$message = "Added!!";
		}else{
			$message = "Fail to add Supervisor!!";
		}
		alert($message);
		echo '<script type="text/javascript">window.location.href = "AdminAddSupervisorPage.php"</script>';
	}else{
		alert($message);
		echo '<script type="text/javascript">window.location.href = "AdminAddSupervisorPage.php"</script>';
	}

?>