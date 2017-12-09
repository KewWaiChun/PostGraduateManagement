<?php
	include "connect.php";

	session_start();
	//global student id
    $subject = $_SESSION['subjectToPass'];
	$stud_id = $_SESSION['stu_ID'];
	$GLOBALS['check'] = NULL;

	$month = date('m');
	if($month > 0 && $month <5){
		$term = 1;
	}elseif ($month > 4 && $month <9) {
		$term = 2;
	}else {
		$term = 3;
	}
	$year = date('Y');
	
	if(empty($_GET['group'])) {
		echo "<script type='text/javascript'>alert('You have select no group.');
		window.location.href='StudentCSWEnrollmentPage.php';
		</script>";
	} else {
		$group = $_GET['group'];

		$fID = "SELECT Finance_ID FROM finance WHERE Student_ID = '$stud_id'";
		$getFID = $conn->query($fID);

		while($row1 = $getFID->fetch_assoc()){
		  	$fid = $row1['Finance_ID'];
		}
		for($j=0; $j<sizeof($group); $j++){
			$enrolled="SELECT Student_ID, Subject_ID, Subject_Group FROM enrollment WHERE Student_ID = '$stud_id' AND Subject_ID='$subject' AND Subject_Group='$group[$j]'";
			$getEnrolled=$conn->query($enrolled);
			while($row1 = $getEnrolled->fetch_assoc()){
			  	$GLOBALS['check'] = $row1['Student_ID'];
			}
		}

		if($GLOBALS['check'] != NULL){
			echo "<script type='text/javascript'>alert('Fail to Enrol Subject');
			window.location.href='StudentCSWEnrollmentPage.php';
			</script>";
		}else{
			//insert data to enroll subject
			for($i=0; $i<sizeof($group); $i++){
				$subjectToInsert = "INSERT INTO enrollment VALUES (DEFAULT, '$stud_id', '$subject', '$group[$i]', $year, $fid)";
				if($conn->query($subjectToInsert)){
					$outstanding = "SELECT Outstanding_Fees FROM finance WHERE Student_ID = '$stud_id'";
					$exec = $conn->query($outstanding);

					while($row1 = $exec->fetch_assoc()){
					  	$fees = $row1['Outstanding_Fees'];
					}

					$subPrice = "SELECT Price FROM subject WHERE Subject_ID = '$subject' AND Subject_Group = '$group[$i]'";
					$exc = $conn->query($subPrice);
					while($row = $exc->fetch_assoc()){
						  $tempPrice = $row['Price'];
					}

					$NewOutstanding = $fees + $tempPrice;

					$updateOutstanding = "UPDATE finance SET Outstanding_Fees = $NewOutstanding, Finance_Status = 'Uncleared' WHERE Student_ID = $stud_id";
					if($conn->query($updateOutstanding)){}

					$curCreditHour = "SELECT CurrentCredit_Hour FROM result WHERE Student_ID = '$stud_id'";
					$exe = $conn->query($curCreditHour);
					while($row = $exe->fetch_assoc()){
						  $tempCCH = $row['CurrentCredit_Hour'];
					}

					$creditHour = "SELECT Credit_Hour FROM subject WHERE Subject_ID = '$subject' AND Subject_Group ='$group[$i]'";
					$execute = $conn->query($creditHour);
					while($row = $execute->fetch_assoc()){
						  $tempCH = $row['Credit_Hour'];
					}

					$totalCH = $tempCCH + $tempCH;

					$updateCH = "UPDATE result SET CurrentCredit_Hour = $totalCH WHERE Student_ID = $stud_id";
					if($conn->query($updateCH)){}

					echo "<script type='text/javascript'>window.location.href='StudentCSWEnrollmentPage.php'; </script>";
					
				} else {
					echo "<script type='text/javascript'>alert('Fail to Enrol Subject');
					window.location.href='StudentCSWEnrollmentPage.php';
					</script>";
				}
			}

			$resultID = "SELECT Result_ID FROM result WHERE Student_ID = '$stud_id'";
			$getResultID = $conn->query($resultID);
			while($row = $getResultID->fetch_assoc()){
				$resuID = $row['Result_ID'];
			}

			$supID = "SELECT Supervisor_ID FROM subject_supervisor WHERE Subject_ID = '$subject'";
			$getSuperID = $conn->query($supID);
			while($row = $getSuperID->fetch_assoc()){
				$superID = $row['Supervisor_ID'];
			
			}

			$addRow = "INSERT INTO subject_result VALUES($resuID, $superID, '$subject', 0, $year)";
			if($conn->query($addRow)){}
		}
	}
?>