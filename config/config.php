<?php
date_default_timezone_set('America/Sao_Paulo');
setlocale (LC_ALL, 'pt_BR');

/* If application is not running in the Apache document root, set the root folder relative to Apache document root (no slashes) */
define("BASE_PATH", "");

/*Default Controller to be loaded when not specified*/
define("DEFAULT_CONTROLLER", "Index");

/*Bower libraries*/
define("FRONT_LIBS", "public/libs");

/*Path for the custom CSS and JS*/
define("FRONT_CSS", "public/css");
define("FRONT_JS", "public/js");