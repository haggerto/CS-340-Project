/*Adds a product to the current user's cart
  Takes the id of the product*/
function addToCart(id){

	var request = new XMLHttpRequest();
	request.onreadystatechange = function (){
		if(request.readyState === 4 && request.status === 200){
			if(request.responseText == 1){
				showNotification("Added to cart");
			}
		}
	}
	var requestUrl = "updateCart.php?type=add&itemID="+id;
	request.open("POST", requestUrl, true);
	request.send(null);
}

function removeFromCart(orderID, productID){
  var request = new XMLHttpRequest();
  var requestUrl = "updateCart.php?type=remove&itemID="+id+"&orderID="+orderID;
  request.open("POST", requestUrl, true);
  request.send(null);
}
