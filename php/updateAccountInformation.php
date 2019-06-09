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
			if($newPassRes){	//check for success
				echo 1;
			}
			else{
				echo 0;
			}
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
		default:
			echo "UNKNOWN_OPERATION";
	}
?>
