<?php 
namespace Lib;

class Session {
	
	function __construct() {
		session_start();
	}
	
	public function set_session($name, $value){
		$_SESSION[$name] = $value;
	}
	
	public function unset_session($name) {
		unset($_SESSION[$name]);
	}
}