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
		<div class="row">
			<div class="offset-md-3 col-6 mt-3">
			<?php
			if(isset($_GET['id']))
			{
				$id		=	$_GET['id'];
				$dbh->query('UPDATE `products` SET `views_count` = `views_count` + 1, `updated_at` = NOW() WHERE `id` = '.$id.'');
				$result	=	$dbh->query('SELECT * FROM products WHERE id = '.$id.'');
				foreach ($result as $res) {
					$image  = IMG_DIR . $res['id'] . $res['imgname'] .'.'. $res['extension'];
					if(file_exists($image))
					{
					echo '<div class="card">
							<div class="text-center">
								<img src="'.$image.'" class="card-img-top img-fluid rounded" alt="'.$res['imgname'].'">
							</div>
							<div class="card-body">
								<h5 class="card-title">'.$res['name'].'</h5>
								<p class="card-text">'.$res['price'].' рублей</p>
							</div>
						</div> 
						<div class="alert alert-light" role="alert">Количество просмотров: '.$res['views_count'].'</div>';
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
