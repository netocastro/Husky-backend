<?php

session_start();

$s = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 's' : '');

define("BASE_PATH", "http{$s}://{$_SERVER['HTTP_HOST']}/development/entrevistas/Husky");

define('DATA_LAYER_CONFIG', [
	'driver' => 'mysql',
	'host' => 'localhost',
	'port' => '3306',
	'dbname' => 'backend_husky',
	'username' => 'root',
	'passwd' => '',
	'options' => [
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
		PDO::ATTR_CASE => PDO::CASE_NATURAL,
	],
]);