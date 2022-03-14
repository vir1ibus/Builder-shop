<section class="main-content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-2">
				<!-- <div class="list-group" id="list-tab" role="tablist">
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#" role="tab">Бензиновый</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#" role="tab">Электрический</a>
				</div> -->
			</div>
			<div class="col-lg-10">
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
											<div class=\"col-xl-4 col-lg-6 col-md-6 col-sm-12 d-flex justify-content-center\">
												<div class=\"product-card\">
													<div class=\"product-thumb\">
														<a href=\"#\"><img src=\"${row['image']}\" alt=\"\"></a>
													</div>
													<div class=\"product-details\">
														<h5><a href=\"index.php?page=iteminfopage&item=${row['id']}\">${row['name']}</a></h5>
														<div class=\"product-bottom-details d-flex justify-content-between\">
															<div class=\"product-price\">
																${row['price']} руб.
															</div>
															<div class=\"product-links\">
																<a href=\"#\"><i class=\"fas fa-shopping-cart\"></i></a>
																<a href=\"#\"><i class=\"far fa-heart\"></i></a>
															</div>
														</div>
													</div>
												</div>
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