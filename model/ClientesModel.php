<?php
namespace model;

class ClientesModel extends BaseModel{

	function __construct(){
		$this->table = 'cliente';
		parent::__construct();
	}
	
	public function getClientes(){
		$results = $this->db->select("SELECT * FROM {$this->table}");
		return $results;
	}
	
	public function getCliente($id){
		$results = $this->db -> select("SELECT * FROM {$this->table}  WHERE id = {$id}");
		return $results;
	}
	
	public function createCliente($data){
		extract($data);
		$sql = "INSERT INTO {$this->table} (nome, email, telefone) VALUES ('{$nome}', '{$email}', '{$telefone}')";
		if($this->db->query($sql)){
			return true;
		}else{
			return false;
		}
	}
	
	public function updateCliente($id, $data){
		extract($data);
		$sql = "UPDATE {$this->table} SET nome = '{$nome}', email = '{$email}', telefone = '{$telefone}' WHERE id = {$id}";
		if($this->db->query($sql)){
			return true;
		}else{
			return false;
		}	
	}
	
	public function removerCliente($id) {
		$sql = "DELETE FROM {$this->table} WHERE id = {$id}";
		if($this->db->query($sql)){
			return true;
		}else{
			return false;
		}
	}
	
}