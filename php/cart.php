<!DOCTYPE html>
<?php
	$currentpage="Shopping Cart";
	include "page.php";
?>
<html lang="en">
	<head>
		<meta charset="utf-8"></meta>
		<title>Shopping Cart</title>
		<script src="../js/project.js" charset="utf-8" type="text/javascript" defer></script>
		<script src="../js/cart.js" charset="utf-8" type="text/javascript" defer></script>
		<link rel="stylesheet" href="../css/project.css">
		<link rel="stylesheet" href="../css/cart.css">
	</head>
	<body>
	<?php
		include 'dbconnect.php';
		include 'header.php';
	?>

		<div id="cartProductsDiv" class="mainContentBox">
			<?php

				$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
				if (!$conn) {
					die('Could not connect: ' . mysql_error());
				}
				// Retrieve name of table selected
				session_start();

				$query = "SELECT Products.productID, productCount, Products.productName, Products.normalPrice, OrderContents.orderID
						  FROM Orders, OrderContents, Products
						  WHERE Orders.userID=".$_SESSION['user']." AND OrderContents.orderID = Orders.orderID AND Orders.orderStatus = 'shop'
						  AND Products.productID = OrderContents.productID";

				$result = mysqli_query($conn, $query);
				if (!$result) {
					if(!isset($_SESSION['user'])){
						die("<p class='logInError'>You must log in to use this page</p>");
					}
					else
					{
						die("Query to show fields from table failed");
					}
				} else {
					while($row = mysqli_fetch_row($result)) {
						echo '<div class="cartDiv">';
						echo '<p class="productName">';
						echo $row[2];
						echo '</p>';
						echo '<p class="productCost">Total Cost:&#36;';
						echo intval($row[3])*intval($row[1]);
						echo '</p>';
						echo '<p class="productCount">';
						echo $row[1];
						echo '</p>';
						echo '<input type="button" onclick="removeFromCart('.$row[4].', '.$row[0].')" class="removeFromCartButton" value="Remove from Cart">';
						echo '</div>';
        	}
					echo "<input type='button' onclick='checkoutCart()' id='checkoutButton' value='Checkout'>";
				}
				mysqli_free($result);
				mysqli_close($conn);
			?>
		</div>
	</body>
</html>
