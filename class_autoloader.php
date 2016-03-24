<?php
class Autoloader {
    static public function loader($className) {
		$path = explode("\\", $className);
		$file = '';
		$keys = array_keys($path);
		$lastKey = array_pop($keys);
		foreach($path as $key => $value){
			if($key === $lastKey){
				$file .= $value . ".php";
			}else{
				$file .= strtolower($value) . '/';
			}
		}
		if (!file_exists($file)){
			return FALSE;
		}
		include $file;
	}
}
spl_autoload_register('Autoloader::loader');