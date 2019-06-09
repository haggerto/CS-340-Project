<!DOCTYPE html>
<?php
	$currentpage="Sales";
	include "page.php";
?>
<html lang="en">
	<head>
		<meta charset="utf-8"></meta>
		<title>Sales</title>
		<script src="../js/project.js" charset="utf-8" type="text/javascript" defer></script>
		<script src="../js/sales.js" charset="utf-8" type="text/javascript" defer></script>
		<link rel="stylesheet" href="../css/project.css">
		<link rel="stylesheet" href="../css/sales.css">
	</head>
	<body>
	<?php
		include 'dbconnect.php';
		include 'header.php';
		include 'listGen.php'
	?>

		<div id="hotProductsDiv" class="mainContentBox">
			<?php
				$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
				if (!$conn) {
					die('Could not connect: ' . mysql_error());
				}
				$query = 'SELECT productName, discountAmount, normalPrice
						  FROM Products NATURAL JOIN (
							  SELECT * FROM SaleDetails NATURAL JOIN (
								  SELECT * FROM Sales WHERE discountType="open") table1) table2';

				$result = mysqli_query($conn, $query);
				if (!$result) {
					die("Query to show fields from table failed");
				}
				$fields_num = mysqli_num_fields($result);

				listSale($result);

				mysqli_free_result($result);
				mysqli_close($conn);
			?>
		</div>
	</body>
</html>
