<?php
	/*Function taken from getStudentInfo.php*/
	function clean_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$getType = $_GET["type"];
	if($getType==="logIn"){	//try to log in as the specified user
		/*connect to the database*/
		include "dbconnect.php";
		$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if(!$connection){
			die("Could not connect to the database");
		}

		/*get inputs and clean them for use in queries*/
		$user = $_GET["user"];
		$user = clean_input($user);
		$user = mysqli_real_escape_string($connection, $user);
		$pass = $_GET["pass"];
		$pass = mysqli_real_escape_string($connection, $pass);

		$query = "SELECT * FROM Users WHERE userName='$user' AND password='$pass'";
		$result = mysqli_query($connection, $query);

		if(mysqli_num_rows($result) == 1){	//the username and password matched
			session_start();
			$_SESSION['user'] = $user;	//log in the user with a php session
			echo "TRUE";
		}
		else{
			echo "FALSE";
		}
		mysqli_free_result($result);
		mysqli_close($connection);
	}
	else if($getType==="logOut"){	//log out the user
		session_destroy();
		echo "LOGOUT_DONE";
	}
	else if($getType==="getUser"){	//get the current user
		if(isset($_SESSION["user"])){
			echo $_SESSION["user"];
		}
		else{
			echo "NO_USER";
		}
	}
	else{
		echo "UNKNOWN_TYPE";
	}
?>
