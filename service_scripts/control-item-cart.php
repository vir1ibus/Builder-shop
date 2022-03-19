<?php
    session_start();
    require_once('controller-database.php');
    if(isset($_GET['delete_item_from_cart'])) {
        if($_SESSION['authorized']) {
            $sql = "DELETE FROM user_has_item WHERE user_id = ${_SESSION['user_id']} AND item_id = ${_GET['delete_item_from_cart']};";
            $result = mysqli_query($connect_db, $sql);
        } else {
            unset($_SESSION['cart'][array_search($_GET['delete_item_from_cart'], $_SESSION['cart'])]);
        }
    }

    if(isset($_GET['add_item_into_cart'])) {
        if($_SESSION['authorized']) {
            $sql = "INSERT INTO user_has_item (user_id, item_id) VALUES (${_SESSION['user_id']}, ${_GET['add_item_into_cart']});";
            $result = mysqli_query($connect_db, $sql);
        } else {
            $_SESSION['cart'][] = $_GET['add_item_into_cart'];
        }
    }

    if(isset($_GET['pay_order'])) {

    }
?>