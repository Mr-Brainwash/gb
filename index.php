<?php const IMG_DIR	=	'uploads/'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link href="style.css" rel="stylesheet">
	<title>Курс PHP</title>
</head>
<body>
		<nav class="navbar navbar-light bg-light">
		<div class="container">
			<span class="navbar-brand mb-0 h2 text-muted">Курс PHP</span>
		</div>
	</nav>

	<div class="container">
		<h1 class="header text-center">Задания к четвертому уроку</h1>
		<h3>Загрузите изображения в галерею</h3>
<?php
	if(isset($_POST['submit']))
	{
		$fileName 		=	$_FILES['image_file']['name'];
		$fileTmpName	=	$_FILES['image_file']['tmp_name'];
		$fileType		=	$_FILES['image_file']['type'];
		$fileError		=	$_FILES['image_file']['error'];
		$fileSize		=	$_FILES['image_file']['size'];
		
		$fileExtension	=	strtolower(end(explode('.', $fileName)));
		$fileName		=	explode('.', $fileName)[0];
		$validExtension	=	['jpg', 'jpeg', 'png'];

		if(in_array($fileExtension,$validExtension))
		{
			if($fileSize < 5242880)
			{
				if($fileError === 0)
				{
					$fileNameNew		=	$fileName . '.' . $fileExtension;
					$fileDestination	=	IMG_DIR . $fileNameNew;
					move_uploaded_file($fileTmpName, $fileDestination);
					echo '<div class="alert alert-success" role="alert">Файл успешно загружен</div>';
				} else {
					echo'<div class="alert alert-danger" role="alert">Что-то пошло не так..</div>';
				}
			} else {
				echo'<div class="alert alert-danger" role="alert">Слишком большой размер файла</div>';
			}
		} else {
			echo'<div class="alert alert-danger" role="alert">Неверный тип файла</div>';
		}
	}
?>
		<form enctype="multipart/form-data" action="index.php" method="post">
			<div class="form-group">
				<input type="file" name="image_file">
			</div>
			<button type="submit" name="submit" class="btn btn-primary">Загрузить</button>
		</form>

		<div class="d-flex align-content-center flex-wrap">
			<?php
				$listOfFiles	=	scandir(IMG_DIR);
				foreach ($listOfFiles as $file) {
					if ($file != '.'	&&	$file != '..'	&&	is_file(IMG_DIR . $file)) {
						echo'<div class="img">
							<a href="#" target="_blank">
								<img src="' . IMG_DIR . $file . '" alt="IT" width="500" height="400" class="img-fluid rounded shadow-sm">
							</a>
						</div>';
					}
				}
			?>
		</div>

	</div>

	<footer class="footer text-center">
		<div class="container">
			<span class="text-muted">Уфа © 2021</span>
		</div>
	</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


</body> 
