/*Gets the username of the current user*/
function getCurrentUser(){
	var request = new XMLHttpRequest();
	request.open("GET", "handleLogIns.php?type=getUser", false);
	request.send(null);
	return request.responseText;
}

/*Run when the log in button is clicked.
  Shows or hides the log in popup*/
function logInButtonClicked(event){
	document.getElementById("logInPopup").classList.toggle("hidden");
}

/*Logs the user out of the webpage*/
function logOut(event){
	var request = new XMLHttpRequest();
	request.onreadystatechange = function (){
		if(request.readyState === 4 && request.status === 200){
			//replace log out button with log in button
			var logInHtml = "<div id=\"logInButton\" class=\"logInOutButton\">Log In</div>";
			document.getElementById("logOutButton").outerHTML = logInHtml;
			document.getElementById("logInButton").addEventListener("click",logInButtonClicked);
			location.reload(true); //refresh the page
		}
	}
	request.open("GET", "handleLogIns.php?type=logOut", true);
	request.send(null);
}

/*Displays a notification via a drop down div*/
function showNotification(message){
	if(document.getElementById("notificationDiv") && document.getElementById("notificationDiv").classList.contains("hidden")){
		document.getElementById("notificationDiv").textContent = message;
		document.getElementById("notificationDiv").classList.remove("hidden");
		document.getElementById("notificationDiv").style.webkitAnimationPlayState = "running";
		function animationOver(){
			document.getElementById("notificationDiv").classList.add("hidden");
			document.getElementId("notificationDiv").removeEventListener("animationend", animationOver);
		}
		document.getElementById("notificationDiv").addEventListener("animationend",animationOver);
	}
}

/*Run when the submit log in button is pressed*/
function submitLogIn(){
	var submittedUsername = document.getElementById("logInPopupUsernameField").value;
	var submittedPassword = document.getElementById("logInPopupPasswordField").value;
	if(submittedUsername === ""){
		alert("Error:You must enter a username");
	}
	else if(submittedPassword === ""){
		alert("Error:You must enter a password");
	}
	else{	//a username and password were submitted
		var request = new XMLHttpRequest();
		request.onreadystatechange = function () {
			if(request.readyState === 4 && request.status === 200){	//got a response
				if(request.responseText == "\nTRUE"){	//log in was successful
					document.getElementById("logInPopup").classList.add("hidden");	//hide the log in popup
					var logOutHtml = "<div id=\"logOutButton\" class=\"logInOutButton\">Log Out</div>";
					document.getElementById("logInButton").outerHTML = logOutHtml;
					//change the log in button to the log out button
					document.getElementById("logOutButton").addEventListener("click", logOut);
					location.reload(true);
				}
				else{
					alert("The username and password did not match any account in our records");
				}
				/*Clear the password Field*/
				document.getElementById("logInPopupPasswordField").value = "";
			}
		}
		request.open("GET", "handleLogIns.php?type=logIn&user="+submittedUsername+"&pass="+submittedPassword, true);
		request.send(null);
	}
}

if(document.getElementById("logInButton")!=undefined){
	document.getElementById("logInButton").addEventListener("click",logInButtonClicked);
}
else{
	document.getElementById("logOutButton").addEventListener("click",logOut);
}
