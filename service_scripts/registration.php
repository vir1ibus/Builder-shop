<?php
	require_once('controller-database.php');
	session_start();
	if(isset($_POST['confrim'])) {
		if($_SESSION['code'] == $_POST['confrim-code']){
			$sql = "INSERT INTO user (username, password, email) VALUES ('".mysqli_escape_string($connect_db, $_SESSION['email-reg'])."', '".hash('sha512', $_SESSION['password-reg'])."', '".mysqli_escape_string($connect_db, $_SESSION['email-reg'])."');";
			if(mysqli_query($connect_db, $sql)){
				unset($_SESSION['username-reg'], $_SESSION['email-reg'], $_SESSION['password-reg'], $_POST['confrim']);
				header("Location: http://".$_SERVER['HTTP_HOST']."/index.php?page=authorizationpage");
				exit;
			} else {
				unset($_SESSION['username-reg'], $_SESSION['email-reg'], $_SESSION['password-reg'], $_POST['confrim-reg']);
				$_SESSION['error'] = 'error_db';
				header("Location: http://".$_SERVER['HTTP_HOST']."/index.php?page=registrationpage");
			}
		} else {
			$_SESSION['error'] = 'error_db';
			header("Location: http://".$_SERVER['HTTP_HOST']."/index.php?page=registrationpage");
			exit;
		}
	} else {
        $_SESSION['username-reg'] = $_POST['username'];
        $_SESSION['email-reg'] = $_POST['user-email'];
        $_SESSION['password-reg'] = $_POST['user-password'];

		if (!preg_match('/[A-Za-z0-9]{3,}/', $_SESSION['username-reg'])){
			$_SESSION['error'] = 'error_username';
			header("Location: http://".$_SERVER['HTTP_HOST']."/index.php?page=registrationpage");
			exit;
		} else if (!preg_match('/[A-Za-z0-9]{4,}@[A-Za-z0-9]{3,}.[A-Za-z]{2,}/', $_SESSION['email-reg'])){
			$_SESSION['error'] = 'error_email';
			header("Location: http://".$_SERVER['HTTP_HOST']."/index.php?page=registrationpage");
			exit;
		} else if (strlen($_SESSION['password-reg']) < 6){
			$_SESSION['error'] = 'error_length_password';
			header("Location: http://".$_SERVER['HTTP_HOST']."/index.php?page=registrationpage");
			exit;
		} else if ($_SESSION['password-reg'] != mysqli_escape_string($connect_db, $_POST['user-retry-password'])){
			$_SESSION['error'] = 'error_match_password';
			header("Location: http://".$_SERVER['HTTP_HOST']."/index.php?page=registrationpage");
			exit;
		} else {
            print mysqli_escape_string($connect_db, $_SESSION['username-reg']);
			$sql = "SELECT * FROM user WHERE username = '".mysqli_escape_string($connect_db, $_SESSION['username-reg'])."';";
			$result = mysqli_query($connect_db, $sql);
			if(mysqli_num_rows($result)) {
				$_SESSION['error'] = 'error_username_exists';
				header("Location: http://".$_SERVER['HTTP_HOST']."/index.php?page=registrationpage");
				exit;
			}
			$sql = "SELECT * FROM user WHERE email = '".mysqli_escape_string($connect_db, $_SESSION['email-reg'])."';";
			$result = mysqli_query($connect_db, $sql);
			if(mysqli_num_rows($result)) {
				$_SESSION['error'] = 'error_email_exists';
				header("Location: http://".$_SERVER['HTTP_HOST']."/index.php?page=registrationpage");
				exit;
			}
			$subject = "Подтверждение аккаунта Builder shop";
			$code = mt_rand(1000, 9999);
			$message = "Ваш код подтверждения аккаунта: ".$code.".";
			$headers = array(
			    'From' => 'builder.shop.ussr@gmail.com',
			    'Reply-To' => 'builder.shop.ussr@gmail.com',
			    'X-Mailer' => 'PHP/'.phpversion(),
			    'Content-type' => 'text/plain',
			    'Charset' => 'utf-8'
			);

			if(mail($_SESSION['email-reg'], $subject, $message, $headers)){
				$_SESSION['code'] = $code;
				header("Location: http://".$_SERVER['HTTP_HOST']."/index.php?page=confrimregistration");
				unset($_POST['registration']);
				exit;
			} else {
				header("Location: http://".$_SERVER['HTTP_HOST']."/index.php?page=registrationpage&error=error_send_mail");
				exit;
			}
		}
	}
?>