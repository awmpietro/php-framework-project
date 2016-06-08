<?php
namespace Controller;
use Controller\BaseController as BaseController;
use model\UserModel as UserModel;
use lib\FormValidation as FormValidation;
use \Firebase\JWT\JWT as JWT;

class LoginController extends BaseController {
	
	function __construct() {
		$this->css = array(
			'libs/bootstrap/dist/css/bootstrap.min.css',
			'css/signin.css',
			'libs/font-awesome/css/font-awesome.min.css',
		);
		$this->js = array(
			'libs/jquery/dist/jquery.js',
			'libs/bootstrap/dist/js/bootstrap.min.js',
			'js/login.js'
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
		$user = $userModel->authenticate($email, $password);
		if($user){
			$unencodedArray = $this->setJWT($user);
			echo json_encode($unencodedArray);
		}
	}
	
	private function setJWT($user){
		$tokenId    = base64_encode(mcrypt_create_iv(32));
		$issuedAt   = time();
		$notBefore  = $issuedAt + 10;             //Adding 10 seconds
		$expire     = $notBefore + 60;            // Adding 60 seconds
		
		/*
		 * Create the token as an array
		 */
		$data = [
			'iat'  => $issuedAt,         // Issued at: time when the token was generated
			'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
			'nbf'  => $notBefore,        // Not before
			'exp'  => $expire,           // Expire
			'data' => [                  // Data related to the signer user
				'userId'   => $user['id'], // userid from the users table
				'userName' => $user['name'], // User name
			]
		];
		$secretKey = base64_decode(SERVER_KEY);
		$jwt = JWT::encode(
			$data,      //Data to be encoded in the JWT
			$secretKey, // The signing key
			'HS512'     // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
		);
		
		$unencodedArray = ['jwt' => $jwt];
		return $unencodedArray;
	}
	
}