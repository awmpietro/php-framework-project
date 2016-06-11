<?php
date_default_timezone_set('America/Sao_Paulo');
setlocale (LC_ALL, 'pt_BR');

/* If application is not running in the Apache document root, set the root folder relative to Apache document root (no slashes) */
const BASE_PATH = "php-framework-project";
const DEFAULT_CONTROLLER = "Login";
const SERVER_KEY = '123456';