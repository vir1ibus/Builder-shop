<?php
	unset($_POST['registration']);
?>
	
<div class="registration-container">
	<form action="service_scripts/registration.php" method="POST">
        <?php
            if(isset($_SESSION['username-reg'], $_SESSION['email-reg'])) {
                echo "
                    <div class=\"row mb-2\">
                        <label for=\"username\" class=\"col-md-4 col-form-label\">Имя пользователя</label>
                        <div class=\"col-md-8\">
                            <input type=\"text\" class=\"form-control\" name=\"username\" placeholder=\"Username\" value=\"${_SESSION['username-reg']}\" required>
                        </div>
                    </div>
                    <div class=\"row mb-2\">
                        <label for=\"user-email\" class=\"col-md-4 col-form-label\">Почта</label>
                        <div class=\"col-md-8\">
                            <input type=\"text\" class=\"form-control\" name=\"user-email\" placeholder=\"test@mail.ru\" value=\"${_SESSION['email-reg']}\" required>
                        </div>
                    </div>
                ";
                unset($_SESSION['username-reg'], $_SESSION['email-reg'], $_SESSION['password-reg']);
            } else {
                echo "
                    <div class=\"row mb-2\">
                        <label for=\"username\" class=\"col-md-4 col-form-label\">Имя пользователя</label>
                        <div class=\"col-md-8\">
                            <input type=\"text\" class=\"form-control\" name=\"username\" placeholder=\"Username\" required>
                        </div>
                    </div>
                    <div class=\"row mb-2\">
                        <label for=\"user-email\" class=\"col-md-4 col-form-label\">Почта</label>
                        <div class=\"col-md-8\">
                            <input type=\"text\" class=\"form-control\" name=\"user-email\" placeholder=\"test@mail.ru\" required>
                        </div>
                    </div>
                ";
            }
        ?>
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
							<div class=\"row mb-2 text-center\">
								<label class=\"col-form-label\">Некорректное имя пользователя (Более 3-х символов, латиница)</label>
							</div>";
					break;
					case 'error_email':
						echo "
							<div class=\"row mb-2 text-center\">
								<label class=\"col-form-label\">Некорректная почта</label>
							</div>";
					break;
					case 'error_length_password':
						echo "
							<div class=\"row mb-2 text-center\">
								<label class=\"col-form-label\">Длина пароля должна быть не менее 8 символов</label>
							</div>";
					break;
					case 'error_match_password':
						echo "
							<div class=\"row mb-2 text-center\">
								<label class=\"col-form-label\">Пароли не совпадают</label>
							</div>";
					break;
					case 'error_send_mail':
						echo "
							<div class=\"row mb-2 text-center\">
								<label class=\"col-form-label\">Проблема с отправкой письма</label>
							</div>";
					break;
					case 'error_confrim_code':
						echo "
							<div class=\"row mb-2 text-center\">
								<label class=\"col-form-label\">Код подтверждения неверный</label>
							</div>";
					break;
					case 'error_username_exists':
						echo "
							<div class=\"row mb-2 text-center\">
								<label class=\"col-form-label\">Имя пользователя занято</label>
							</div>";
					break;
					case 'error_email_exists':
						echo "
							<div class=\"row mb-2 text-center\">
								<label class=\"col-form-label\">Электронная почта уже зарегистрирована</label>
							</div>";
					break;
					case 'error_db':
						echo "
							<div class=\"row mb-2 text-center\">
								<label class=\"col-form-label\">Ошибка сервера</label>
							</div>";
					break;
				}
				unset($_SESSION['error']);
			}
		?>
	</form>
</div>