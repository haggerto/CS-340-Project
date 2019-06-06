<header>
	<div id="headerTitle"><?php echo $currentpage ?></div>
	<div id="logInButton">Log In</div>
	<div id="logInPopup" class="hidden">
		<input type="text" name="logInPopupUsernameField" id="logInPopupUsernameField" placeholder="Username">
		<input type="password" name="logInPopupPasswordField" id="logInPopupPasswordField" placeholder="Password">
		<input type="button" name="logInPopupSubmitButton" id="logInPopupSubmitButton" value="Log In" onclick="submitLogIn()">
	</div>
	<div id="titleBarLinks">
		<?php
			$contentLen = count($content);
			$i = 0;	//used for checking for the last index
			foreach ($content as $page => $location){
				echo "<a href='$location?user=".$user."' >".$page."</a>";
				if(++$i !== $contentLen){
					echo '|';
				}
			}
		?>
	</div>
</header>
