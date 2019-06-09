<!DOCTYPE html>
<?php
	$currentpage="Information";
	include "page.php";
?>
<html lang="en">
	<head>
		<meta charset="utf-8"></meta>
		<title>Information</title>
		<script src="../js/project.js" charset="utf-8" type="text/javascript" defer></script>
		<script src="../js/information.js" charset="utf-8" type="text/javascript" defer></script>
		<link rel="stylesheet" href="../css/project.css">
		<link rel="stylesheet" href="../css/information.css">
	</head>
	<body>
		<?php
		include 'dbconnect.php';
		include 'header.php';
		?>

		<div id="hotProductsDiv" class="mainContentBox">
			<div id="question-answer">
				<p id="question">
					Q: How secure is this website? 
				</p>
				<p id="answer">
					A: THIS WEBSITE IS NOT SECURE! SERIOUSLY, DO NOT USE ANY REAL INFORMATION. All data collected from this site is stored in plaintext and is not secure in any way.
				</p>
			</div>
			<div id="question-answer">
				<p id="question">
					Q: How does a user change their username?
				</p>
				<p id="answer">
					A: Users cannot change their username.
				</p>
			</div>
			<div id="question-answer">
				<p id="question">
					Q: How does a user change their registered name?
				</p>
				<p id="answer">
					A: A user can change their registered name by navigating to the “Account Information” page and clicking the “Change Name” button at the bottom of the page.
				</p>
			</div>
			<div id="question-answer">
				<p id="question">
					Q: How does a user change their password?
				</p>
				<p id="answer">
					A: A user can change their password by navigating to the “Account Information” page and clicking the “Change Password” button at the bottom of the page. The user will need to know their current password before they can change to a new one.
				</p>
			</div>
			<div id="question-answer">
				<p id="question">
					Q: How does a user manage their credit cards?
				</p>
				<p id="answer">
					A: A user can manage their credit cards via the “Account Information” page. The “Add Credit Card” button will allow the user to add as many credit cards as they would like. Above this button is a list of all credit cards the user has added to their account. A specific credit card may be removed using the red “X” button next to the specific credit card they would like deleted.
				</p>
			</div>
			<div id="question-answer">
				<p id="question">
					Q: What is the information displayed on the home page?
				</p>
				<p id="answer">
					A: The home page displays the hottest items on the site. The items displayed on this page are the top selling items on the entire website.
				</p>
			</div>
			<div id="question-answer">
				<p id="question">
					Q: How can I find a product that is not on the front page?
				</p>
				<p id="answer">
					A: The products page contains a list of all available products on the website. If a product you wish to buy cannot be found on the products page, it is not available on the website.
				</p>
			</div>
			<div id="question-answer">
				<p id="question">
					Q: How do I purchase a product from the website?
				</p>
				<p id="answer">
					A: Products can be added to the user’s shopping cart from the home page and the products page. Once the user has added all of the items they are interested in to their shopping cart, they may visit the shopping cart page to check out.
				</p>
			</div>
		</div>
	</body>
</html>




	
