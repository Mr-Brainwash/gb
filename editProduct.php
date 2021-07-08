<?php
// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

session_start();

$data   =   $_POST;
$userId	=   $_SESSION['id'];
$hash   =   $_SESSION['hash'];

require 'config/base.php';

$user   =   $dbh->query('SELECT * FROM users WHERE id = "'.$userId .'" AND hash = "'.$hash .'"');

if($user->rowCount())
{
	foreach ($user as $user_row) {
		$username = $user_row['name'];
	}
} else {
	header('Location:login.php');
	exit;
}
if (isset($data['unlogin'])) 
{
	session_destroy();
	header('location:login.php');
} 

const IMG_DIR	=	'uploads/';

?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


</body>