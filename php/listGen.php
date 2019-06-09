<?php
    function listProduct($result){
    while($row = mysqli_fetch_row($result)) {
			echo '<div class="bestSellerDiv">';
			echo '<p class="productName">';
			echo $row[0];
			echo '</p><p class="productCost">Price:&#36;';
            echo $row[2] - $row[1] * $row[2] / 100;
            echo '</p>';
			if(isset($_SESSION['user'])){
				echo '<input type="button" onclick="addToCart(';
				echo $row[2];
				echo ')" class="addToCartButton" value="Add to Cart">';
			}
			echo '</div>';
        }
    }

    function listSale($result){
        while($row = mysqli_fetch_row($result)) {
                echo '<div class="bestSellerDiv">';
                echo '<p class="productName">';
                echo $row[0];
                echo '</p><p class="productCost">Price:&#36;';
                echo $row[2] - $row[1] * $row[2] / 100;
                echo '</p><p class="originalCost">Used to be: &#36;';
                echo $row[2];
                echo '</p>';
                if(isset($_SESSION['user'])){
                    echo '<input type="button" onclick="addToCart(';
                    echo $row[2];
                    echo ')" class="addToCartButton" value="Add to Cart">';
                }
                echo '</div>';
            }
        }
?>