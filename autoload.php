<?php
class Autoloader {
    static public function loader($className) {
		//$filename = str_replace('_', DIRECTORY_SEPARATOR, strtolower($className)).'.php';
		$filename = explode("\\", $className);
		$file = $filename[0] . '/' . $filename[1] . ".php";
		if (!file_exists($file)){
			return FALSE;
		}
		include $file;
	}
}
spl_autoload_register('Autoloader::loader');