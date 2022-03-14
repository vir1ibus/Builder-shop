<?php
	require_once('controller-database.php');
	session_start();
	if(isset($_POST['confrim'])) {
		if($_SESSION['code'] == $_POST['confrim-code']){
			$sql = "INSERT INTO user (username, password, email) VALUES ('${_SESSION['username-reg']}', '".hash('sha512', $_SESSION['password-reg'])."', '${_SESSION['email-reg']}');";
			if(mysqli_query($connect_db, $sql)){
				unset($_SESSION['username-reg'], $_SESSION['email-reg'], $_SESSION['password-reg'], $_POST['confrim']);
				header("Location: http://builder-shop/index.php?page=authorizationpage");
				exit;
			} else {
				unset($_SESSION['username-reg'], $_SESSION['email-reg'], $_SESSION['password-reg'], $_POST['confrim-reg']);
				$_SESSION['error'] = 'error_db';
				header("Location: http://builder-shop/index.php?page=registrationpage");
			}
		} else {
			$_SESSION['error'] = 'error_db';
			header("Location: http://builder-shop/index.php?page=registrationpage");
			exit;
		}
	} else {
		$username = $_POST['username'];
		$email = $_POST['user-email'];
		$password = $_POST['user-password'];

		if (!preg_match('/[A-Za-z0-9]{3,}/', $username)){
			$_SESSION['error'] = 'error_username';
			header("Location: http://builder-shop/index.php?page=registrationpage");
			unset($_POST['registration']);
			exit;
		} else if (!preg_match('/[A-Za-z0-9]{4,}@[A-Za-z]{3,}.[A-Za-z]{2,}/', $email)){
			$_SESSION['error'] = 'error_email';
			header("Location: http://builder-shop/index.php?page=registrationpage");
			unset($_POST['registration']);
			exit;
		} else if (strlen($password) < 6){
			$_SESSION['error'] = 'error_lenght_password';
			header("Location: http://builder-shop/index.php?page=registrationpage");
			unset($_POST['registration']);
			exit;
		} else if ($password != $_POST['user-retry-password']){
			$_SESSION['error'] = 'error_match_password';
			header("Location: http://builder-shop/index.php?page=registrationpage");
			unset($_POST['registration']);
			exit;
		} else {
			$sql = "SELECT * FROM user WHERE username = ${username}";
			$result = mysqli_query($connect_db, $sql);
			if($result) {
				$_SESSION['error'] = 'error_username_exists';
				header("Location: http://builder-shop/index.php?page=registrationpage");
				unset($_POST['registration']);
				exit;
			}
			$sql = "SELECT * FROM user WHERE email = ${email}";
			$result = mysqli_query($connect_db, $sql);
			if($result) {
				$_SESSION['error'] = 'error_email_exists';
				header("Location: http://builder-shop/index.php?page=registrationpage");
				unset($_POST['registration']);
				exit;
			}
			$subject = "Подтверждение аккаунта Builder shop";
			$code = mt_rand(1000, 9999);
			$message = "Ваш код подтверждения аккаунта: ".$code.".";
			$headers = array(
			    'From' => 'builder-shop-ussr@mail.ru',
			    'Reply-To' => 'builder-shop-ussr@mail.ru',
			    'X-Mailer' => 'PHP/' . phpversion(),
			    'Content-type' => 'text/plain',
			    'Charset' => 'utf-8'
			);

			if(mail($email, $subject, $message, $headers)){
				$_SESSION['code'] = $code;
				$_SESSION['username-reg'] = mysqli_real_escape_string($connect_db, $username);
				$_SESSION['email-reg']	  = mysqli_real_escape_string($connect_db, $email);
				$_SESSION['password-reg'] = mysqli_real_escape_string($connect_db, $password);
				header("Location: http://builder-shop/index.php?page=confrimregistration");
				unset($_POST['registration']);
				exit;
			} else {
				header("Location: http://builder-shop/index.php?page=registrationpage&error=error_send_mail");
				unset($_POST['registration']);
				exit;
			}
		}
	}
?>