let xmlhttp = new XMLHttpRequest();

function delete_item_from_cart(url, item_id) {
    xmlhttp.open("GET", "http://" + url + "/service_scripts/control-item-cart.php?delete_item_from_cart=" + item_id, true);
    xmlhttp.send();
    document.getElementById("#cart_item_" + item_id).remove();
}

function add_item_into_cart(url, item_id, image, name, price) {
    xmlhttp.open("GET", "http://" + url + "/service_scripts/control-item-cart.php?add_item_into_cart=" + item_id, true);
    xmlhttp.send();
    let cart = document.getElementById("#cart");
    cart.innerHTML += `
        <tr id="#cart_item_${item_id}">
            <td class="row justify-content-center gx-1">
                <div class="col-lg-2 col-md-4 col-sm-12 row justify-content-center"><img style="object-fit: contain;" src="${image}"></div> 
                <div class="col-lg-5 col-md-5 col-sm-12 row justify-content-center align-content-center"><a class="text-center" href="index.php?page=iteminfopage&item=${item_id}">${name}</a></div>
                <div class="col-lg-2 col-md-2 col-sm-12 row justify-content-center align-content-center">${price} руб.</div>
                <div class="col-lg-1 col-md-2 col-sm-12 row justify-content-center align-content-center">
                    <input class="text-center m-5" type="number" min="0" value="0" name="count">
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 row justify-content-center align-content-center">
                    <button class="d-none d-lg-block btn btn-secondary " onclick="delete_item_from_cart('${url}', ${item_id})">
                        Удалить
                    </button>
                    <button class="d-lg-none btn btn-secondary" onclick="delete_item_from_cart('${url}', ${item_id})">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
    `;
}

