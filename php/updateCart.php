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
		case add:
				//check if the user has an existing order
				
				$existingOrderQuery = "SELECT * FROM Orders WHERE userID = " . $_SESSION['user'] . " AND orderStatus = 'shop'";
				$existingOrderResult = mysqli_query($connection, $$existingOrderQuery);

				echo $existingOrderQuery;

				if(mysql_num_rows($existingOrderResult) == 0) {
					$query = sprintf("INSERT INTO Orders (userID, totalCost, shippingAddress, orderStatus, totalWeight, shippingZip) VALUES( %d, 0, 'none', 'shop', 0, 00000)", $_SESSION['user']);
					mysqli_query($connection, $query);

					echo $query;

					echo "FALSE";
				} else {
					echo "TRUE";
				}
				//if they do, check if the item is already in the orderContents with that orderID
				//if it is, increment the count
				//if it is not, add it with a count of 1
				//if they do not already have an order, create one and an orderContents
				//add the productID to the ordercontents.
			break;
		default:
			echo "UNKNOWN_OPERATION";
			break;
	}
?>