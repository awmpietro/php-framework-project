<?php
namespace Model;
use Model\BaseModel;

class UserModel extends BaseModel{

	function __construct(){
		$this->table = 'user';
		parent::__construct();
	}
	
	public function authenticate($email, $password){
		$this->select(array('id', 'name'));
		$this->from($this->table);
		$this->where(array('email' => $email, 'password' => $password));
		$results = $this->run();
		if($results){
			return $results[0];
		}else{
			return $results;
		}
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