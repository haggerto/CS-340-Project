<!DOCTYPE html>
<?php
	$currentpage="Products";
	include "page.php";
?>
<html lang="en">
	<head>
		<meta charset="utf-8"></meta>
		<title>Home Page</title>
		<script src="../js/project.js" charset="utf-8" type="text/javascript" defer></script>
		<script src="../js/products.js" charset="utf-8" type="text/javascript" defer></script>
		<link rel="stylesheet" href="../css/project.css">
		<link rel="stylesheet" href="../css/products.css">
	</head>
	<body>
	<?php
		include 'dbconnect.php';
		include 'header.php';
	?>

		<div id="ProductsDiv" class="mainContentBox">
			<?php

				$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
				if (!$conn) {
					die('Could not connect: ' . mysql_error());
				}
				// Retrieve name of table selected

				$query = "SELECT productName, normalPrice FROM Products WHERE numberInStock > 0";

				$result = mysqli_query($conn, $query);
				if (!$result) {
					die("Query to show fields from table failed");
				}
				$fields_num = mysqli_num_fields($result);

				while($row = mysqli_fetch_row($result)) {
					echo '<div class="bestSellerDiv">';
					echo '<p class="productName">';
					echo $row[0];
					echo '</p><p class="productCost">&#36;';
					echo $row[1];
					echo '</p>';
					if(isset($_SESSION['user'])){
						echo '<input type="button" onclick="addToCart(';
						echo $row[2];
						echo ')" class="addToCartButton" value="Add to Cart">';
					}
					echo '</div>';
				}

				mysqli_free_result($result);
				mysqli_close($conn);
			?>
			</div>
		</body>
	</html>
