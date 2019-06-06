/*Hides the log in popup*/
function hideLogInPopup (){
	if(!document.getElementById("logInPopup").classList.contains("hidden")){
		document.getElementById("logInPopup").classList.add("hidden");
	}
}

/*Run when the log in button is clicked.
  Shows or hides the log in popup*/
function logInButtonClicked(event){
	document.getElementById("logInPopup").classList.toggle("hidden");
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
					hideLogInPopup();
					alert("Log in successful!");
				}
				else{
					alert("The username and password did not match any account in our records");
				}
				/*Clear the password Field*/
				document.getElementById("logInPopupPasswordField").value = "";
			}
		}
		request.open("GET", "checkLogIn.php?user="+submittedUsername+"&pass="+submittedPassword, true);
		request.send(null);
	}
}

document.getElementById("logInButton").addEventListener("click",logInButtonClicked);
