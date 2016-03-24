<?php
date_default_timezone_set('America/Sao_Paulo');
setlocale (LC_ALL, 'pt_BR');

/* If application is not running in the Apache document root, set the root folder relative to Apache document root (no slashes) */
const BASE_PATH = "front";
const DEFAULT_CONTROLLER = "Index";