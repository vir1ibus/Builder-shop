let xmlhttp = new XMLHttpRequest();

let counts = new Map();

function change_count(item_id, price) {
    let total = document.getElementById(`total-cart`);
    if(!counts.has(item_id)) {
        counts.set(item_id, 2);
        total.value = isNaN(Number(total.value) + Number(price)) ? 0 : Number(total.value) + Number(price);
    } else {
        let counter = document.getElementById(`cart_counter_item_${item_id}`);
        console.log(Number(counter.value));
        console.log(counts.get(item_id));
        if(Number(counter.value) < counts.get(item_id)) {
            total.value = isNaN(Number(total.value) - Number(price)) ? 0 : Number(total.value) - Number(price);
        } else if (Number(counter.value) > counts.get(item_id)) {
            total.value = isNaN(Number(total.value) + Number(price)) ? 0 : Number(total.value) + Number(price);
        }
        counts.set(item_id, Number(counter.value));
    }
}

function delete_item_from_cart(url, item_id, price) {
    xmlhttp.open("GET", "http://" + url + "/service_scripts/control-item-cart.php?delete_item_from_cart=" + item_id, true);
    xmlhttp.send();
    document.getElementById("cart_item_" + item_id).remove();
    let total = document.getElementById(`total-cart`);
    total.value = isNaN(Number(total.value) - Number(price)) ? 0 : Number(total.value) - Number(price);
}

function add_item_into_cart(url, item_id, image, name, price) {
    if(document.getElementById(`cart_item_${item_id}`) === null) {
        xmlhttp.open("GET", "http://" + url + "/service_scripts/control-item-cart.php?add_item_into_cart=" + item_id, true);
        xmlhttp.send();
        let cart = document.getElementById("cart");
        cart.innerHTML += `
            <tr id="cart_item_${item_id}">
                <td class="row justify-content-center gx-1">
                    <input type="hidden" name="item_id[]" value="${item_id}">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 row justify-content-center"><img style="object-fit: contain;" src="${image}"></div> 
                    <div class="col-xl-5 col-lg-4 col-md-12 col-sm-12 row justify-content-center align-content-center"><a class="text-center" href="index.php?page=iteminfopage&item=${item_id}">${name}</a></div>
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 row justify-content-center align-content-center">${price} руб.</div>
                    <div class="col-xl-2 col-lg-3 col-md-12 col-sm-12 row justify-content-center align-content-center">
                        <input class="text-center m-5 w-50" type="number" min="1" value="1" name="item_count[]" onchange="change_count(${item_id}, ${price})" id="cart_counter_item_${item_id}">
                    </div>
                    <div class="col-lg-1 col-sm-12 row justify-content-center align-content-center">
                        <button class="btn btn-secondary" onclick="delete_item_from_cart('${url}', ${item_id}, '${price}')">
                                <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `;
    } else {
        let counter = document.getElementById(`cart_counter_item_${item_id}`);
        counter.value = Number(counter.value) + 1;
    }
    let total = document.getElementById(`total-cart`);
    total.value = isNaN(Number(total.value) + Number(price)) ? 0 : Number(total.value) + Number(price);
}

