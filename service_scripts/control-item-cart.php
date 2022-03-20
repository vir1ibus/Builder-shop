<?php
    session_start();
    require_once('controller-database.php');
    if(isset($_GET['delete_item_from_cart'])) {
        if($_SESSION['authorized']) {
            $sql = "DELETE FROM user_has_item WHERE user_id = ${_SESSION['user_id']} AND item_id = ${_GET['delete_item_from_cart']};";
            if(!mysqli_query($connect_db, $sql)) {
                unset($_SESSION['cart'][array_search($_GET['delete_item_from_cart'], $_SESSION['cart'])]);
            }
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
        if($_SESSION['authorized']) {
            if(isset($_GET['item_id'], $_GET['item_count'])) {
                $items = array_combine($_GET['item_id'], $_GET['item_count']);
                $sum = 0;
                foreach ($items as $id => $count) {
                    $sql = "SELECT price FROM item WHERE id = ${id};";
                    $result = mysqli_query($connect_db, $sql);
                    $row = mysqli_fetch_array($result);
                    $sum += $row['price'] * $count;
                }
                $sql = "INSERT INTO order_history (user_id, sum, transaction_date) VALUES (${_SESSION['user_id']}, ${sum},'" . date_format(date_create(), "Y-m-d H:i:s") . "');";
                mysqli_query($connect_db, $sql);
                $order_id = mysqli_insert_id($connect_db);
                foreach ($items as $id => $count) {
                    $sql = "INSERT INTO order_history_has_item VALUES (${order_id}, ${id}, ${count})";
                    if (mysqli_query($connect_db, $sql)) {
                        $sql = "DELETE FROM user_has_item WHERE user_id = ${_SESSION['user_id']} AND item_id = ${id};";
                        mysqli_query($connect_db, $sql);
                    }
                }
                header("Location: http://" . $_SERVER['HTTP_HOST'] . "/index.php?page=order-info-page&num=${order_id}");
            } else {
                header("Location: http://" . $_SERVER['HTTP_HOST'] . "/index.php?page=index");
            }
        } else {
            header("Location: http://".$_SERVER['HTTP_HOST']."/index.php?page=authorizationpage");
        }
        exit;
    }
?>