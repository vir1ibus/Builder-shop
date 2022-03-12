<section class="main-content">
	<div class="container-xxl">
		<div class="row">
			<?php 
				$sql = "SELECT * FROM item WHERE id=${_GET['item']};";
				$result = mysqli_query($connect_db, $sql);
				if(!$result){
					print("Произошла ошибка при выполнении запроса");
				} else {
					while($row = mysqli_fetch_array($result)){
						echo "
							<div class=\"col-lg-6 col-sm-12 text-center\">
								<h2>${row['name']}</h2>
								<img src=\"${row['image']}\" alt=\"...\" class=\"item-img\">
								<h3>${row['price']} руб.</h3>
								<button type=\"button\" class=\"btn btn-primary\"><i class=\"fas fa-cart-plus\"></i></button>
								<button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\"><i class=\"far fa-credit-card\"></i></button>
							</div>
						";
					}
				}
			?>

			<div class="col-lg-6 col-sm-12 mb-5 d-flex flex-column">
				<h2 class="align-self-center">Характеристики</h2>
				<ul class="list-group list-group-flush">
					<?php
						$sql = "SELECT characteristics.name, item_has_characteristics.value FROM characteristics INNER JOIN item_has_characteristics ON item_has_characteristics.characteristics_id = characteristics.id AND item_has_characteristics.item_id = ${_GET['item']};";
						$result = mysqli_query($connect_db, $sql);
						if(!$result){
							print("Произошла ошибка при выполнении запроса");
						} else {
							while($row = mysqli_fetch_array($result)){
								echo "
									<li class=\"list-group-item d-flex justify-content-between\"><span>${row['name']}</span><span>${row['value']}</span></li>
								";
							}
						}
					?>
				</ul>
			</div>
		</div>
	</div>
</section>