<?php

$ini = parse_ini_file('config.ini');

$host 	= 'localhost';
$dbname = $ini['db_name'];
$user 	= $ini['db_user'];
$pass 	= $ini['db_password'];

try
{
	$dbh = new PDO("mysql:host=$host;dbname=$dbname;charset=UTF8;", $user, $pass);
}
catch(PDOException $e)
{
	echo "Не удалось соединиться с БД: ".$e->getMessage();
}