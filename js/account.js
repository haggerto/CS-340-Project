/*Hides the add credit card popup if focus has left the div*/
function checkAddCreditCardPopup(){
	function focusInListener(event){
		if(!containsFocusedElement(document.getElementById("addCreditCardPopup"))){
			document.getElementById("addCreditCardPopup").classList.add("hidden");
		}
		document.removeEventListener("focusin", focusInListener);
	}
	document.addEventListener("focusin", focusInListener);
}

/*Hides the change name popup if focus has left the div*/
function checkChangeNamePopup(){
	function focusInListener(event){
		if(!containsFocusedElement(document.getElementById("changeNamePopup"))){
			document.getElementById("changeNamePopup").classList.add("hidden");
		}
		document.removeEventListener("focusin", focusInListener);
	}
	document.addEventListener("focusin", focusInListener);
}

/*Hides the change password popup if focus has left the div*/
function checkChangePassPopup(){
	function focusInListener(event){
		if(!containsFocusedElement(document.getElementById("changePasswordPopup"))){
			document.getElementById("changePasswordPopup").classList.add("hidden");
		}
		document.removeEventListener("focusin", focusInListener);
	}
	document.addEventListener("focusin", focusInListener);
}

/*Checks whether the passed element contains the focused element*/
function containsFocusedElement(element){
	if(document.activeElement === element){
		return Boolean(1);
	}
	else{
		var child;
		for(var i = 0; i < element.childNodes.length; i++){
			child = element.childNodes[i];
			if(containsFocusedElement(child)){
				return Boolean(1);
			}
		}
	}
	return Boolean(0);
}

/*Shows the add credit card popup*/
function showAddCreditCardPopup(){
	document.getElementById("addCreditCardPopup").classList.remove("hidden");
	document.getElementById("addCreditCardPopup").focus();
}

/*Shows the change name popup*/
function showChangeNamePopup(){
	document.getElementById("changeNamePopup").classList.remove("hidden");
	document.getElementById("changeNamePopup").focus();
}

/*Shows the change password popup*/
function showChangePassPopup(){
	document.getElementById("changePasswordPopup").classList.remove("hidden");
	document.getElementById("changePasswordPopup").focus();
}

function submitChangeName(){
	//
}

function submitChangePassword(){
	var oldPass = document.getElementById("oldPassInput").value;
	var newPass = document.getElementById("newPassInput").value;
	var confirmPass = document.getElementById("confirmNewPassInput").value;
	if(oldPass===""||newPass===""||confirmPass===""){
		alert("Error: You must fill in all the fields before submitting");
	}
	else{
		if(newPass!=confirmPass){
			alert("Error: The new password does not match the confirmation password");
		}
		else{
			var request = new XMLHttpRequest();
			request.onreadystatechange = function (){
				if(request.readyState === 4 && request.status === 200){
					document.getElementById("newPassInput").value = "";
					document.getElementById("confirmNewPassInput").value = "";
					if(request.responseText==="BAD_PASS"){	//the old password was entered wrong
						document.getElementById("oldPassInput").value = "";
						alert("Error: The old password is incorrect");
					}
					else if(request.responseText === "\nTRUE"){	//the password was successfully changed
						document.getElementById("oldPassInput").value = "";
						document.getElementById("changePasswordPopup").classList.add("hidden");
						document.getElementById("notificationDiv");
					}
					else{
						console.log(request.responseText);
					}
				}
			};
			var requestUrl = "updateAccountInformation.php?type=pass&oldPass="+oldPass+"&newPass="+newPass;
			request.open("POST",requestUrl,true);
			request.send(null);
		}
	}
}

function submitNewCreditCard(){
	//
}
if(document.getElementsByClassName("editInfoButton").length!=0){
	document.getElementsByClassName("editInfoButton")[0].addEventListener("click",showChangePassPopup);
	document.getElementsByClassName("editInfoButton")[1].addEventListener("click",showChangeNamePopup);
	document.getElementsByClassName("editInfoButton")[2].addEventListener("click",showAddCreditCardPopup);

	document.getElementById("addCreditCardPopup").addEventListener("focusout",checkAddCreditCardPopup);
	document.getElementById("changeNamePopup").addEventListener("focusout",checkChangeNamePopup);
	document.getElementById("changePasswordPopup").addEventListener("focusout",checkChangePassPopup);
}
