/*Adds a product to the current user's cart
  Takes the id of the product*/
function addToCart(id){

  var request = new XMLHttpRequest();
	var requestUrl = "updateCart.php?type=add&itemID="+id+"&userID="+getCurrentUser();
  request.open("POST", requestUrl, true);
  request.send(null);
}
