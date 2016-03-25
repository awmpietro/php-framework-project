<?php
session_start();
require_once __DIR__ . "/config/config.php";
require_once __DIR__ . "/class_autoloader.php";
$frontController = new Controller\FrontController;
$frontController->run();