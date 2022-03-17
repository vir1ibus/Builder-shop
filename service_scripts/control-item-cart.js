function delete_item_from_cart(url, item_id) {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "http://" + url + "/service_scripts/control-item-cart.php?delete_item_from_cart=" + item_id, true);
    xmlhttp.send();
    document.getElementById("#cart_item_" + item_id).remove();
}

