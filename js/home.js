/*Adds a product to the current user's cart
  Takes the id of the product*/
function addToCart(id){
  var request = new XMLHttpRequest();
	var requestUrl = "updateCart.php?type=add&itemID="+id;
	request.onreadystatechange = function (){
		if(request.readyState === 4 && request.status === 200){
			if(request.responseText) showNotification("Added to cart");
		}
	}
  request.open("POST", requestUrl, true);
  request.send(null);
}
