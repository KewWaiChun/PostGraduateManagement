<?php
include "connect.php";

session_start();

$studentID = $_SESSION['stu_ID'];

//declare variables
$PayAmount=$_POST['Amount'];
$Credit=$_POST['CreditCardNumber'];

if(!(empty($Credit))){
	if(is_numeric($PayAmount)!=NULL){
		$sql="SELECT Outstanding_Fees FROM Finance WHERE Student_ID=$studentID AND Finance_Status=\"Uncleared\";";		//Student ID/////
		$result=$conn->query($sql);
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				$AmountToPay=$row["Outstanding_Fees"];
			}
			if($PayAmount>$AmountToPay){
				echo "<script type='text/javascript'>alert('Please Enter a valid number');
				window.location.href='StudentRFinancialPage.php';
				</script>";
			}else{
				$remain=$AmountToPay-$PayAmount;
				if($remain>0){
					$sql3="Update Finance Set Outstanding_Fees=$remain WHERE Student_ID=$studentID AND Finance_Status=\"Uncleared\";"; //Student ID/////
				}else{
					$sql2="Update Finance Set Outstanding_Fees=$remain WHERE Student_ID=$studentID AND Finance_Status=\"Uncleared\";"; //Student ID/////
					$result=$conn->query($sql2); 
					$sql3="Update Finance Set Finance_Status=\"Cleared\" WHERE Student_ID=$studentID AND Outstanding_Fees=0.00;";   //Student ID/////
				}
				$result=$conn->query($sql3);
				echo "<script type='text/javascript'>
				window.location.href='StudentRFinancialPage.php';
				</script>";
			}
		}
	}
	else{
		echo "<script type='text/javascript'>alert('Please enter a valid number');
		window.location.href='StudentRFinancialPage.php';
		</script>";
	}
}else{
	echo "<script type='text/javascript'>alert('Please enter all information');
	window.location.href='StudentRFinancialPage.php';
	</script>";
}
?>