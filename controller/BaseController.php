<?php
namespace Controller;

class BaseController {
	public $content;
	public $active;
	
	public function view($template, $data = array()){
		if(!empty($data)){
			extract($data);
		}
		ob_start();
		require_once('view/' . $template . ".php");
		$this->content = ob_get_clean();
		require_once('view/layout.php');
	}
	
	public function flash($name = '', $message = '', $class = 'success'){
	    if(!empty($name)){
	        if(!empty( $message ) && empty( $_SESSION[$name])){
	            if(!empty( $_SESSION[$name] ) ){
	                unset( $_SESSION[$name] );
	            }
	            if(!empty( $_SESSION[$name.'_class'] ) ){
	                unset( $_SESSION[$name.'_class'] );
	            }
	            $_SESSION[$name] = $message;
	            $_SESSION[$name.'_class'] = $class;
	        }
	        elseif(!empty($_SESSION[$name]) && empty($message)){
	            $class = !empty( $_SESSION[$name.'_class'] ) ? $_SESSION[$name.'_class'] : 'success';
	            echo '<div class="alert alert-'.$class.' alert-dismissible" role="alert" id="msg-flash">';
	            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	            echo $_SESSION[$name];
	            echo '</div>';
	            unset($_SESSION[$name]);
	            unset($_SESSION[$name.'_class']);
	        }
	    }
	}
}