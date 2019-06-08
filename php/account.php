<!DOCTYPE html>
<?php
	$currentpage="Acccount Information";
	include "page.php";
?>
<html lang="en">
	<head>
		<meta charset="utf-8"></meta>
		<title>Account Information</title>
		<script src="../js/project.js" charset="utf-8" type="text/javascript" defer></script>
		<script src="../js/account.js" charset="utf-8" type="text/javascript" defer></script>
		<link rel="stylesheet" href="../css/project.css">
		<link rel="stylesheet" href="../css/account.css">
	</head>
	<body>
		<?php
		include 'dbconnect.php';
		include 'header.php';
		?>

		<div id="hotProductsDiv" class="mainContentBox">
			<?php
			session_start();

			$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			if (!$conn) {
				die('Could not connect: ' . mysql_error());
			}

			if(isset($_SESSION['user'])){	//check if the user is logged in
				$query = "SELECT * FROM Users WHERE userID='".$_SESSION['user']."'";

				$result = mysqli_query($conn, $query);
				if (!$result) {	//failed to get user data
					die("<p class='logInError'>Login first</p>");
				}
				else{
					$row = mysqli_fetch_row($result);
					$userId = $row[0];
					echo "<h2>Username</h2><p class='usernameText'>";
					echo $row[1];	//display the username
					echo "</p><h2>Real Name</h2><p class='userRealNameText'>";
					echo $row[3];	//display the real name
					echo "</p><h2>Date Created</h2><p class='dateCreatedText'>";
					echo $row[4];	//display the date created
					echo "</p><h2>User Type</h2><p class='userTypeText'>";
					if($row[5]=="mngr"){	//display the user type
						echo "Manager</p>";
					}
					else{
						echo "Customer</p>";
					}

					$query = "SELECT * FROM CreditCards WHERE customerID=$userId";
					$ccData = mysqli_query($conn, $query);
					if (!$ccData) {	//failed to get user data
						die("<p class='fetchDataError'>Could not fetch credit card data</p>");
					}
					else{
						echo "<h2>Credit Cards</h2>";
						echo "<table class='creditCardDataTable'>";
						echo "<tr><th></th><th>Company</th><th>Card Number</th><th>Card Holder</th></tr>";
						while($row = mysqli_fetch_row($ccData)){	//add the credit card details
							echo "<tr><td><span class='removeCreditCardButton'>X</span></td><td>";
							echo $row[2];
							echo "</td><td>";
							echo $row[3];
							echo "</td><td>";
							echo $row[4];
							echo "</td></tr>";
						}
						echo "</table>";
						/*Add buttons for changing account properties*/
						echo "<p><span class='editInfoButton'>Change Password</span>";
						echo "<span class='editInfoButton'>Change Name</span>";
						echo "<span class='editInfoButton'>Add Credit Card</span></p>";
					}
					mysqli_free_result($ccData);
				}

				mysqli_free_result($result);
			}
			else{
				die("<p class='logInError'>Login first</p>");
			}

			mysqli_close($conn);
			?>
		</div>
	</body>
</html>
