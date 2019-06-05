/*Run when the log in button is clicked.
  Shows or hides the log in popup*/
function logInButtonClicked(event){
  document.getElementById("logInPopup").classList.toggle("hidden");
}

function submitLogIn(){
  console.log(document.getElementById("logInPopupPasswordField").value);
  /*Clear the password Field*/
  document.getElementById("logInPopupPasswordField").value = "";
}

document.getElementById("logInButton").addEventListener("click",logInButtonClicked);
