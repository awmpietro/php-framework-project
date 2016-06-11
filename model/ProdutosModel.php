<?php
namespace Model;

class ProdutosModel extends BaseModel{
	
	function __construct(){
		$this->table = 'produto p';
		parent::__construct();
	}
	
	public function getProdutos(){
		$this->select();
		$this->from($this->table);
		$results = $this->run();
		return $results;
	}
	
	public function getProduto($id){
		$find = array('id' => $id);
		$this->select();
		$this->where($find);
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
		$find = array('id' => $id);
		$this->update($data);
		$this->where($find);
		if($this->run()){
			return true;
		}else{
			return false;
		}
	}
	
	public function removerProduto($id) {
		$find = array('id' => $id);
		$this->delete();
		$this->where($find);
		if($this->run()){
			return true;
		}else{
			return false;
		}
	}
}