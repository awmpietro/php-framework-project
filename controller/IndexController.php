<?php
namespace Controller;
use Controller\BaseController as BaseController;
use model\ProdutosModel as ProdutosModel;
use lib\FormValidation as FormValidation;
use \Firebase\JWT\JWT as JWT;

class IndexController extends BaseController {
	
	protected $produtos;
	
	function __construct() {
		if(!$this->isLogged()){
			$this->flash('erro', 'Faça login para acessar o sistema', 'danger');
			header ("Location: login");
		}
		$this->css = array(
			'libs/bootstrap/dist/css/bootstrap.min.css',
			'libs/font-awesome/css/font-awesome.min.css',
		);
		$this->js = array(
			'libs/jquery/dist/jquery.js',
			'libs/bootstrap/dist/js/bootstrap.min.js',
			'js/user.js'
		);
	}

	public function index() {
		//$produtosModel = new ProdutosModel();
		//$produtos = $produtosModel->getProdutos();
		//$data = array('produtos' => $produtos);
		$this->view('produtos', $data);
	}
	
	public function adicionar_produto(){
		if( isset($_POST['submit']) ){
			$validation = new FormValidation();
			$_POST = $validation->sanitize($_POST);
			$validation->validation_rules(array(
			    'nome_produto' => 'required|max_len,100|min_len,10',
			    'descricao_produto' => 'required|max_len,100|min_len,10',
			    'preco_produto' => 'required'
			));
			$validation->filter_rules(array(
			    'nome_produto' => 'trim|sanitize_string',
			    'descricao_produto' => 'trim|sanitize_string',
			    'preco_produto'    => 'trim|sanitize_string'
			));
			$validated_data = $validation->run($_POST);
			
			if($validated_data === false) {
				echo $validation->get_readable_errors(true);
				//$this->flash('erro', 'Todos os campos são de preenchimento obrigatório', 'danger');
			}else{
			    $produtosModel = new ProdutosModel();
			    $data = array(
			    	'nome' => $_POST['nome_produto'],
			    	'descricao' => $_POST['descricao_produto'],
			    	'preco' => $_POST['preco_produto']
			    );
			    if($produtosModel->createProduto($data)){
			    	$this->flash('sucesso', 'Produto adicionado com sucesso', 'success');
			    }else{
			    	$this->flash('erro', 'Produto não pode ser adicionado, por favor tente novamente', 'danger');
			    }
			    header("Location: /produtos");
			}
		}else{
			$this->view('adicionar_produto');
		}
	}
	
	public function editar_produto($id){
		if( isset($_POST['submit']) ){
			$produtosModel = new ProdutosModel();
			if(!isset($_POST['nome_produto']) || !isset($_POST['descricao_produto']) || !isset($_POST['preco_produto'])){
				$this->flash('erro', 'Todos os campos são de preenchimento obrigatório', 'danger');
				return;
			}
			$data = array(
				'nome' => filter_var($_POST['nome_produto'], FILTER_SANITIZE_STRING),
				'descricao' => filter_var($_POST['descricao_produto'], FILTER_SANITIZE_STRING),
				'preco' => filter_var($_POST['preco_produto'], FILTER_SANITIZE_STRING)
			);
			if($produtosModel->updateProduto($id, $data)){
				$this->flash('sucesso', 'Produto atualizado com sucesso', 'success');
			}else{
				$this->flash('erro', 'Produto não pode ser atualizado, por favor tente novamente', 'danger');
			}
			header("Location: /produtos");
		}else{
			$produtosModel = new ProdutosModel();
			$produto = $produtosModel->getProduto($id);
			$data = array('produto' => $produto[0]);
			$this->view('editar_produto', $data);
		}
	}
	
	public function remover_produto($id) {
		$produtosModel = new ProdutosModel();
		if($produtosModel->removerProduto($id)){
			$this->flash('sucesso', 'Produto removido com sucesso', 'success');
		}else{
			$this->flash('erro', 'Produto não pode ser removido, por favor tente novamente', 'danger');
		}
		header("Location: /produtos");
	}
}