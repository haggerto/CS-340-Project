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
	//
}

function submitNewCreditCard(){
	//
}

document.getElementsByClassName("editInfoButton")[0].addEventListener("click",showChangePassPopup);
document.getElementsByClassName("editInfoButton")[1].addEventListener("click",showChangeNamePopup);
document.getElementsByClassName("editInfoButton")[2].addEventListener("click",showAddCreditCardPopup);

document.getElementById("addCreditCardPopup").addEventListener("focusout",checkAddCreditCardPopup);
document.getElementById("changeNamePopup").addEventListener("focusout",checkChangeNamePopup);
document.getElementById("changePasswordPopup").addEventListener("focusout",checkChangePassPopup);
