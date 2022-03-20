<?php
    if(isset($_GET['prev-page'])) {
        $_SESSION['prev-page'] = $_GET['prev-page'];
    } else {
        $_SESSION['prev-page'] = "/index.php?page=index";
    }
?>

<div class="authorization-container">
	<form action="service_scripts/authorization.php" method="GET">
		<div class="row mb-2">
			<label for="username" class="col-md-4 col-form-label">Имя пользователя</label>
			<div class="col-md-8">
				<input type="text" class="form-control" name="username" placeholder="Username" required>
			</div>
		</div>
		<div class="row mb-2">
			<label for="password" class="col-md-4 col-form-label ">Пароль</label>
			<div class="col-md-8">
				<input type="password" class="form-control" name="password" placeholder="Password" required>
			</div>
		</div>
		<div class="row mb-2">
			<label for="login" class="col-md-4 col-form-label p-0 m-0"></label>
			<div class="row col-md-8 justify-content-center">
				<button type="submit" class="btn btn-primary w-75" name="login">Войти</button>
			</div>
		</div>
        <div class="row mb-2">
            <label for="login" class="col-md-4 col-form-label p-0 m-0"></label>
            <div class="row col-md-8 justify-content-center">
                <a class="btn btn-secondary w-75" href="index.php?page=registrationpage">Ещё нет аккаунта?</a>
            </div>
        </div>
		<?php
			if(isset($_SESSION['error'])) {
				switch($_SESSION['error']){
					case 'error_login':
						echo "
							<div class=\"row mb-2 text-center\">
								<label class=\"col-form-label\">Неверный логин или пароль</label>
							</div>";
					break;
					case 'error_db':
						echo "
							<div class=\"row mb-2 text-center\">
								<label class=\"col-form-label\">Ошибка сервера</label>
							</div>";
					break;
				}
				$_SESSION['error'] = '';
			}
		?>
	</form>
</div>