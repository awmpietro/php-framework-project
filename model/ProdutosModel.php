<?php
namespace model;
use model\BaseModel as BaseModel;

class ProdutosModel extends BaseModel{
	
	function __construct(){
		$this->table = 'produto';
		parent::__construct();
	}
	
	public function getProdutos(){
		$results = $this->db->select("SELECT * FROM " . $this->table);
		return $results;
	}
	
	public function getProduto($id){
		$results = $this->db->select("SELECT * FROM " . $this->table . " WHERE id = " . $id);
		return $results;
	}
	
	public function createProduto($data){
		extract($data);
		$sql = "INSERT INTO ". $this->table ." (nome, descricao, preco) VALUES ('" . $nome . "','" . $descricao . "','" . $preco . "')";
		//print_r($sql);exit;
		if($this->db->query($sql)){
			return true;
		}else{
			return false;
		}
	}
	
	public function updateProduto($id, $data){
		extract($data);
		$sql = "UPDATE ". $this->table . " SET nome = '" .$nome. "', descricao = '".$descricao."', preco = '" .$preco."' WHERE id = ".$id."";
		//print_r($sql);exit;
		if($this->db->query($sql)){
			return true;
		}else{
			return false;
		}
	}
	
	public function removerProduto($id) {
		$sql = "DELETE FROM {$this->table} WHERE id = {$id}";
		//print_r($sql);exit;
		if($this->db->query($sql)){
			return true;
		}else{
			return false;
		}
	}
}