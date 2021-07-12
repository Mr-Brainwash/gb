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
		<h3 class="mt-3">Привет, <?=$username?>!</h3>
		

<?php
$i = 1;
$orders		=	$dbh->query('
	SELECT group_concat(distinct id) as id, name, imgname, extension, price, sum(count) as total_count, sum(price) as total_price 
	FROM products 
	JOIN order_product ON products.id = order_product.product_id
	GROUP BY id');

if($orders->rowCount()) {
	$res 	=	'';
	foreach ($orders as $order) {
		$image  = IMG_DIR . $order['id'] . $order['imgname'] .'.'. $order['extension'];
		$res .= '<tr>
		<th scope="row">'.$i.'</th>
		<td><img src="'.$image.'" class="img-fluid rounded" width="150" heigth="150"></td>
		<td>'.$order['name'].'</td>
		<td>'.$order['total_count'].'</td>
		<td>'.$order['price'].'</td>
		<td>'.$order['total_price'].'</td>
		</tr>';
		$i++;
	}
} else {
	echo'<div class="alert alert-success mt-3 text-center" role="alert">Корзина пуста</div>';
}

?>
				<div class="table-responsive">
					<table class="table table-striped caption-top">
						<caption>Список покупок</caption>
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Изображение</th>
								<th scope="col">Название товара</th>
								<th scope="col">Количество</th>
								<th scope="col">Цена</th>
								<th scope="col">Общая цена</th>
							</tr>
						</thead>
						<tbody>
							<?=$res?>
						</tbody>
					</table>
				</div>
<?php //общая сумма
$total_price = $dbh->query('SELECT sum(price) as total_price FROM products JOIN order_product ON products.id = order_product.product_id')->fetch();
?>
				<h3 class="pb-3">Общая сумма: <?=$total_price['total_price']?></h3>
	</div>

	<footer class="footer text-center">
		<div class="container">
			<span class="text-muted">Уфа &#169; <?=date('Y')?></span>
		</div>
	</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>