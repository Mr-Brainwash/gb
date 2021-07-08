<?php 
require 'config/base.php';
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
				<?php
				$menu	=	[
					'Вход'	=> 	'/login.php',
					'Регистрация'	=>	'/login.php'
				];

				echo '<ul class="navbar-nav mr-auto">';
				foreach ($menu as $title => $url) {
					echo '<li class="nav-item"><a class="nav-link" href='.$url.'>'.$title.'</a><li>';
				}
				echo '</ul>';
				?>
			</div>
		</div>
	</nav>

	<div class="container">
		<h1 class="header text-center">Задания к шестому уроку</h1>
		<h3>Загрузите изображения в галерею</h3>

		<div class="container">
		<div class="row pb-3">
			<?php
				$products  = $dbh->query('SELECT * FROM products ORDER BY views_count DESC');
				foreach ($products as $product) {
					$image  = IMG_DIR . $product['id'] . $product['imgname'] .'.'. $product['extension'];
					if(file_exists($image)) {
						echo '<div class="col-6 mt-3">
								<div class="card">
									<div class="text-center">
										<img src="'.$image.'" class="card-img-top img-fluid rounded" alt="'.$product['imgname'].'">
									</div>
									<div class="card-body">
										<h5 class="card-title">'.$product['name'].'</h5>
										<p class="card-text">'.$product['price'].' рублей</p>
										<a href="product.php?id='.$product['id'].'" target="_blank" class="btn btn-primary">Посмотреть</a>
									</div>
								</div>
							</div>';
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