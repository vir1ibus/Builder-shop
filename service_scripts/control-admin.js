function delete_item(url, item_id) {
    xmlhttp.open("GET", "http://" + url + "/service_scripts/control-admin.php?delete-item=" + item_id, true);
    xmlhttp.send();
    document.getElementById("item_" + item_id).remove();
}