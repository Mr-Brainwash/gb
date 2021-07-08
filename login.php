<?php
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	session_start();
	$data	=	$_POST;
	$id		=	isset($_SESSION['id']);
	$hash	=	isset($_SESSION['hash']);
	$logAlert	=	'';
	$regAlert 	=	'';
	require 'config/base.php';
	$user	=	$dbh->query('SELECT * FROM users WHERE id = "'.$id .'" AND hash = "'.$hash .'"');

	if($user->rowCount())
	{
		header('Location:/admin.php');
		exit;
	}

// Авторизация

	if (isset($data['send'])) 
	{
		$login		=	trim(htmlspecialchars(stripslashes($data['login'])));
		$password	=	trim(htmlspecialchars(stripslashes(hash('sha256', $data['password']))));
		$query		=	$dbh->query('SELECT * FROM users WHERE login="'.$login.'" AND password="'.$password.'"');

		if($query->rowCount())
		{
			foreach($query as $row)
			{
				$id		=	$row['id'];
				$hash	=	hash('sha256', time().rand());
				$dbh->query('UPDATE users SET hash = "'.$hash.'" WHERE id = "'.$id.'"');
				$_SESSION['id']		=	$id;
				$_SESSION['hash']	=	$hash;
				header('location:admin.php');
			}

		} else {
			$logAlert	.=	'<div class="alert alert-danger mt-3 text-center" role="alert">Неверный пароль или логин</div>';
		}
	}

// Регистрация

	if (isset($data['reg']))
	{
		if ($data['name'] == '')
		{
			$errors		=	[];
			$errors[]	=	'Введите имя';
		}
		if ($data['email'] == '')
		{
			$errors[]	=	'Введите email';
		}
		if ($data['log'] == '')
		{
			$errors[]	=	'Введите логин';
		}
		if ($data['pass'] == '')
		{
			$errors[]	=	'Введите пароль';
		}
		if ($data['pass_2'] != $data['pass'])
		{
			$errors[]	=	'Повторный пароль введен не верно!';
		}
		$result	=	$dbh->query('SELECT id FROM users WHERE login = "'.$data['log'].'"'); 
		$myrow 	=	$result->fetch(PDO::FETCH_ASSOC);
		if ($myrow) 
		{
			$errors[]	=	'Пользователь с таким логином уже существует!';
		}
		if (empty($errors))
		{
			$name		=	trim(htmlspecialchars(stripslashes($data['name'])));
			$email		=	trim(htmlspecialchars(stripslashes($data['email'])));
			$log		=	trim(htmlspecialchars(stripslashes($data['log'])));
			$pass		=	trim(htmlspecialchars(stripslashes(hash('sha256', $data['pass']))));
			$dbh->query("INSERT INTO users (`name`,`email`,`login`,`password`) VALUES ('". $name ."','".$email."','".$log."','".$pass."')");
			$id			=	$dbh->lastInsertId();
			$hash		=	hash('sha256', time().rand());
			$dbh->query('UPDATE users SET hash = "'.$hash.'" WHERE id = "'.$id.'"');
			$_SESSION['id']		=	$id;
			$_SESSION['hash']	=	$hash;

			$regAlert	.= 	'<div class="alert alert-success mt-3 text-center" role="alert">Вы успешно зарегистрированы! Можете перейти в <br> <a href="admin.php"><strong>Панель управления</strong></a></div>';
		} else {
			$regAlert	.=	'<div class="alert alert-danger mt-3 text-center" role="alert">' .array_shift($errors). '</div>';
		}
	}
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
		<nav class="navbar navbar-light bg-light">
		<div class="container">
			<span class="navbar-brand mb-0 h2 text-muted">Курс PHP</span>
		</div>
	</nav>

	<div class="container">
		<h1 class="header text-center">Задания к шестому уроку</h1>
		<div class="d-flex mt-3">
			<div class="mx-auto card col-6">
				<div class="card-body">
					<h5 class="card-title text-center">Авторизация</h5>
					<form method="post">
						<div class="form-group">
							<label>Логин:</label>
							<input type="text" class="form-control" name="login" placeholder="Введите логин" required>
						</div>
						<div class="form-group">
							<label>Пароль:</label>
							<input type="password" class="form-control" name="password" placeholder="Введите пароль" required>
						</div>
						<button type="submit" class="btn btn-primary" name="send">Отправить</button>
						<?=$logAlert?>
					</form>
				</div>
			</div>
		</div>

		<div class="d-flex mt-3 pb-5">
			<div class="mx-auto card col-6">
				<div class="card-body">
					<h5 class="card-title text-center">Регистрация</h5>
					<form method="post">
						<div class="form-group">
							<label>Имя:</label>
							<input type="text" class="form-control" name="name" placeholder="Введите имя" required>
						</div>
						<div class="form-group">
							<label>Email:</label>
							<input type="email" class="form-control" name="email" placeholder="Введите email" required>
						</div>
						<div class="form-group">
							<label>Логин:</label>
							<input type="text" class="form-control" name="log" placeholder="Введите логин" required>
						</div>
						<div class="form-group">
							<label>Пароль:</label>
							<input type="password" class="form-control" name="pass" placeholder="Введите пароль" required>
						</div>
						<div class="form-group">
							<label>Повторите пароль:</label>
							<input type="password" class="form-control" name="pass_2" placeholder="Повторите пароль" required>
						</div>
						<button type="submit" class="btn btn-primary" name="reg">Отправить</button>
						<?=$regAlert?>
					</form>
				</div>
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