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
				
				$existingOrderQuery = "SELECT * FROM Orders WHERE userID=".$_SESSION['user']." AND orderStatus='shop'";
				$existingOrderResult = mysqli_query($connection, $existingOrderQuery);

				if(mysqli_num_rows($existingOrderResult) === 0) {
					$query = sprintf("INSERT INTO Orders VALUES(UUID(), %d, 0, 'none', 'shop', 0, 00000)", $_SESSION['user']);
					$res =  mysqli_query($connection, $query);
				}

				$orderID = mysqli_query($connection, "SELECT orderID FROM Orders WHERE userID=".$_SESSION['user']." AND orderStatus='shop'");
				$row = mysqli_fetch_row($orderID);
				echo $row[0];

				$orderContents = mysqli_query($connection, "SELECT * FROM OrderContents WHERE OrderContents.orderID = ".$row[0]." AND OrderContents.productID =".$_GET['itemID']);
				
				$update_query = "";
				if(mysqli_num_rows($orderContents) !== 0) {
					$update_query = "UPDATE OrderContents
					SET productCount = productCount + 1
					WHERE orderID =".$row[0]." AND productID =".$_GET['itemID'];
				}
				else{
					$update_query = "INSERT INTO OrderContents (productID, orderID, productCount)
					VALUES (".$_GET['itemID'].", ".$row[0].", 1)";
				}
				$updateRes = mysqli_query($connection, $update_query);
				echo $updateRes;
			break;
		case remove:
			//check if the item is in the shopping cart
			$checkCart = "SELECT * FROM OrderContents WHERE OrderContents.orderID=".$_GET['orderID']." AND OrderContents.productID=".$_GET['productID'];
			$row = mysqli_fetch_row(checkCart);

			$updateQuery = "";
			
			if($row[3] === 0) {
				echo "0 entries";
			} else if($row[3] === 1) {
				echo "1 entry";
				$updateQuery = "DELETE FROM OrderContents WHERE OrderContents.orderID =".$_GET['orderID']." AND OrderContents.productID=".$_GET['itemID'];
			} else {
				echo "many found";
			}
			//if there is only 1, delete the entry
			//if there are more than one, decrement productCount
			//if there are 0, do nothing.
			break;
		case checkout:
			$checkoutQuery = "UPDATE Orders SET orderStatus='sent' WHERE userID=".$_SESSION['user']." AND orderStatus='shop'";
			$res = mysqli_query($connection, $checkoutQuery);
			echo $res;
			break;
		default:
			echo "UNKNOWN_OPERATION";
			break;
	}
?>
