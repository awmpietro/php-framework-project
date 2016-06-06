<?php
namespace Controller;
use Controller\BaseController as BaseController;
use model\UserModel as UserModel;
use lib\FormValidation as FormValidation;

class LoginController extends BaseController {
	
	function __construct() {
		$this->css = array(
			'libs/bootstrap/dist/css/bootstrap.min.css',
			'css/signin.css',
			'libs/font-awesome/css/font-awesome.min.css',
		);
		$this->js = array(
			'libs/jquery/dist/jquery.js',
			'libs/bootstrap/dist/js/bootstrap.min.js'
		);
	}

	public function index() {
		$this->active = 'login';
		$this->view('login');
	}
	
	public function authenticate(){
		$email = $_POST['email'];
		$password = $_POST['password'];
		$userModel = new UserModel();
		if($userModel->authenticate($email, $password)){
			
		}
	}
	
}