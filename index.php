<?php
session_start();
require_once __DIR__ . "/autoload.php";

$frontController = new lib\FrontController;
$frontController->run();