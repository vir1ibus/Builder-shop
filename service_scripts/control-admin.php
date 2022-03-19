<?php
    require_once('controller-database.php');
    session_start();
    $sql = "SELECT id FROM role WHERE name = 'ADMIN'";
    $result = mysqli_query($connect_db, $sql);
    $row = mysqli_fetch_array($result);
    $admin_role_id = $row['id'];
    $sql = "SELECT role_id FROM user WHERE id = ${_SESSION['user_id']}";
    $result = mysqli_query($connect_db, $sql);
    $row = mysqli_fetch_array($result);

    $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', ' ');
    $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya', '-');

if($row['role_id'] != $admin_role_id) {
        exit;
    }

    function return_result_create($result) {
        $_SESSION['error_create'] = $result;
        header("Location: http://${_SERVER['HTTP_HOST']}/index.php?page=personal-account-page");
        exit;
    }

    function return_result_delete($result) {
        $_SESSION['error_delete'] = $result;
        header("Location: http://${_SERVER['HTTP_HOST']}/index.php?page=personal-account-page");
        exit;
    }

    function return_result_add_item($result) {
        $_SESSION['error_add_item'] = $result;
        header("Location: http://${_SERVER['HTTP_HOST']}/index.php?page=personal-account-page");
        exit;
    }

    if(isset($_POST['create-category'])) {
        if($_FILES['image-category']['type'] != 'image/png' && $_FILES['image-category']['type'] != 'image/jpeg') {
            return_result_create('file_type_error');
        }

        $filepath = "../img/category/".strtr(mb_strtolower($_POST['name-category']), array_combine($rus, $lat)).".".pathinfo($_FILES['image-category']['name'], PATHINFO_EXTENSION);;
        if(move_uploaded_file($_FILES['image-category']['tmp_name'], $filepath)){
            $sql = "INSERT INTO category (name, image) VALUES ('${_POST['name-category']}','${filepath}')";
            if(mysqli_query($connect_db, $sql)) {
                return_result_create("category_created");
            } else {
                return_result_create(mysqli_error($connect_db));
            }
        }
    }

    if(isset($_POST['delete-category'])) {
        $sql = "SELECT image FROM category WHERE id = ${_POST['category']};";
        $result = mysqli_query($connect_db, $sql);
        $row = mysqli_fetch_array($result);
        try {
            unlink($row['image']);
            $sql = "DELETE FROM category WHERE id = ${_POST['category']};";
            if (mysqli_query($connect_db, $sql)) {
                return_result_delete("category_delete");
            } else {
                return_result_delete(mysqli_error($connect_db));
            }
        } catch (Exception $e) {
            return_result_delete($e);
        }
    }

    if(isset($_POST['add-item'])) {
        if($_FILES['image-item']['type'] != 'image/png' && $_FILES['image-item']['type'] != 'image/jpeg') {
            return_result_add_item('file_type_error');
        }

        $filepath = "../img/item/".strtr(mb_strtolower($_POST['name-item']), array_combine($rus, $lat)).".".pathinfo($_FILES['image-item']['name'], PATHINFO_EXTENSION);;
        if(move_uploaded_file($_FILES['image-item']['tmp_name'], $filepath)) {
            if(isset($_POST['description-item'])) {
                $sql = "INSERT INTO item (name, image, price, description, category_id) VALUES ('${_POST['name-item']}', '${filepath}', ${_POST['price-item']}, '${_POST['description-item']}', ${_POST['category']});";
            } else {
                $sql = "INSERT INTO item (name, image, price, category_id) VALUES ('${_POST['name-item']}', '${filepath}', ${_POST['price-item']}, ${_POST['category']});";
            }

            if (mysqli_query($connect_db, $sql)) {
                return_result_add_item("add_item");
            } else {
                return_result_add_item(mysqli_error($connect_db));
            }
        }
    }
