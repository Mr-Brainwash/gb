<?php
	require 'base.php';
	const IMG_DIR	=	'uploads/'; 
?>
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
		<div class="row">
			<div class="offset-md-2 mt-3">
				<div class="card">
					<?php
 					if(isset($_GET['id']))
					{
						$result	=	$dbh->query('SELECT * FROM images WHERE id = '.$_GET['id'].'');
						foreach ($result as $res) {
							$image  = IMG_DIR . $res['id'] . $res['imgname'] .'.'. $res['extension'];
							echo'<img src="'.$image.'" alt="IT"  width="600" height="500" class="card-img-top">'; 
						}
					}	
					
					?>
				</div>
			</div>
		</div>
		

	</div>

	<footer class="footer text-center">
		<div class="container">
			<span class="text-muted">Уфа © <?=date('Y')?></span>
		</div>
	</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


</body> 
