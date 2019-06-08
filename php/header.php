<header>
	<div id="headerTitle"><?php echo $currentpage ?></div>
	<?php
		session_start();
		if(isset($_SESSION['user'])){	//user is logged in
			echo '<div id="logOutButton" class="logInOutButton">Log Out</div>';
		}
		else{	//user is not logged in
			echo '<div id="logInButton" class="logInOutButton">Log In</div>';
		}
	?>
	<div id="logInPopup" class="hidden">
		<input type="text" name="logInPopupUsernameField" id="logInPopupUsernameField" size="32" placeholder="Username">
		<input type="password" name="logInPopupPasswordField" id="logInPopupPasswordField" size="32" placeholder="Password">
		<input type="button" name="logInPopupSubmitButton" id="logInPopupSubmitButton" value="Log In" onclick="submitLogIn()">
	</div>
	<div id="titleBarLinks">
		<?php
			$contentLen = count($content);
			$i = 0;	//used for checking for the last index
			foreach ($content as $page => $location){
				echo "<a href='$location'>".$page."</a>";
				if(++$i !== $contentLen){	//omit | after the last link
					echo '|';
				}
			}
		?>
	</div>
</header>
