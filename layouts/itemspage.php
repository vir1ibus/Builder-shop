<section class="main-content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-2">
				<div class="list-group" id="list-tab" role="tablist">
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#" role="tab">Бензиновый</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#" role="tab">Электрический</a>
				</div>
			</div>
			<div class="col-lg-10">
				<div class="d-flex search-box">
					<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success" type="submit">
					<i class="fas fa-search"></i>
					</button>
				</div>
				<div class="container product-cards">
					<div class="row d-flex justify-content-center">
						<?php
							$sql = "SELECT * FROM item WHERE category_id=${_GET['category']};";
							$result = mysqli_query($connect_db, $sql);
							if(!$result){
								print("Произошла ошибка при выполнении запроса");
							} else {
								while($row = mysqli_fetch_array($result)){
									echo "
										<div class=\"col-xl-4 col-lg-6 col-md-6 col-sm-12 d-flex justify-content-center\">
											<div class=\"product-card\">
												<div class=\"product-thumb\">
													<a href=\"#\"><img src=\"data:image/jpeg;base64,${row['image']}\" alt=\"\"></a>
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
						?>
						<!-- <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 d-flex justify-content-center">
							<div class="product-card">
								<div class="product-thumb">
									<a href="#"><img src="images/items/Daewoo-DAST-7565.jpg" alt=""></a>
								</div>
								<div class="product-details">
									<h5><a href="index.php?page=iteminfopage">Снегоуборщик бензиновый Daewoo DAST 7565</a></h5>
									<div class="product-bottom-details d-flex justify-content-between">
										<div class="product-price">
											74 990 руб.
										</div>
										<div class="product-links">
											<a href="#"><i class="fas fa-shopping-cart"></i></a>
											<a href="#"><i class="far fa-heart"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 d-flex justify-content-center">
							<div class="product-card">
								<div class="product-thumb">
									<a href="#"><img src="images/items/Daewoo-DAST-3000E.jpg" alt=""></a>
								</div>
								<div class="product-details">
									<h5><a href="index.php?page=iteminfopage">Снегоуборщик электрический Daewoo DAST 3000E</a></h5>
									<div class="product-bottom-details d-flex justify-content-between">
										<div class="product-price">
											21 990 руб.
										</div>
										<div class="product-links">
											<a href="#"><i class="fas fa-shopping-cart"></i></a>
											<a href="#"><i class="far fa-heart"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 d-flex justify-content-center">
							<div class="product-card">
								<div class="product-thumb">
									<a href="#"><img src="images/items/Redverg-RD-SB56-7E.jpg" alt=""></a>
								</div>
								<div class="product-details">
									<h5><a href="index.php?page=iteminfopage">Снегоуборщик бензиновый Redverg RD-SB56/7E</a></h5>
									<div class="product-bottom-details d-flex justify-content-between">
										<div class="product-price">
											46 490 руб.
										</div>
										<div class="product-links">
											<a href="#"><i class="fas fa-shopping-cart"></i></a>
											<a href="#"><i class="far fa-heart"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 d-flex justify-content-center">
							<div class="product-card">
								<div class="product-thumb">
									<a href="#"><img src="images/items/Daewoo-DASС-750B.jpg" alt=""></a>
								</div>
								<div class="product-details">
									<h5><a href="index.php?page=iteminfopage">Насадка нож-отвал Daewoo DASС 750B</a></h5>
									<div class="product-bottom-details d-flex justify-content-between">
										<div class="product-price">
											5 392 руб.
										</div>
										<div class="product-links">
											<a href="#"><i class="fas fa-shopping-cart"></i></a>
											<a href="#"><i class="far fa-heart"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 d-flex justify-content-center">
							<div class="product-card">
								<div class="product-thumb">
									<a href="index.php?page=iteminfopage"><img src="images/items/Redverg-RD-SB60-950BS-E.jpg" alt=""></a>
								</div>
								<div class="product-details">
									<h5><a href="#">Снегоуборщик бензиновый Redverg RD-SB60/950BS-E</a></h5>
									<div class="product-bottom-details d-flex justify-content-between">
										<div class="product-price">
											74 990руб.
										</div>
										<div class="product-links">
											<a href="#"><i class="fas fa-shopping-cart"></i></a>
											<a href="#"><i class="far fa-heart"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</section>