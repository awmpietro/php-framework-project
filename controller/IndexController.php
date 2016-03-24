<?php
namespace Controller;
use Controller\BaseController as BaseController;
use model\ProdutosModel as ProdutosModel;

class IndexController extends BaseController {
	
	protected $produtos;
	
	function __construct() {
		$this->active = 'produtos';
	}

	public function index() {
		$produtosModel = new ProdutosModel();
		$produtos = $produtosModel->getProdutos();
		$data = array('produtos' => $produtos);
		$this->view('produtos', $data);
	}
	
	public function adicionar_produto(){
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
			if($produtosModel->createProduto($data)){
				$this->flash('sucesso', 'Produto adicionado com sucesso', 'success');
			}else{
				$this->flash('erro', 'Produto não pode ser adicionado, por favor tente novamente', 'danger');
			}
			header("Location: /produtos");
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