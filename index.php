<?php
	session_unset();
	require_once  'controller/productController.php';
    $controller = new productController();
    $controller->mvcHandler();
?>