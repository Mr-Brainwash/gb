<?php
$title	=	'Курс PHP';
$header =	'Задания к первому уроку';
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

		<p class="text">1. Установил программное обеспечение:</p>

		<ul class="list-unstyled text-muted">
			<li>OC Linux (KDE neon)</li>
			<li>Apache</li>
			<li>MySQL (mariadb-server)</li>
			<li>PHP</li>
			<li>Sublime text и PHPStorm</li>
		</ul>

		<p class="text">Так же настроил виртуальный хост, настроил права доступа к файлам, папку с проектом синхронизировал с репозиторием в Git. Установил Composer и фреймворк Laravel (на будущее). Настроил и создал пустрой проект, убедился, что все работает.</p>

		<p class="text">2. Выполнил примеры из методички, и посмотрел как все работает.</p>

		<p class="text">3. Как работает данный код:</p>

		<div class="row justify-content-center">
			<div class="col-lg-6 col-md-12">
				<?php require_once 'example.php';?>
			</div>
		</div>

		<p class="text">В третьей строке <code> var_dump </code> возвращает <code> true </code> потому что оператор <code> == </code> не сравнивает типы.</p>

		<p class="text">В четвертой строке <code> var_dump </code> возвращает <code> 12345 </code> потому что <code> "012345" </code> это изначально строка. При приведении в тип <code> int </code> </p>

		<p class="text">В пятой строке оператор <code> === </code> означает тождественно равно и сравнивает типы. Одно число приведено к типу <code> float </code>, другое к <code> int </code> поэтому <code> var_dump </code> возвращает <code> false </code></p>

		<p class="text">В шестой строке <code> var_dump </code> возвращает <code> true </code> потому что данные приведены в один тип <code> int </code>.</p>

		<p class="text">4. Данная страница и является HTML-шаблоном. Создан блок переменных в начале страницы. И указанные элементы из задания (<code>&lt;h1&gt;</code>, <code>&lt;title&gt;</code> и текущий год в футере) созданы с помощью значений переменных.</p>

		<p class="text">5. Поменял значения переменных местами без использования дополнительных переменных. 
			<pre><code>$a = 1;</code></pre>
			<pre><code>$b = 2;</code></pre>
			Решение: <code>$a+=+$b-$b=$a;</code>
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