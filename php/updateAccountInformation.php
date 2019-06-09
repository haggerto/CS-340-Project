<?php
	include 'dbconnect.php';
	$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if(!$connection){	//confirm that the connection was made
		die("DB_CONNECTION_FAILED");
	}

	session_start();
	
	if(!isset($_SESSION['user'])){	//confirm that a user is logged in
		die("NO_USER");
	}
	
	$getOp = $_GET["type"];
	switch($getOp){
		case acc:	//add credit card
			$cardCompany = mysqli_real_escape_string($connection, $_GET['company']);
			$cardHolder = mysqli_real_escape_string($connection, $_GET['holder']);
			$billingAddress = mysqli_real_escape_string($connection, $_GET['address']);
			$cardNumber = mysqli_real_escape_string($connection, $_GET['num']);
			$expDate = mysqli_real_escape_string($connection, $_GET['expDate']);
			$secCode = mysqli_real_escape_string($connection, $_GET['secCode']);

			$addCardQuery = "INSERT INTO CreditCards Values(".$_SESSION['user'].",'".$billingAddress;
			$addCardQuery .= "','".$cardCompany."',".$cardNumber.",'".$cardHolder."','".$expDate."',".$secCode.")";
			$addCardRes = mysqli_query($connection, $addCardQuery);
			echo $addCardRes;
			break;
		case rcc:	//remove credit card
			$cardNum = $_GET['num'];

			$deleteCardQuery = "DELETE FROM CreditCards WHERE customerID=".$_SESSION['user']." AND cardNumber=".$cardNum;
			$deleteCardRes = mysqli_query($connection, $deleteCardQuery);
			echo $deleteCardRes;
			break;
		case pass:	//change password operation
			$oldPass = mysqli_real_escape_string($connection, $_GET['oldPass']);
			$newPass = mysqli_real_escape_string($connection, $_GET['newPass']);

			$oldPassQuery = 'SELECT * FROM Users WHERE userID='.$_SESSION['user'];
			$oldPassRes = mysqli_query($connection, $oldPassQuery);
			$row = mysqli_fetch_row($oldPassRes);
			if($row[2]!=$oldPass){	//confirm that the old password was correct
				die("BAD_PASS");
			}

			$newPassUpdate = 'UPDATE Users SET password="'.$newPass.'" WHERE userID="'.$_SESSION['user'].'"';
			$newPassRes = mysqli_query($connection, $newPassUpdate);
			echo $newPassRes;
			break;
		case name:
			$newName = mysqli_real_escape_string($connection, $_GET['name']);

			$newNameUpdate = "UPDATE Users SET name='".$newName."' WHERE userID=".$_SESSION['user'];
			$newNameRes = mysqli_query($connection, $newNameUpdate);
			if($newNameRes){	//check for success
				echo 1;
			}
			else{
				echo 0;
			}
			break;
		default:
			echo "UNKNOWN_OPERATION";
	}
?>
