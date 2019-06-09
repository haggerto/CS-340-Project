function removeFromCart(orderID, productID){
    var request = new XMLHttpRequest();
    var requestUrl = "updateCart.php?type=remove&itemID="+productID+"&orderID="+orderID;
    request.open("POST", requestUrl, true);
    request.send(null);
  }