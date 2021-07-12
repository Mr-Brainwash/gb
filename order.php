<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

session_start();

$data   =   $_POST;
$userId	=   $_SESSION['id'];
$hash   =   $_SESSION['hash'];

require 'config/base.php';

$user   =   $dbh->query('SELECT * FROM users WHERE id = "'.$userId .'" AND hash = "'.$hash .'" AND user_status = 0');

if($user->rowCount())
{
	foreach ($user as $user_row) {
		$username = $user_row['user_name'];
	}
} else {
	header('Location:login.php');
	exit;
}
if (isset($data['unlogin'])) 
{
	session_destroy();
	header('location:/login.php');
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
				<ul class="navbar-nav mr-auto">
					<li class="nav-item"><a class="nav-link" href="/">Главная</a><li>
				</ul>
				<form method="post" class="form-inline my-2 my-lg-0">
					<button class="btn btn-outline-success my-2 my-sm-0" name="unlogin" type="submit">Выйти</button>
				</form>
			</div>
		</div>
	</nav>

	<div class="container">
<?php
			
if(isset($_GET['id'])) { 

	$order_id	=	$_GET['id'];
	$products	=	$dbh->query('SELECT * FROM products WHERE id = '.$order_id.'');

	if($products) {
		foreach($products as $product) {
			$image 		=	IMG_DIR . $product['id'] . $product['imgname'] .'.'. $product['extension'];
			$pr_id		=	$product['id'];
			$pr_name	=	$product['name'];
			$dbh->query("INSERT INTO orders (user_name) VALUES ('". $username ."')");
			$LID = $dbh->lastInsertId();
			if($LID) {
				$dbh->query("INSERT INTO order_product (order_id,product_id,count) VALUES ('". $LID ."','". $pr_id ."',1)");
			}
			echo'<div class="alert alert-success mt-3 text-center" role="alert">'.$username.', товар добавлен в корзину</div> 
			<script>setTimeout(function () {window.location.replace("http://gb/index.php");}, 2000);</script>';
		}
	} else {
		echo'<div class="alert alert-danger mt-3 text-center" role="alert">Ошибка</div>';
	}
}
	
?>				
	</div>

	<footer class="footer text-center">
		<div class="container">
			<span class="text-muted">Уфа &#169; <?=date('Y')?></span>
		</div>
	</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>