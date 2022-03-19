<div class="my-carousel">
	<div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
		<div class="carousel-indicators">
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
		</div>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<a href="index.php?page=itemspage&category=8" class="w-100">
					<img src="img/carousel/1.jpg" class="d-block w-100" alt="...">
				</a>
			</div>
			<div class="carousel-item">
				<a href="index.php?page=itemspage&category=11" class="w-100">
					<img src="img/carousel/2.jpg" class="d-block w-100" alt="...">
				</a>
			</div>
			<div class="carousel-item">
				<a href="index.php?page=itemspage&category=12" class="w-100">
					<img src="img/carousel/3.jpg" class="d-block w-100" alt="...">
				</a>
			</div>
		</div>
		<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Previous</span>
		</button>
		<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Next</span>
		</button>
	</div>
</div>
<section class="main-content">
	<div class="container">
		<div class="row">
			<?php
				$sql = 'SELECT * FROM category;';
				$result = mysqli_query($connect_db, $sql);
				if(!$result){
					print("Произошла ошибка при выполнении запроса");
				} else {
					while($row = mysqli_fetch_array($result)){
						echo "
                            <div class=\"col-xxl-2 col-xl-3 col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center\">
                                <a href=\"index.php?page=itemspage&category=${row['id']}\">
                                    <div class=\"card\">
                                        <img src=\"${row['image']}\" class=\"card-img-top\" alt=\"...\">
                                        <div class=\"d-flex card-body justify-content-center\">
                                            <p class=\"card-text\">
                                                ${row['name']}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>";
					}
				}
			?>
		</div>
	</div>
</section>