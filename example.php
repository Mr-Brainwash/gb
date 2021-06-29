<?php

// Задание #1

$i = 1;

while ($i <= 100) {
	if ($i % 3 == 0) {	
		echo $i++ . ' ';
	}
	$i++;
}

// Задание #2

echo '<ul>';
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

// Задание #3

$settlements = [
	'Московская область'		=>	['Москва','Зеленоград','Клин'],
	'Ленинградская область'		=>	['Санкт-Петербург','Всеволожск','Павловск','Кронштадт'],
	'Рязанская область' 		=>	['Рязань','Кораблино','Рыбное'],
	'Республика Башкортостан'	=>	['Уфа','Белорецк','Октябрьский','Салават']
];


echo '<ul>';
foreach ($settlements as $key => $city) {
	echo '<li>' . $key . ':</li>';
	echo '<li>' . implode(', ', $city) . '</li>';
}
echo '</ul>';

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

echo translit('Единственная вещь, которая может быть страшнее, чем программист с отвёрткой или разработчик аппаратуры с программой — это пользователь с проволочной пилой и паролем суперпользователя. Элизабет Звики');

// Задание #5

$string	=	'2007 — американская компания Apple представила первый iPhone';
$string	=	preg_replace('/\s+/', '_', $string);
echo $string;

// Задание #6

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
		echo'<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">Услуги</a>';
		echo'<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
			foreach ($items as $item => $item_url) {
				echo '<li><a class="dropdown-item" href='.$item_url.'>'.$item.'</a></li>';
			}
			echo '</ul></li>';
		echo "</ul>";