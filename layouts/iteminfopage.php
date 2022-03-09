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
							<div class=\"col-lg-12 col-sm-12 mb-5\">
								<h2>${row['name']}</h2>
								<img src=\"data:image/jpeg;base64,${row['image']}\" alt=\"...\" class=\"item-img\">
								<h3>${row['price']} руб.</h3>
								<button type=\"button\" class=\"btn btn-primary\"><i class=\"fas fa-cart-plus\"></i></button>
								<button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\"><i class=\"far fa-credit-card\"></i></button>
							</div>
						";
					}
				}
			?>
			<!-- <div class="col-lg-12 col-sm-12 mb-5">
				<h2>Снегоуборщик бензиновый Daewoo DAST 7565</h2>
				<img src="images/items/Daewoo-DAST-7565.jpg" alt="..." class="item-img">
				<h3>74 990 руб.</h3>
				<button type="button" class="btn btn-primary"><i class="fas fa-cart-plus"></i></button>
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="far fa-credit-card"></i></button>
			</div>
			<div class="col-lg-6 col-sm-12 mb-5 d-flex flex-column">
				<h2 class="align-self-center">Характеристики</h2>
				<ul class="list-group list-group-flush">
					<li class="list-group-item d-flex justify-content-between"><span>Тип продукта</span><span>Снегоуборщик</span></li>
					<li class="list-group-item d-flex justify-content-between"><span>Артикул производителя</span><span>DAST 7565</span></li>
					<li class="list-group-item d-flex justify-content-between"><span>Тип двигателя</span><span>бензиновый</span></li>
					<li class="list-group-item d-flex justify-content-between"><span>Тактность двигателя</span><span>4-тактный</span></li>
					<li class="list-group-item d-flex justify-content-between"><span>Модель двигателя</span><span>Daewoo 220 winter</span></li>
					<li class="list-group-item d-flex justify-content-between"><span>Объем двигателя, см3</span><span>221</span></li>
					<li class="list-group-item d-flex justify-content-between"><span>Мощность, л.с.</span><span>7.5</span></li>
					<li class="list-group-item d-flex justify-content-between"><span>Объем топливного бака, л</span><span>3.8</span></li>
					<li class="list-group-item d-flex justify-content-between"><span>Объем масляного бака, мл</span><span>600</span></li>
					<li class="list-group-item d-flex justify-content-between"><span>Электростартер</span><span>да</span></li>
					<li class="list-group-item d-flex justify-content-between"><span>Скорости</span><span>4 вперед; 1 назад</span></li>
					<li class="list-group-item d-flex justify-content-between"><span>Ширина обработки, см</span><span>65</span></li>
					<li class="list-group-item d-flex justify-content-between"><span>Высота обработки, см</span><span>53</span></li>
					<li class="list-group-item d-flex justify-content-between"><span>Дальность выброса, м</span><span>12</span></li>
					<li class="list-group-item d-flex justify-content-between"><span>Регулировка дальности выброса</span><span>с панели оператора</span></li>
					<li class="list-group-item d-flex justify-content-between"><span>Система шнеков</span><span>двухступенчатая</span></li>
					<li class="list-group-item d-flex justify-content-between"><span>Тип шнека</span><span>металлический</span></li>
				</ul>
			</div> -->
		</div>
	</div>
</section>