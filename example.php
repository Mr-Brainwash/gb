<?php

// Задание #1

$a = rand(-13,13);
$b = rand(-13,13);

if ($a >= 0 && $b >= 0) {

	$d = (int)$a - (int)$b;

} else if ($a < 0 && $b < 0) {

	$d = (int)$a * (int)$b;

} else {
	$d = (int)$a + (int)$b;
}

// Задание #2

$c = rand(0, 15);

// switch($c) {
// 	case 0: echo 0 . ' ';
// 	case 1: echo 1 . ' ';
// 	case 2: echo 2 . ' ';
// 	case 3: echo 3 . ' ';
// 	case 4: echo 4 . ' ';
// 	case 5: echo 5 . ' ';
// 	case 6: echo 6 . ' ';
// 	case 7: echo 7 . ' ';
// 	case 8: echo 8 . ' ';
// 	case 9: echo 9 . ' ';
// 	case 10: echo 10 . ' ';
// 	case 11: echo 11 . ' ';
// 	case 12: echo 12 . ' ';
// 	case 13: echo 13 . ' ';
// 	case 14: echo 14 . ' ';
// 	case 15: echo 15 . ' ';
// }

// Задание #3

function addition($a, $b)
{
	return $a + $b;
}

function subtraction($a, $b)
{
	return $a - $b;
}

function multiplication($a, $b)
{
	return $a * $b;
}

function division($a, $b)
{
	return $a / $b;
}

// Задание #4

function mathOperation($arg1, $arg2, $operation)
{
	switch($operation) {
		case 'сложение':
			echo addition($arg1, $arg2);
			break;
		case 'вычитание':
			echo subtraction($arg1, $arg2);
			break;
		case 'умножение':
			echo multiplication($arg1, $arg2);
			break;
		case 'деление':
			echo division($arg1, $arg2);
			break;
	}
}

// Задание #5

// Задание #6
