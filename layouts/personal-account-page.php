<?php
    session_start();
    $sql = "SELECT * FROM user WHERE id = ${_SESSION['user_id']}";
    $row = mysqli_fetch_array(mysqli_query($connect_db, $sql));
?>
<div class="row mt-3 g-2">
    <h1 class="text-primary text-center">Личный кабинет</h1>
</div>
<section class="container flex-grow-1 col-xxl-12 py-2">
    <div class="row g-5">
        <div class="col-lg-6 col-md-12">
            <h4 class="mb-3">Персональные данные</h4>
            <form action="service_scripts/authorization.php" METHOD="GET">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="login" class="form-label">
                            Имя пользователя
                        </label>
                        <input type="text" class="form-control" id="login" readonly value="<?php echo $row['username']; ?>">
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">
                            Email
                        </label>
                        <input type="email" class="form-control" id="email" readonly value="<?php echo $row['email']; ?>">
                    </div>
                    <?php
                        if($_SESSION['role'] != 'USER') {
                            echo "
                                <div class=\"col-12\">
                                    <label for=\"role\" class=\"form-label\">
                                        Role
                                    </label>
                                    <input type=\"role\" class=\"form-control\" id=\"role\" readonly value=\"${_SESSION['role']}\">
                                </div>
                            ";
                        }
                    ?>
                </div>
                <button class="btn btn-secondary mt-3" name="logout">
                    Выйти
                </button>
            </form>
        </div>
        <div class="col-lg-6 col-md-12">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">
                    История заказов
                </span>
            </h4>
            <table class="table">
                <?php
                    $sql = "SELECT * FROM order_history WHERE user_id = ${_SESSION['user_id']};";
                    $result = mysqli_query($connect_db, $sql);
                    if (mysqli_num_rows($result)) {
                        while ($row = mysqli_fetch_array($result)) {
                            echo "
                                <tr>
                                    <td>
                                        <a href=\"index.php?page=order-info-page&num=${row['id']}\">
                                            <div class=\"row justify-content-center gx-5\">
                                                <div class=\"col-4 row justify-content-center align-content-center\">Заказ #${row['id']}</div>
                                                <div class=\"col-4 row justify-content-center align-content-center\">${row['sum']} руб.</div>
                                                <div class=\"col-4 row justify-content-center align-content-center\">
                                                    ".date_format(date_create($row['transaction_date']), "d.m.Y H:i")."
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                            ";
                        }
                    } else {
                        echo "
                            <tr>
                                <td>
                                    <h5>Заказов нет</h5>
                                </td>
                            </tr>
                        ";
                    }
                ?>
            </table>
        </div>
    </div>
    <?php
        if($_SESSION['role'] == 'ADMIN') {
            require ('layouts/admin-panel.php');
        }
    ?>

</section>