<section class="main-content">
	<div class="container-fluid">
		<div class="row">
            <div class="col-xl-2 col-lg-2 col-sm-4">
                <?php
                    $sql = "SELECT * FROM `characteristics`WHERE `characteristics`.`id` IN (SELECT `characteristics_id` FROM `item_has_characteristics` WHERE item_id IN (SELECT id FROM item WHERE category_id = ${_GET['category']}));";
                    $result_name_char = mysqli_query($connect_db, $sql);
                    /*
                     * Закончить раскрывающиеся фильтры
                     * Добавить кнопку поиска
                     * При пустых фильтрах, убирать полностью колонку
                     * Реализовать применение фильтров (желательно с сохранением чекбоксов)
                     */
                    while($row_name_char = mysqli_fetch_array($result_name_char)) {
                        echo "<h5 class=\"text-sm-center\">${row_name_char['name']}</h5>";
                        $sql = "SELECT `value` FROM item_has_characteristics WHERE characteristics_id = ${row_name_char['id']}";
                        $result_val_char = mysqli_query($connect_db, $sql);
                        while($row_val_char = mysqli_fetch_array($result_val_char)) {
                            echo "
                                <div class=\"form-check\">
                                  <input class=\"form-check-input\" type=\"checkbox\" name=\"${row_name_char['id']}\" value=\"${row_val_char['value']}\">
                                  <label class=\"form-check-label\">
                                    ${row_val_char['value']}
                                  </label>
                                </div>
                            ";
                        }
                        echo "<br>";
                    }
                ?>
			</div>

<!--            <nav class="navbar-light navbar-expand-sm">-->
<!--                <div class="container-fluid">-->
<!--                    <button class="navbar-toggler"-->
<!--                            type="button"-->
<!--                            data-bs-toggle="collapse"-->
<!--                            data-bs-target="#navbarToggleExternalContent"-->
<!--                            aria-controls="navbarToggleExternalContent"-->
<!--                            aria-expanded="false">-->
<!--                        <span class="navbar-toggler-icon"></span>-->
<!--                    </button>-->
<!--                    <label>Фильтры поиска</label>-->
<!--                </div>-->
<!--            </nav>-->
<!---->
<!--            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">-->
<!--                <div class="list-group" id="list-tab" role="tablist">-->
<!--                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#" role="tab">Бензиновый</a>-->
<!--                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#" role="tab">Электрический</a>-->
<!--                </div>-->
<!--            </ul>-->

			<div class="col-xl-10 col-lg-10 col-sm-8">
				<?php
					echo "<form action=\"index.php\" method=\"GET\">
							<div class=\"d-flex search-box\">
									<input type=\"hidden\" name=\"page\" value=\"itemspage\">
									<input type=\"hidden\" name=\"category\" value=\"${_GET['category']}\">
									<input class=\"form-control me-2\" type=\"search\" name=\"search\" placeholder=\"Search\" aria-label=\"Search\">
									<button class=\"btn btn-primary\" type=\"submit\">
										<i class=\"fas fa-search\"></i>
									</button>
							</div>
						  </form>";
				?>
				<div class="container product-cards">
					<div class="row d-flex justify-content-center">
						<?php
							if(isset($_GET['search'])) {
								$search = mysqli_real_escape_string($connect_db, $_GET['search']);
								$sql = "SELECT * FROM item WHERE category_id=${_GET['category']} AND name LIKE '%${search}%';";
							} else {
								$sql = "SELECT * FROM item WHERE category_id=${_GET['category']};";
							}
							$result = mysqli_query($connect_db, $sql);
							if(!$result){
								echo "<p>Произошла ошибка при выполнении запроса</p>";
							} else {
								if(mysqli_num_rows($result) == 0) {
									echo "<div class=\"text-center\">
											<h3>Ничего не найдено</h3>
										  </div>";
								} else {
									while($row = mysqli_fetch_array($result)){
										echo "
											<div class=\"col-xl-4 col-lg-6 col-sm-12 d-flex justify-content-center\">
											    <form action=\"\">
                                                    <div class=\"product-card\">
                                                        <div class=\"product-thumb\">
                                                            <a href=\"index.php?page=iteminfopage&item=${row['id']}\"><img src=\"${row['image']}\" alt=\"\"></a>
                                                        </div>
                                                        <div class=\"product-details\">
                                                            <h5><a href=\"index.php?page=iteminfopage&item=${row['id']}\">${row['name']}</a></h5>
                                                            <div class=\"product-bottom-details d-flex justify-content-between\">
                                                                <div class=\"product-price\">
                                                                    ${row['price']} руб.
                                                                </div>
                                                                <div class=\"product-links\">
                                                                    <a href=\"#\"><button type=\"submit\" class=\"fas fa-shopping-cart\"></button></a>
                                                                    <a href=\"#\"><button class=\"far fa-heart\"></button></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
												</form>
											</div>
										";
									}
								}
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>