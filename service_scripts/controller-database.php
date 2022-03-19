<?php
	
	$address_db = "localhost";
	$login_db = "root";
	$password_db = "root";
	$name_db = "builder_shop";

	$connect_db = mysqli_connect($address_db, $login_db, $password_db, $name_db);

	if (!$connect_db) {
		print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
		exit;
	}

?>