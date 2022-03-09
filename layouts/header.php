<?php
	if (!isset($_SESSION)) {
	    session_start();
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/all.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/header.css">
		<link rel="stylesheet" href="css/homepage.css">
		<link rel="stylesheet" href="css/itemspage.css">
		<link rel="stylesheet" href="css/iteminfopage.css">
		<link rel="stylesheet" href="css/footer.css">
		<title>Build store</title>
	</head>
	<body>
		<nav class="navbar navbar-expand-sm navbar-dark">
			<div class="container-fluid">
				<a class="navbar-brand" href="index.php?page=index">
					Build store
					<?php
						$sql = "SELECT img FROM service_images WHERE id=1;";
						$result = mysqli_query($connect_db, $sql);
						if(!$result){
							print("Произошла ошибка при выполнении запроса");
						} else {
							while($row = mysqli_fetch_array($result)) {
								echo "<img src=\"data:image/png;base64,${row['img']}\">";
							}
						}
					?>
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
											<tbody>
												<tr>
													<td><img src="images/items/Daewoo-DAST-7565.jpg"></td>
													<td><a href="index.php?page=iteminfopage">Снегоуборщик бензиновый Daewoo DAST 7565</a></td>
													<td>74990 руб.</td>
													<td>1</td>
												</tr>
												<tr>
													<td><img src="images/items/Daewoo-DAST-3000E.jpg"></td>
													<td><a href="index.php?page=iteminfopage">Снегоуборщик электрический Daewoo DAST 3000E</a></td>
													<td>21990 руб.</td>
													<td>1</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-primary">Оплата</button>
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Продолжить покупки</button>
									</div>
								</div>
							</div>
						</div>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="far fa-user"></i>
							</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								<li><a class="dropdown-item" href="#">Регистрация</a></li>
								<li><a class="dropdown-item" href="#">Авторизация</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
