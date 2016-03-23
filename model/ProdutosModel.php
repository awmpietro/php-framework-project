<?php
namespace model;
use model\BaseModel as BaseModel;

class ProdutosModel extends BaseModel{
	
	function __construct(){
		$this->table = 'produto';
		parent::__construct();
	}
	
	public function getProdutos(){
		$results = $this->select();
		$results = $this->run();
		return $results;
	}
	
	public function getProduto(){
		$data = array('id' => $id);
		$this->select();
		$this->where($data);
		$results = $this->run();
		return $results;
	}
	
	public function createProduto($data){
		$this->create($data);
		if($this->run()){
			return true;
		}else{
			return false;
		}
	}
	
	public function updateProduto($id, $data){
		$this->update($id, $data);
		if($this->run()){
			return true;
		}else{
			return false;
		}
	}
	
	public function removerProduto($id) {
		$this->delete($id);
		if($this->run()){
			return true;
		}else{
			return false;
		}
	}
}