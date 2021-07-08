<?php
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
		<h1 class="header text-center">Задания к шестому уроку</h1>
		<div class="row">
			<div class="offset-md-3 col-6 pb-3">
			<?php
			if(isset($_GET['id'])) {
				
				$id			=	$_GET['id'];
				$products	=	$dbh->query('SELECT * FROM products WHERE id = '.$id.'');
				foreach ($products as $product) {

					$image  =	IMG_DIR . $product['id'] . $product['imgname'] .'.'. $product['extension'];
					$delete	=	'delete'.$product['id'];
					
					if(isset($_POST[$delete])) {

						$productID	=	$product['id'];
						$dbh->query('DELETE FROM products WHERE id = '.$productID.'');

						if(file_exists($image)) {
							unlink($image);
							echo'<div class="alert alert-success mt-3 text-center" role="alert">Товар успешно удален! Перейти в <br> <a href="admin.php"><strong>Панель управления</strong></a></div>';
						}
					}

					if(file_exists($image)) {
						echo '<h3 class="text-center mt-3">'.$username.' - вы действительно хотите удалить данный товар?</h3>
							<div class="card">
								<div class="text-center">
									<img src="'.$image.'" class="card-img-top img-fluid rounded" alt="'.$product['imgname'].'">
								</div>
								<div class="card-body">
									<h5 class="card-title">'.$product['name'].'</h5>
									<p class="card-text">'.$product['price'].' рублей</p>
									<form method="post">
									<button type="submit" name="delete'.$product['id'].'" class="btn btn-outline-danger">Удалить</button>
									</form>
								</div>
							</div>';
					}
				}
			}
			?>

			</div>
		</div>
	</div>
	<footer class="footer text-center">
		<div class="container">
			<span class="text-muted">Уфа &#169; <?=date('Y')?></span>
		</div>
	</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>