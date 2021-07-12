<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

session_start();

$data   =   $_POST;
$userId	=   $_SESSION['id'];
$hash   =   $_SESSION['hash'];

require 'config/base.php';

$user   =   $dbh->query('SELECT * FROM users WHERE id = "'.$userId .'" AND hash = "'.$hash .'" AND user_status = 1');

if($user->rowCount())
{
	foreach ($user as $user_row) {
		$username = $user_row['user_name'];
	}
} else {
	header('location:login.php');
	exit;
}
if (isset($data['unlogin'])) 
{
	session_destroy();
	header('location:login.php');
}