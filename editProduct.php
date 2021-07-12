<?php
	include 'include/session.php';
	const IMG_DIR	=	'uploads/';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
	<link href="css/style.css" rel="stylesheet">
	<title>Курс PHP</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="/">Курс PHP</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Переключатель навигации">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<form method="post" class="form-inline my-2 my-lg-0">
					<button class="btn btn-outline-success my-2 my-sm-0" name="unlogin" type="submit">Выйти</button>
				</form>
			</div>
		</div>
	</nav>

	<div class="container">
 		<div class="row">
			<div class="offset-md-3 col-6 pb-3">
 <?php
	if(isset($_GET['id'])) 
	{
		$id			=	$_GET['id'];
		$products	=	$dbh->query('SELECT * FROM products WHERE id = '.$id.'');

		foreach ($products as $product) {
			$image  =  $product['id'] . $product['imgname'] .'.'. $product['extension'];
			echo '<h3 class="text-center mt-3">'.$username.' - вы действительно хотите обновить данные товара?</h3>
				<div class="card">
					<div class="card-body">
						<form enctype="multipart/form-data" method="post">
							<div class="form-group">
								<label>Название товара:</label>
								<input type="text" class="form-control" name="name" value="'.$product['name'].'" required>
							</div>
							<div class="form-group">
								<label>Цена товара:</label>
								<input type="number" class="form-control" name="price" value="'.$product['price'].'" required>
							</div>
							<div class="form-group">
								<label>Добавить фото:</label>
								<input type="file" name="image_file">
							</div>
							<button type="submit" name="edit" class="btn btn-primary">Отправить</button>
						</form>
					</div>
				</div>';
		}
		if(isset($_POST['edit'])) 
		{
			if(is_uploaded_file($_FILES['image_file']['tmp_name'])) 
			{
				$sql	=	$dbh->query('SELECT * FROM products WHERE id = '.$id.'');
				foreach($sql as $sql_row) {
					$image  =	IMG_DIR . $sql_row['id'] . $sql_row['imgname'] .'.'. $sql_row['extension'];

					if(file_exists($image)) {
						unlink($image);
					}
				}
		
				$productName	=	htmlspecialchars($_POST['name']);
				$productPrice	=	htmlspecialchars($_POST['price']);
				$fileName 		=	$_FILES['image_file']['name'];
				$fileTmpName	=	$_FILES['image_file']['tmp_name'];
				$fileType		=	$_FILES['image_file']['type'];
				$fileError		=	$_FILES['image_file']['error'];
				$fileSize		=	$_FILES['image_file']['size'];
				
				$fileExtension	=	strtolower(end(explode('.', $fileName)));
				$fileName		=	explode('.', $fileName)[0];
				$fileName		=	preg_replace('/[0-9]/', '', $fileName);
				$validExtension	=	['jpg', 'jpeg', 'png'];

				if(in_array($fileExtension,$validExtension))
				{
					if($fileSize < 5242880)
					{
						if($fileError === 0)
						{
							$dbh->query("UPDATE products SET name = '".$productName."',imgname = '".$fileName."',extension = '".$fileExtension."',price = '".$productPrice."',updated_at = NOW() WHERE id = '".$id."'");
							$lastID				=	$dbh->query("SELECT MAX(id) FROM products");
							$lastID				=	$lastID->fetchAll();
							$lastID				=	$lastID[0][0];
							$fileNameNew		=	$lastID	 . $fileName . '.' . $fileExtension;
							$fileDestination	=	IMG_DIR . $fileNameNew;
							move_uploaded_file($fileTmpName, $fileDestination);
							header('location:admin.php');
						} else {
							echo'<div class="alert alert-danger" role="alert">Что-то пошло не так..</div>';
						}
					} else {
						echo'<div class="alert alert-danger" role="alert">Слишком большой размер файла</div>';
					}
				} else {
					echo'<div class="alert alert-danger" role="alert">Неверный тип файла</div>';
				}
			} else if (!is_uploaded_file($_FILES['image_file']['tmp_name'])) {

				$productName	=	htmlspecialchars($_POST['name']);
				$productPrice	=	htmlspecialchars($_POST['price']);
				$dbh->query("UPDATE products SET name = '".$productName."',price = '".$productPrice."',updated_at = NOW() WHERE id = '".$id."'");
				header('location:admin.php');

			}

		}
		
	}
?>
			</div>
		</div>
	</div>

	<footer class="footer text-center">
		<div class="container">
			<span class="text-muted">Уфа © <?=date('Y')?></span>
		</div>
	</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>