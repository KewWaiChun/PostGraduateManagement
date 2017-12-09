<?php
	include "connect.php";

	//get user input from previous page
	$studentName = $_GET["studentName"];
	$studentPass = $_GET["studentPass"];
	$studentMode = $_GET["studentMode"];
	$studentCourse = $_GET["studentCourse"];
	$studentFaculty = $_GET["studentFaculty"];
	$studentContact = $_GET["studentContact"];
	$studentEmail = $_GET["studentEmail"];
	$supervisor = $_GET["supervisor"];
	$message= "Error!! \\n";

//-------------------------------------------------------------------------------------------------//

	//validate student name
	function checkStuName($studentName, $message){
		if($studentName==NULL){
			return false;
		}else{
    		return true;
		}
	}

	//validate student pass
	function checkStuPass($studentPass, $message){
		if($studentPass==NULL){
			return false;
		}else{
			//student pass must not more than 15
    		if(strlen($studentPass)<=15){
    			return true;
    		}else{
    			return false;
    		}
		}
	}

	//validate student mode
	function checkStuMode($studentMode, $message){
		if($studentMode==NULL){
			return false;
		}else{
			//student pass must either C or R
    		if($studentMode=='C' || $studentMode=='R'){
    			return true;
    		}else{
    			return false;
    		}
		}
	}

	//validate student course
	function checkStuCourse($studentCourse, $message){
		if($studentCourse==NULL){
			return false;
		}else{
			//student pass must not more than 25
    		if(strlen($studentCourse)<=25){
    			return true;
    		}else{
    			return false;
    		}
		}
	}

	//validate student faculty
	function checkStuFaculty($studentFaculty, $message){
		if($studentFaculty==NULL){
			return false;
		}else{
			//student pass must "FCI" or "FOE" or "FCM" or "FOM"
    		if($studentFaculty=="FCI" || $studentFaculty=="FOE" || $studentFaculty=="FOM" || $studentFaculty=="FCM"){
    			return true;
    		}else{
    			return false;
    		}
		}
	}

	//validate student contact
	function checkStuContact($studentContact, $message){
		if($studentContact==NULL){
			return false;
		}else{
			//student contact must in integer and not more than 12
    		if(is_numeric($studentContact) && strlen($studentContact)<=12){
    			return true;
    		}else{
    			return false;
    		}
		}
	}

	//validate student email format
	function checkStuEmail($studentEmail,$message){
		if ($studentEmail != NULL){
			if(strlen($studentEmail)<=25 && filter_var($studentEmail, FILTER_VALIDATE_EMAIL)){
				return true;
			}
			else{
				return false;
			}
		}else{
			return false;
		}
	}

	//validate supervisor
	function checkStuSup($supervisor,$message){
		if ($supervisor == NULL){
			return false;
		}else{
			return true;
		}
	}

//-------------------------------------------------------------------------------------------------//

	//compile error message
	if(checkStuName($studentName, $message)==false){
		$message = $message . "Student name cannot be null! \\n";
	}

	if(checkStuPass($studentPass, $message)==false){
		$message = $message . "Student password cannot be null and not more than 15 words! \\n";
	}

	if(checkStuMode($studentMode, $message)==false){
		$message = $message . "Student mode cannot be null! \\n";
	}

	if(checkStuCourse($studentCourse, $message)==false){
		$message = $message . "Student course cannot be null and not more than 25 words! \\n";
	}

	if(checkStuFaculty($studentFaculty, $message)==false){
		$message = $message . "Student faculty cannot be null! \\n";
	}

	if(checkStuContact($studentContact, $message)==false){
		$message = $message . "Student contact cannot be null and must in integer and not more than 12 words! \\n";
	}

	if(checkStuEmail($studentEmail, $message)==false){
		$message = $message . "Student email cannot be null and must in correct format! \\n";
	}

	if(checkStuSup($supervisor,$message)==false){
		$message = $message . "Supervisor cannot be null! \\n";
	}

	//-------------------------------------------------------------------------------------------------//

	function alert($text){
	    echo '<script type="text/javascript">alert("'.$text.'")</script>';
	}

	//-------------------------------------------------------------------------------------------------//

	if(checkStuEmail($studentEmail,$message)&&checkStuContact($studentContact, $message)&&checkStuFaculty($studentFaculty, $message)&&checkStuCourse($studentCourse, $message)&&checkStuName($studentName, $message)&&checkStuMode($studentMode, $message)&&checkStuPass($studentPass, $message)){

		//perform sql if student's mode is coursework
		if($studentMode=='C'){
			$student="INSERT INTO student VALUES (DEFAULT, '$studentName', '$studentPass', '$studentMode', 'Active', '$studentCourse', '$studentFaculty', $studentContact, '$studentEmail')";
			$addStudent=$conn->query($student);
			$stuid="SELECT Student_ID FROM student WHERE Student_Name='$studentName'";
			$getStuid=$conn->query($stuid);
			while($row=$getStuid->fetch_assoc()){
				$studentid=$row['Student_ID'];
			}

			$stu="INSERT INTO csw_student VALUES ($studentid, 0)";
			if($conn->query($stu)){}else{echo "error";}
		}

		//perform sql if student's mode is research
		if($studentMode=='R'){
			if(checkStuSup($supervisor,$message)){
				$student="INSERT INTO student VALUES (DEFAULT, '$studentName', '$studentPass', '$studentMode', 'Active', '$studentCourse', '$studentFaculty', $studentContact, '$studentEmail')";
				$addStudent=$conn->query($student);
				$stuid="SELECT Student_ID FROM student WHERE Student_Name='$studentName'";
				$getStuid=$conn->query($stuid);
				while($row=$getStuid->fetch_assoc()){
					$studentid=$row['Student_ID'];
				}

				$stu="INSERT INTO r_student VALUES ($studentid, $supervisor, 0)";
				if($conn->query($stu)){}else{echo "error";}
			}else{
				alert($message);
				echo '<script type="text/javascript">window.location.href = "AdminAddStudentPage.php"</script>';
			}
		}
		$message = "Added!!";
		alert($message);
		echo '<script type="text/javascript">window.location.href = "AdminAddStudentPage.php"</script>';
	}else{
		alert($message);
		echo '<script type="text/javascript">window.location.href = "AdminAddStudentPage.php"</script>';
	}

?>