<?php
session_start();
require __DIR__ . "/config/config.php";
require __DIR__ . "/class_autoloader.php";
require __DIR__ . '/vendor/autoload.php';
$frontController = new Controller\FrontController;
$frontController->run();