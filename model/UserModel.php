<?php
namespace model;

class UserModel extends BaseModel{

	function __construct(){
		$this->table = 'user';
		parent::__construct();
	}
	
	public function authenticate($email, $password){
		$this->db->select(array('id'));
		$this->db->from($this->table);
		$this->db->where(array('email' => $email, 'password' => $password));
		$results = $this->run();
		return $results;
	}
	
	public function getUsers(){
		$results = $this->db->select("SELECT * FROM {$this->table}");
		return $results;
	}
	
	public function getUser($id){
		$results = $this->db -> select("SELECT * FROM {$this->table}  WHERE id = {$id}");
		return $results;
	}
	
	public function createUser($data){
		extract($data);
		$sql = "INSERT INTO {$this->table} (nome, email, telefone) VALUES ('{$nome}', '{$email}', '{$telefone}')";
		if($this->db->query($sql)){
			return true;
		}else{
			return false;
		}
	}
	
	public function updateUser($id, $data){
		extract($data);
		$sql = "UPDATE {$this->table} SET nome = '{$nome}', email = '{$email}', telefone = '{$telefone}' WHERE id = {$id}";
		if($this->db->query($sql)){
			return true;
		}else{
			return false;
		}	
	}
	
	public function deleteUser($id) {
		$sql = "DELETE FROM {$this->table} WHERE id = {$id}";
		if($this->db->query($sql)){
			return true;
		}else{
			return false;
		}
	}
	
}