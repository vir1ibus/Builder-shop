<section class="main-content">
	<div class="container-xxl">
		<div class="row">
			<?php 
				$sql = "SELECT * FROM item WHERE id=${_GET['item']};";
				$result = mysqli_query($connect_db, $sql);
				if(!$result){
					print("Произошла ошибка при выполнении запроса");
				} else {
					$row = mysqli_fetch_array($result);
						echo "
							<div class=\"col-lg-6 col-sm-12 text-center\">
								<h2>${row['name']}</h2>
								<img src=\"${row['image']}\" alt=\"...\" class=\"item-img\">
								<h3>${row['price']} руб.</h3>
								<button type=\"button\" onclick=\"add_item_into_cart('${_SERVER['HTTP_HOST']}', ${row['id']}, '${row['image']}', '${row['name']}', '${row['price']}')\" class=\"btn btn-primary\"><i class=\"fas fa-cart-plus\"></i></button>
								<button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\"><i class=\"far fa-credit-card\"></i></button>
							</div>
						";
				}
			?>

			<div class="col-lg-6 col-sm-12 mb-5 d-flex flex-column">
				<h2 class="align-self-center">Характеристики</h2>
				<ul class="list-group list-group-flush mt-2">
					<?php
						$sql = "SELECT characteristics.id, characteristics.name, item_has_characteristics.value FROM characteristics INNER JOIN item_has_characteristics ON item_has_characteristics.characteristics_id = characteristics.id AND item_has_characteristics.item_id = ${_GET['item']};";
						$result = mysqli_query($connect_db, $sql);
						if(!$result){
							print("Произошла ошибка при выполнении запроса");
						} else {
							while($row = mysqli_fetch_array($result)){
                                if(isset($_SESSION['role'])) {
                                    if ($_SESSION['role'] == 'ADMIN') {
                                        echo "
                                        <form action=\"service_scripts/control-admin.php\" method=\"GET\">
                                            <li class=\"list-group-item d-flex justify-content-between\">
                                                <input type=\"hidden\" name=\"item_id\" value=\"${_GET['item']}\">
                                                <div class=\"col-5\">${row['name']}</div>
                                                <div class=\"col-5\">${row['value']}</div>
                                                <div class=\"col-1\">
                                                    <button class=\"btn btn-primary\"  
                                                            name=\"del-char\" 
                                                            value=\"${row['id']}\" >
                                                        <i class=\"fas fa-minus-circle\"></i>
                                                    </button>
                                                </div>
                                            </li>
									    </form>
                                    ";
                                    } else {
                                        echo "
									        <li class=\"list-group-item d-flex justify-content-between\"><span>${row['name']}</span><span>${row['value']}</span></li>
								        ";
                                    }
                                } else {
                                    echo "
									    <li class=\"list-group-item d-flex justify-content-between\"><span>${row['name']}</span><span>${row['value']}</span></li>
								    ";
                                }
							}
						}
                        if(isset($_SESSION['role'])) {
                            if ($_SESSION['role'] == "ADMIN") {
                                echo "
                                    <form action=\"service_scripts/control-admin.php\" method=\"GET\">
                                        <input type=\"hidden\" name=\"item_id\" value=\"${_GET['item']}\">
                                        <li class=\"list-group-item d-flex justify-content-between\">
                                            <div class=\"col-5\">
                                                <input type=\"text\" class=\"form-control\" name=\"char-name\" placeholder=\"Название характеристики\">
                                            </div>
                                            <div class=\"col-5\">
                                                <input type=\"text\" class=\"form-control\" name=\"char-val\" placeholder=\"Значение характеристики\">
                                            </div>  
                                            <div class=\"col-1\">
                                                <button type=\"submit\" class=\"btn btn-primary\" name=\"add-char\"><i class=\"fas fa-plus-circle\"></i></button>
                                            </div> 
                                        </li>
                                    </form>
                                ";
                            }
                        }
					?>
				</ul>
			</div>
		</div>
	</div>
</section>