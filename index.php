<?php
	$title	=	'Курс PHP';
	$header =	'Задания ко второму уроку';
	$date	=	date('Y');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link href="style.css" rel="stylesheet">
	<title><?php echo $title; ?></title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
			<span class="navbar-brand mb-0 h2 text-muted">Курс PHP</span>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<?php
				$menu	=	[
					'Главная'	=> 'index',
					'О нас'		=> 'about',
					'Контакты'	=> 'contact'
				];
				$items	=	[
					'Маршруты'					=>	'route',
					'Туристические маршруты'	=>	'tourist_routes'
					];

				echo "<ul class='nav navbar-nav list'>";
					foreach ($menu as $title => $url) {
						echo '<li class="nav-item"><a class="nav-link" href='.$url.'>'.$title.'</a><li>';
					}
					echo '<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
								Услуги
							</a>';
							echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
							foreach ($items as $item => $item_url) {
								echo '<li><a class="dropdown-item" href='.$item_url.'>'.$item.'</a></li>';
							}
							echo '</ul>
						</li>';
				echo "</ul>";
				?>
			</div>
		</div>
	</nav>

	<div class="container">
		<h1 class="header text-center"><?php echo $header; ?></h1>

		<h3>Задание 1:</h3>
		<p class="text">
			<?php
				// Задание #1
				$i = 1;

				while ($i <= 100) {
					if ($i % 3 == 0) {	
						echo $i++ . ' ';
					}
					$i++;
				}
			?>
		</p>

		<h3>Задание 2:</h3>
		<?php

			// Задание #2

			echo '<ul class="list-unstyled">';
			$int = 0;
			do {
				if($int == 0){
					echo '<li>'.$int.' - ноль </li>';
					$int++;
				} else if($int % 2 != 0){
					echo '<li>'.$int.' - нечетное число </li>';
					$int++;
				}
				else {
					echo '<li>'.$int.' - четное число </li>';
					$int++;
				}
			} while ($int < 11);
			echo '</ul>';
		?>

		<h3>Задание 3:</h3>

		<?php 
			$settlements = [
				'Московская область'		=>	['Москва','Зеленоград','Клин'],
				'Ленинградская область'		=>	['Санкт-Петербург','Всеволожск','Павловск','Кронштадт'],
				'Рязанская область' 		=>	['Рязань','Кораблино','Рыбное'],
				'Республика Башкортостан'	=>	['Уфа','Белорецк','Октябрьский','Салават']
			];


			echo '<ul class="list-unstyled">';
			foreach ($settlements as $key => $city) {
				echo '<li>' . $key . ':</li>';
				echo '<li>' . implode(', ', $city) . '</li>';
			}
			echo '</ul>';
		?>

		<h3>Задание 4:</h3>
		<?php 
			// Задание #4

			function translit($str)
			{
				$letters	=	[
					'а'	=>	'a','б'	=>	'b','в'	=>	'v','г'	=>	'g','д'	=>	'd',
					'е'	=>	'e','ё'	=>	'e','ж'	=>	'zh','з'	=>	'z','и'	=>	'i',
					'й'	=>	'y','к'	=>	'k','л'	=>	'l','м'	=>	'm','н'	=>	'n',
					'о'	=>	'o','п'	=>	'p','р'	=>	'r','с'	=>	's','т'	=>	't',
					'у'	=>	'u','ф'	=>	'f','х'	=>	'h','ц'	=>	'c','ч'	=>	'ch',
					'ш'	=>	'sh','щ'	=>	'sch','ь'	=>	'','ы'	=>	'y','ъ'	=>	'',
					'э'	=>	'e','ю'	=>	'yu','я'	=>	'ya'
				];
				$str = strtr($str, $letters);
				return $str;
			}

			echo '<p class="text">' . translit('Единственная вещь, которая может быть страшнее, чем программист с отвёрткой или разработчик аппаратуры с программой — это пользователь с проволочной пилой и паролем суперпользователя. Элизабет Звики'). '</p>';
		?>

		<h3>Задание 5:</h3>
		<?php 
			// Задание #5

			$string	=	'2007 — американская компания Apple представила первый iPhone';
			$string	=	preg_replace('/\s+/', '_', $string);
			echo '<p class="text">' .$string. '</p>';
		?>
		<h3>Задание 6:</h3>
		<p class="text">Реализовано в меню(см.выше)</p>
	</div>


	<footer class="footer text-center">
		<div class="container">
			<span class="text-muted">Уфа &#169; <?php echo $date; ?></span>
		</div>
	</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>