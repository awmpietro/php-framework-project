<?php
namespace lib;
use controller\ProdutoController as ProdutoController;

class FrontController
{
    const DEFAULT_CONTROLLER = "Produtos";
    const DEFAULT_ACTION     = "index";
    
    protected $controller    = self::DEFAULT_CONTROLLER;
    protected $action        = self::DEFAULT_ACTION;
    protected $params        = array();
    protected $basePath      = "/";
    
    public function __construct(array $options = array()) {
        if (empty($options)) {
           $this->parseUri();
        }
        else {
            if (isset($options["controller"])) {
                $this->setController($options["controller"]);
            }
            if (isset($options["action"])) {
                $this->setAction($options["action"]);     
            }
            if (isset($options["params"])) {
                $this->setParams($options["params"]);
            }
        }
    }
    
    protected function parseUri() {
        $path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
        if($path == ''){
        	$this->setController($this->controller);
        	$this->setAction($this->action);
        }else{
        	@list($controller, $action, $params) = explode("/", $path, 3);
        	if (isset($controller)){
        	    $this->setController($controller);
        	}
        	if (isset($action)){
        	    $this->setAction($action);
        	}
        	if (isset($params)){
        	    $this->setParams(explode("/", $params));
        	}
        } 
    }
    
    public function setController($controller) {
        $controller = ucfirst(strtolower($controller)) . "Controller";
        $controller = "controller\\" . $controller;
        if (!class_exists($controller)) {
        	header("HTTP/1.0 404 Not Found");
        	echo "<h1>404 Not Found</h1>";
        	echo "Página não encontrada. Ir para <a href='/produtos'>Home</a>";
        	exit();
    	}
        $this->controller = $controller;
        return $this;
    }
    
    public function setAction($action) {
        $reflector = new \ReflectionClass($this->controller);
        if (!$reflector->hasMethod($action)) {
            header("HTTP/1.0 404 Not Found");
            echo "<h1>404 Not Found</h1>";
            echo "Página não encontrada. Ir para <a href='/produtos'>Home</a>";
            exit();
    	}
        $this->action = $action;
        return $this;
    }
    
    public function setParams(array $params) {
        $this->params = $params;
        return $this;
    }
    
    public function run() {
        call_user_func_array(array(new $this->controller, $this->action), $this->params);
    }
}