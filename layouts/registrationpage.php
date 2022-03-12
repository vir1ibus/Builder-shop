<?php
	unset($_POST['registration']);
?>
	
<div class="registration-container">
	<form action="validation_registration.php" method="POST">
		<div class="row mb-2">
			<label for="username" class="col-md-4 col-form-label">Имя пользователя</label>
			<div class="col-md-8">
				<input type="text" class="form-control" name="username" placeholder="Username" required>
			</div>
		</div>
		<div class="row mb-2">
			<label for="user-email" class="col-md-4 col-form-label">Почта</label>
			<div class="col-md-8">
				<input type="text" class="form-control" name="user-email" placeholder="test@mail.ru" required>
			</div>
		</div>
		<div class="row mb-2">
			<label for="user-password" class="col-md-4 col-form-label">Пароль</label>
			<div class="col-md-8">
				<input type="password" class="form-control" name="user-password" placeholder="Password" required>
			</div>
		</div>
		<div class="row mb-2">
			<label for="user-retry-password" class="col-md-4 col-form-label">Повторите пароль</label>
			<div class="col-md-8">
				<input type="password" class="form-control" name="user-retry-password" placeholder="Retry password" required>
			</div>
		</div>
		<div class="row mb-2">
			<label for="registration" class="col-md-4 col-form-label p-0 m-0"></label>
			<div class="row col-md-8 justify-content-center">
				<button type="submit" class="btn btn-primary w-75" name="registration">Зарегистрироваться</button>
			</div>
		</div>
		<?php
			if(isset($_SESSION['error'])) {
				switch($_SESSION['error']){
					case 'error_username':
						echo "
							<div class=\"row mb-2 justify-content-center\">
								<label class=\"col-md-4 col-form-label\">Некорректное имя пользователя (Более 3-х символов, латиница).</label>
							</div>";
					break;
					case 'error_email':
						echo "
							<div class=\"row mb-2 justify-content-center\">
								<label class=\"col-md-4 col-form-label\">Некорректная почта.</label>
							</div>";
					break;
					case 'error_lenght_password':
						echo "
							<div class=\"row mb-2 justify-content-center\">
								<label class=\"col-md-4 col-form-label\">Длина пароля должна быть не менее 8 символов.</label>
							</div>";
					break;
					case 'error_match_password':
						echo "
							<div class=\"row mb-2 justify-content-center\">
								<label class=\"col-md-4 col-form-label\">Пароли не совпадают.</label>
							</div>";
					break;
					case 'error_send_mail':
						echo "
							<div class=\"row mb-2 justify-content-center\">
								<label class=\"col-md-4 col-form-label\">Проблема с отправкой письма.</label>
							</div>";
					break;
					case 'error_confrim_code':
						echo "
							<div class=\"row mb-2 justify-content-center\">
								<label class=\"col-md-4 col-form-label\">Код подтверждения неверный.</label>
							</div>";
					break;
					case 'error_username_exists':
						echo "
							<div class=\"row mb-2 justify-content-center\">
								<label class=\"col-md-4 col-form-label\">Имя пользователя занято.</label>
							</div>";
					break;
					case 'error_email_exists':
						echo "
							<div class=\"row mb-2 justify-content-center\">
								<label class=\"col-md-4 col-form-label\">Электронная почта уже зарегистрирована.</label>
							</div>";
					break;
				}
				$_SESSION['error'] = '';
			}
		?>
	</form>
</div>