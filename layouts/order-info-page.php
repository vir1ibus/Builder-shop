<div class="d-flex flex-column w-100 h-100 justify-content-center align-content-center">
    <h1 class="text-primary text-center mt-5">Информация о заказе</h1>
    <table class="table">
        <tbody>
        <?php
            $sql = "SELECT * FROM order_history_has_item WHERE order_history_id = ${_GET['num']};";
            $result = mysqli_query($connect_db, $sql);
            if(mysqli_num_rows($result)) {
                while ($row = mysqli_fetch_array($result)) {
                    $sql = "SELECT * FROM item WHERE id = ${row['item_id']}";
                    $result_item = mysqli_query($connect_db, $sql);
                    $row_item = mysqli_fetch_array($result_item);
                    echo "
                        <tr>
                            <td class=\"row justify-content-center gx-1\">
                                <div class=\"col-lg-2 col-sm-12 row justify-content-center\"><img src=\"${row_item['image']}\"></div>
                                <div class=\"col-lg-6 col-sm-12 row justify-content-center align-content-center\"><a class=\"text-center\" href=\"index.php?page=iteminfopage&item=${row_item['id']}\">${row_item['name']}</a></div>
                                <div class=\"col-lg-2 col-sm-12 row justify-content-center align-content-center\">${row_item['price']} руб.</div>
                                <div class=\"col-lg-2 col-sm-12 row justify-content-center align-content-center\">
                                    Количество: ${row['count']}
                                </div>
                            </td>
                        </tr>
                    ";
                }
            }
            echo "
                <tr>
                    <td class=\"row gx-1\">
                        <h2 class=\"text-center text-primary\">Итого: ${_POST['sum']}</h2>
                    </td>
                </tr>
            "
        ?>
        </tbody>
    </table>
</div>