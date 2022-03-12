<?php
	// if ($_FILES && $_FILES["filename"]["error"]== UPLOAD_ERR_OK)
	// {
 //    	$name = $_FILES["filename"]["name"];
 //    	move_uploaded_file($_FILES["filename"]["tmp_name"], $name);
 //    	echo "Файл загружен";
	// }
?>
<form method="post" enctype="multipart/form-data">
Выберите файл: <br />
<input type="file" name="filename" size="5"/><br />
<input class="btn btn-primary" type="submit" value="Загрузить" />
</form>