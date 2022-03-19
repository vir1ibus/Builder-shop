<div class="row g-2 mt-1">
    <h1 class="text-primary text-center">Панель управления администратора</h1>
</div>
    <div class="row g-5 mt-1">
            <div class="col-lg-6 col-12">
                <form enctype="multipart/form-data" action="service_scripts/control-admin.php" METHOD="POST">
                    <div class="row mb-2">
                        <label for="name-category" class="col-md-4 col-form-label">Название категории</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="name-category" placeholder="Название категории" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="name-category" class="col-md-4 col-form-label">Изображение категории</label>
                        <div class="col-md-8">
                            <input type="file" class="form-control" name="image-category" placeholder="image" required>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <button class="btn btn-primary w-50" name="create-category">Создать категорию</button>
                    </div>
                    <?php
                        if(isset($_SESSION['error_create'])) {
                            switch ($_SESSION['error_create']) {
                                case 'file_type_error':
                                    echo "
                                        <div class=\"row\">
                                            <label class=\"col-form-label text-center\">Ошибка типа изображения (jpg, png)</label>
                                        </div>
                                    ";
                                break;
                                case 'category_created':
                                    echo "
                                        <div class=\"row\">
                                            <label class=\"col-form-label text-center\">Категория успешно создана</label>
                                        </div>
                                    ";
                                break;

                                default:
                                    echo "
                                        <div class=\"row\">
                                            <label class=\"col-form-label text-center\">${_SESSION['error_create']}</label>
                                        </div>
                                    ";
                                break;
                            }
                            unset($_SESSION['error_create']);
                        }
                    ?>
                </form>
                <form enctype="multipart/form-data" action="service_scripts/control-admin.php" METHOD="POST">
                    <div class="row mb-2">
                        <label for="name-category" class="col-md-4 col-form-label">Удаление категории</label>
                        <select class="form-control" name="category">
                            <option selected>Выберите категорию</option>
                            <?php
                                $sql = "SELECT * FROM category;";
                                $result = mysqli_query($connect_db, $sql);
                                if(mysqli_num_rows($result)) {
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<option value=\"${row['id']}\">${row['name']} - ${row['id']}</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="row justify-content-center">
                        <button class="btn btn-primary w-50" name="delete-category">Удалить категорию</button>
                    </div>
                    <?php
                    if(isset($_SESSION['error_delete'])) {
                        switch ($_SESSION['error_delete']) {
                            case 'category_deleted':
                                echo "
                                    <div class=\"row\">
                                        <label class=\"col-form-label text-center\">Категория успешно удалена</label>
                                    </div>
                                ";
                                break;
                            default:
                                echo "
                                    <div class=\"row\">
                                        <label class=\"col-form-label text-center\">${_SESSION['error_delete']}</label>
                                    </div>
                                ";
                                break;
                        }
                        unset($_SESSION['error_delete']);
                    }
                    ?>
                </form>
            </div>
        <div class="col-lg-6 col-12">
            <form enctype="multipart/form-data" action="service_scripts/control-admin.php" METHOD="POST">
                <div class="row mb-2">
                    <label for="name-item" class="col-md-4 col-form-label">Название товара</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="name-item" placeholder="Название товара" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="image-item" class="col-md-4 col-form-label">Изображение товара</label>
                    <div class="col-md-8">
                        <input type="file" class="form-control" name="image-item" placeholder="image" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="price-item" class="col-md-4 col-form-label">Цена</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="price-item" placeholder="Цена товара" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="description-item" class="col-md-4 col-form-label">Описание товара</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="description-item" placeholder="Описание товара">
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="category" class="col-md-4 col-form-label">Категория товара</label>
                    <select class="form-control" name="category">
                        <option selected>Выберите категорию</option>
                        <?php
                        $sql = "SELECT * FROM category;";
                        $result = mysqli_query($connect_db, $sql);
                        if(mysqli_num_rows($result)) {
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value=\"${row['id']}\">${row['name']} - ${row['id']}</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="row justify-content-center">
                    <button class="btn btn-primary w-50" name="add-item">Добавить товар</button>
                </div>
                <?php
                if(isset($_SESSION['error_add_item'])) {
                    switch ($_SESSION['error_add_item']) {
                        case 'add_item':
                            echo "
                                <div class=\"row\">
                                    <label class=\"col-form-label text-center\">Товар успешно добавлен</label>
                                </div>
                            ";
                            break;
                        default:
                            echo "
                                <div class=\"row\">
                                    <label class=\"col-form-label text-center\">${_SESSION['error_add_item']}</label>
                                </div>
                            ";
                            break;
                    }
                    unset($_SESSION['error_add_item']);
                }
                ?>
            </form>
        </div>
    </div>