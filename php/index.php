<!DOCTYPE html>
<?php
	$currentpage="Home";
	include "page.php";
?>
<html lang="en">
 	<head>
	<meta charset="utf-8"></meta>
	<title>Home Page</title>
	<script src="../js/project.js" charset="utf-8" type="text/javascript" defer></script>
	<script src="../js/home.js" charset="utf-8" type="text/javascript" defer></script>
	<link rel="stylesheet" href="../css/project.css">
	<link rel="stylesheet" href="../css/home.css">
</head>
	<body>
	<?php
		include 'dbconnect.php';
		include 'header.php';
	?>

		<div id="hotProductsDiv" class="mainContentBox">
		<?php
			$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			if (!$conn) {
				die('Could not connect: ' . mysql_error());
			}

			$query = "SELECT productName, normalPrice 
								FROM Products NATURAL JOIN (
									SELECT * FROM getProductSaleCount ORDER BY saleCount DESC LIMIT 15) BestSellers";
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
				echo '</p></div>';
			}

			mysqli_free_result($result);
			mysqli_close($conn);
		?>
		</div>
	</body>
</html>




	
