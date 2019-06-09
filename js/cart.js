function removeFromCart(orderID, productID){
	var request = new XMLHttpRequest();
	var requestUrl = "updateCart.php?type=remove&itemID="+productID+"&orderID="+orderID;
	request.open("POST", requestUrl, true);
	request.send(null);
}

function checkoutCart(){
	var request = new XMLHttpRequest();
	request.onreadystatechange = function (){
		if(request.readyState === 4 && request.status === 200){
			if(request.responseText == 1){
				location.reload(true);
			}
			else{
				alert("Failed to checkout");
			}
		}
	};
	request.open("POST", "updateCart.php?type=checkout", true);
	request.send(null);
}
