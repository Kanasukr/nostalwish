<?php

define('SITE_ROOT', __DIR__);
session_start();

if(!isset($_SESSION['account_name']) && $_SERVER['REQUEST_URI'] !== "/" 
&& $_SERVER['REQUEST_URI'] !== "/index.php" && $_SERVER['REQUEST_URI'] !== "/functions/login.php") {
	header("Location: /");
	die();
}

?>