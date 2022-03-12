
<?php
	require_once('controllerDatabase.php');
	session_start();
	if(isset($_POST['confrim'])) {
		if($_SESSION['code'] == $_POST['confrim-code']){
			$sql = "INSERT INTO user (username, password, email) VALUES ('${_SESSION['username']}', '".hash('sha512', $_SESSION['password'])."', '${_SESSION['email']}');";
			$result = mysqli_query($connect_db, $sql);
			if($result){
				unset($_SESSION['username'], $_SESSION['email'], $_SESSION['password']);
				header("Location: index.php");
				exit;
			}
		} else {
			header("Location: index.php?".$_SESSION['code']."&".$_POST['confrim-code']);
			exit;
		}
	} else {
		
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['email']	  = $_POST['user-email'];
		$_SESSION['password'] = $_POST['user-password'];

		if (!preg_match('/[A-Za-z0-9]{3,}/', $_POST['username'])){
			$_SESSION['error'] = 'error_username';
			header("Location: index.php?page=registrationpage");
			exit;
		} else if (!preg_match('/[A-Za-z0-9]{4,}@[A-Za-z]{3,}.[A-Za-z]{2,}/', $_POST['user-email'])){
			$_SESSION['error'] = 'error_email';
			header("Location: index.php?page=registrationpage");
			exit;
		} else if (strlen($_POST['user-password']) < 6){
			$_SESSION['error'] = 'error_lenght_password';
			header("Location: index.php?page=registrationpage");
			exit;
		} else if ($_POST['user-password'] != $_POST['user-retry-password']){
			$_SESSION['error'] = 'error_match_password';
			header("Location: index.php?page=registrationpage");
			exit;
		} else {
			$sql = "SELECT * FROM user WHERE username = ${_POST['username']}";
			$result = mysqli_query($connect_db, $sql);
			if($result) {
				$_SESSION['error'] = 'error_username_exists';
				header("Location: index.php?page=registrationpage");
				exit;
			}
			$sql = "SELECT * FROM user WHERE email = ${_POST['user-email']}";
			$result = mysqli_query($connect_db, $sql);
			if($result) {
				$_SESSION['error'] = 'error_email_exists';
				header("Location: index.php?page=registrationpage");
				exit;
			}
			$to = $_POST['user-email'];
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
			
			if(mail($to, $subject, $message, $headers)){
				$_SESSION['code'] = $code;
				header("Location: index.php?page=confrimregistration");
				exit;
			} else {
				header("Location: index.php?page=registrationpage&error=error_send_mail");
				exit;
			}
		}
	}
?>