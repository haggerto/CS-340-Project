<?php
    $currentDate = date("Y-m-d");
	$quriesForSQL = array(
		"Home" => "SELECT productName, normalPrice FROM Products NATURAL JOIN
                   (SELECT * FROM getProductSaleCount ORDER BY saleCount DESC LIMIT 15)
                   BestSellers",
		"Products" => "SELECT productName, normalPrice
                       FROM Products
                       WHERE numberInStock > 0",
		"on-sale" => 'SELECT productName, normalPrice, discountAmount, endDate
                      FROM Products
                      NATURAL JOIN (
                          SELECT * FROM Sale Details
                          NATURAL JOIN (
                              SELECT discountID
                              FROM Sales
                              WHERE startDate <= `$currentDate` AND
                                    endDate >= `$currentDate` AND
                                    discountType = "open"))',
		"Account" => "SELECT * FROM Users WHERE userID=`$currentUser`");
?>
