<!DOCTYPE html>
<?php
		$currentpage="on-sale";
		include "page.php";
?>
<html lang="en">
  <head>
    <meta charset="utf-8"></meta>
    <title>Home Page</title>
    <script src="../js/project.js" charset="utf-8" type="text/javascript" defer></script>
    <script src="../js/on-sale.js" charset="utf-8" type="text/javascript" defer></script>
    <link rel="stylesheet" href="../css/project.css">
    <link rel="stylesheet" href="../css/on-sale.css">
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
			// Retrieve name of table selected
			// $currentDate = date("Y-m-d");
			// echo($currentDate);
			$query = 'SELECT productName, normalPrice, discountAmount, endDate
								FROM Products NATURAL JOIN (
									SELECT * FROM Sale Details NATURAL JOIN (
										SELECT discountID FROM Sales
										WHERE startDate <= `$currentDate` AND
													endDate >= `$currentDate` AND
													discountType = "open"))';


            $result = mysqli_query($conn, $query);
            if (!$result) {
            die("Query to show fields from table failed");
            }
            $fields_num = mysqli_num_fields($result);
			echo "<h1>On Sale:</h1>";
			echo "<table id='t01' border='1'><tr>";

			echo "</tr>\n";

		    while($row = mysqli_fetch_row($result)) {
			    echo "<tr>";
				// $row is array... foreach( .. ) puts every element
				// of $row to $cell variable
				foreach($row as $cell)
					echo "<td>$cell</td>";
				echo "</tr>\n";
            }


	        mysqli_free_result($result);
	        mysqli_close($conn);
		?>
		</div>
  </body>
</html>
