<?php
<<<<<<< HEAD
require_once "class_autoloader.php";
require_once "config/config.php";
require_once("autoload.php");

=======
session_start();
require __DIR__ . "/config/config.php";
require __DIR__ . "/class_autoloader.php";
require __DIR__ . '/vendor/autoload.php';
$frontController = new Controller\FrontController;
>>>>>>> f52a1ebe0bdcd0c7497a11d1940309751f637eda
$frontController->run();