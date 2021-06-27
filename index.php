<?php
	require 'example.php';
	$title	=	'Курс PHP';
	$header =	'Задания ко второму уроку';
	$date	=	date('Y');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link href="style.css" rel="stylesheet">
	<title><?php echo $title; ?></title>
</head>
<body>

	<nav class="navbar navbar-light bg-light">
		<div class="container">
			<span class="navbar-brand mb-0 h2 text-muted">Курс PHP</span>
		</div>
	</nav>

	<div class="container">
		<h1 class="header text-center"><?php echo $header; ?></h1>

		<h4>Обновите страницу, чтобы данные менялись в примерах. Код функций лежит в файле example.php</h4>

		<h3>Задание 1:</h3>
		<p class="text">Объявлены две целочисленные переменные <code>$a</code> и <code>$b</code> с рандомными значениями. Если <code>$a</code> и <code>$b</code> положительные, скрипт выводит их разность, если отрицательные, выводит их произведение, если разных знаков, то сумму.</p>
		<p class="text"><code>$a</code> = <?=$a?>, <code>$b</code> = <?=$b?>. Результат: <code>$d</code> = <?=$d?></p>

		<h3>Задание 2:</h3>
		<p class="text">Переменной <code>$c</code> задано значение в промежутке [0..15]. С помощью оператора switch вывел числа от <code>$c</code> до 15.</p>
		<p class="text">Результат:
			<?php switch($c) {
				case 0: echo 0 . ' ';
				case 1: echo 1 . ' ';
				case 2: echo 2 . ' ';
				case 3: echo 3 . ' ';
				case 4: echo 4 . ' ';
				case 5: echo 5 . ' ';
				case 6: echo 6 . ' ';
				case 7: echo 7 . ' ';
				case 8: echo 8 . ' ';
				case 9: echo 9 . ' ';
				case 10: echo 10 . ' ';
				case 11: echo 11 . ' ';
				case 12: echo 12 . ' ';
				case 13: echo 13 . ' ';
				case 14: echo 14 . ' ';
				case 15: echo 15 . ' ';
			}?>
		</p>

		<h3>Задание 3:</h3>
		<p class="text">Реализованы 4 основные арифметические операции в виде функций с двумя параметрами (в файле example.php)</p>

		<h3>Задание 4:</h3>
		<p class="text">Реализована функция с тремя параметрами: <code>function mathOperation($arg1, $arg2, $operation)</code>, где <code>$arg1</code>, <code>$arg2</code> – значения аргументов, <code>$operation</code> – строка с названием операции. В зависимости от переданного значения операции выполняется одна из арифметических операций (с помощью функций из задания 3) и возвращется полученное значение.</p>
		<p class="text">
			<?php
			// простая генерация значений аргументов для функции

				$int_1 		=	rand(0, 10);
				$int_2 		=	rand(0, 10);
				$operations	=	['сложение','вычитание','умножение','деление'];
				$rand_keys	=	array_rand($operations, 2);
				$operation	=	$operations[$rand_keys[0]];

			?>
			Сгенерированные значения аргументов: <code>$arg1</code> = <?=$int_1?>, <code>$arg2</code> = <?=$int_2?>, <code>$operation</code> = "<?=$operation?>". Результат: <?php echo mathOperation($int_1, $int_2, $operation);?>
		</p>
	</div>

	<footer class="footer text-center">
		<div class="container">
			<span class="text-muted">Уфа &#169; <?php echo $date; ?></span>
		</div>
	</footer>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>
</html>