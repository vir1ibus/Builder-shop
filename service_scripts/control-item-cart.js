let xmlhttp = new XMLHttpRequest();

function delete_item_from_cart(url, item_id) {
    xmlhttp.open("GET", "http://" + url + "/service_scripts/control-item-cart.php?delete_item_from_cart=" + item_id, true);
    xmlhttp.send();
    document.getElementById("#cart_item_" + item_id).remove();
}

function add_item_into_cart(url, item_id) {
    xmlhttp.open("GET", "http://" + url + "/service_scripts/control-item-cart.php?add_item_into_cart=" + item_id, true);
    xmlhttp.send();
}

