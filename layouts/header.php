<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/all.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/registration-page.css">
		<link rel="stylesheet" type="text/css" href="css/authorization-page.css">
		<link rel="stylesheet" type="text/css" href="css/confirm-registration-page.css">
		<link rel="stylesheet" type="text/css" href="css/not-found-page.css">
		<link rel="stylesheet" type="text/css" href="css/header.css">
		<link rel="stylesheet" type="text/css" href="css/home-page.css">
		<link rel="stylesheet" type="text/css" href="css/items-from-category-page.css">
		<link rel="stylesheet" type="text/css" href="css/item-info-page.css">
		<link rel="stylesheet" type="text/css" href="css/footer.css">
		<title>Build store</title>
	</head>
	<body>
		<nav class="navbar navbar-expand-sm navbar-dark">
			<div class="container-fluid">
				<a class="navbar-brand" href="index.php?page=index">
					Build store
					<img src="img/builders-icon.png">
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modal-cart"><i class="fas fa-shopping-cart"></i></a>
						</li>
						<div class="modal fade" id="modal-cart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header bg-primary text-white">
										<h5 class="modal-title" id="exampleModalLabel">Корзина</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<table class="table">
											<tbody id="#cart">
                                                <?php
                                                    if($_SESSION['authorized']) {
                                                        if(isset($_SESSION['cart'])) {
                                                            foreach ($_SESSION['cart'] as $id) {
                                                                $sql = "INSERT INTO user_has_item VALUES (${_SESSION['user_id']}, ${id})";
                                                                mysqli_query($connect_db, $sql);
                                                                unset($_SESSION['cart']);
                                                            }
                                                        }
                                                        $sql = "SELECT item_id FROM user_has_item WHERE user_id = ${_SESSION['user_id']}";
                                                        $result = mysqli_query($connect_db, $sql);
                                                        if($result && mysqli_num_rows($result) > 0) {
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                $sql = "SELECT id, name, image, price FROM item WHERE id = ${row['item_id']}";
                                                                $result_item = mysqli_query($connect_db, $sql);
                                                                $row = mysqli_fetch_array($result_item);
                                                                echo "
                                                                    <tr id=\"#cart_item_${row['id']}\" class=\"\">
                                                                        <td class=\"row justify-content-center g-1\">
                                                                            <div class=\"col-xl-3 col-lg-3 col-md-12 col-sm-12 row justify-content-center align-self-start\"><img style=\"object-fit: contain;\" src=\"${row['image']}\"></div>
                                                                            <div class=\"col-xl-5 col-lg-4 col-md-12 col-sm-12 row justify-content-center align-content-center\"><a class=\"text-center\" href=\"index.php?page=iteminfopage&item=${row['id']}\">${row['name']}</a></div>
                                                                            <div class=\"col-xl-2 col-lg-2 col-md-12 col-sm-12 row justify-content-center align-content-center\">${row['price']} руб.</div>
                                                                            <div class=\"col-xl-2 col-lg-3 col-md-12 col-sm-12 row justify-content-center align-content-center\">
                                                                                <input class=\"text-center w-50\" type=\"number\" min=\"0\" name=\"count\">
                                                                            </div>
                                                                            <div class=\"col-lg-1 col-sm-12 row justify-content-center align-content-center\">
                                                                                <button class=\"btn btn-secondary\" onclick=\"delete_item_from_cart('${_SERVER['HTTP_HOST']}', ${row['id']})\">
                                                                                        <i class=\"fa fa-trash\"></i>
                                                                                </button>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                ";
                                                            }
                                                        }
                                                    } elseif(isset($_SESSION['cart'])) {
                                                        foreach ($_SESSION['cart'] as $id) {
                                                            $sql = "SELECT id, name, image, price FROM item WHERE id = ${id}";
                                                            $result = mysqli_query($connect_db, $sql);
                                                            $row = mysqli_fetch_array($result);
                                                            echo "
                                                                    <tr id=\"#cart_item_${row['id']}\" class=\"\">
                                                                        <td class=\"row justify-content-center g-1\">
                                                                            <div class=\"col-xl-3 col-lg-3 col-md-12 col-sm-12 row justify-content-center align-self-start\"><img style=\"object-fit: contain;\" src=\"${row['image']}\"></div>
                                                                            <div class=\"col-xl-5 col-lg-4 col-md-12 col-sm-12 row justify-content-center align-content-center\"><a class=\"text-center\" href=\"index.php?page=iteminfopage&item=${row['id']}\">${row['name']}</a></div>
                                                                            <div class=\"col-xl-2 col-lg-2 col-md-12 col-sm-12 row justify-content-center align-content-center\">${row['price']} руб.</div>
                                                                            <div class=\"col-xl-2 col-lg-3 col-md-12 col-sm-12 row justify-content-center align-content-center\">
                                                                                <input class=\"text-center w-50\" type=\"number\" min=\"0\" value=\"0\" name=\"count\">
                                                                            </div>
                                                                            <div class=\"col-lg-1 col-sm-12 row justify-content-center align-content-center\">
                                                                                <button class=\"btn btn-secondary\" onclick=\"delete_item_from_cart('${_SERVER['HTTP_HOST']}', ${row['id']})\">
                                                                                        <i class=\"fa fa-trash\"></i>
                                                                                </button>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                ";
                                                        }
                                                    }
                                                ?>
											</tbody>
										</table>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-primary" >Оплата</button>
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Продолжить покупки</button>
									</div>
								</div>
							</div>
						</div>
                        <?php
                            $page = $_GET['page'] ?? 'index';

                            if ($page != 'personal-account-page' && $page != 'authorizationpage' && $page != 'registrationpage') {
                                echo "
                                <li class=\"nav-item dropdown\">
                                    <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                                        <i class=\"far fa-user\"></i>
                                    </a>
                            ";
                                if ($_SESSION['authorized']) {
                                    echo "
                                    <ul class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
                                        <form action=\"service_scripts/authorization.php\" method=\"GET\">
                                            <input type=\"hidden\" name=\"token\" value=\"${_SESSION['token']}\">
                                            <input type=\"hidden\" name=\"prev-page\" value=\"${_SERVER['HTTP_HOST']}${_SERVER['REQUEST_URI']}\">
                                            <li class=\"row text-center username-container\">
                                                <a href=\"index.php?page=personal-account-page\" class=\"btn btn-primary dropdown-item col-form-label\">${_SESSION['username']}</a>
                                            </li>
                                            <li class=\"row justify-content-center logout-container\">
                                                <button class=\"btn btn-secondary\" name=\"logout\">Выйти</button>
                                            </li>
                                        </form>
                                    </ul>";
                                } else {
                                    echo "
                                        <ul class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
                                            <li>
                                                <form action=\"index.php\" method=\"GET\">
                                                    <input type=\"hidden\" name=\"prev-page\" value=\"${_SERVER['HTTP_HOST']}${_SERVER['REQUEST_URI']}\">
                                                    <input type=\"hidden\" name=\"page\" value=\"registrationpage\">
                                                    <button type=\"submit\" class=\"dropdown-item\">Регистрация</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action=\"index.php\" method=\"GET\">
                                                    <input type=\"hidden\" name=\"prev-page\" value=\"${_SERVER['HTTP_HOST']}${_SERVER['REQUEST_URI']}\">
                                                    <input type=\"hidden\" name=\"page\" value=\"authorizationpage\">
                                                    <button type=\"submit\" class=\"dropdown-item\">Авторизация</button>
                                                </form>
                                            </li>
                                        </ul>";
                                }
                            }
                        ?>
						</li>
					</ul>
				</div>
			</div>
		</nav>
