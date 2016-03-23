<?php
namespace model;
use \lib\Database as Database;

class BaseModel{
	
	protected $db;
	protected $table;
	protected $params = array();
	protected $sql;
	
	public function __construct(){
		$this->db = new Database;
		$this->db::fetchMode = PDO::FETCH_ASSOC;
	}
	
	public function select($fields = ''){
		if(empty($fields)){
			$sql = "SELECT * FROM {$this->table}";
		}else{
			$find = '';
			foreach($fields as $field){
				if($field === end($fields)){
					$find .= $key;
				}else{
					$find .= $key . ', ';
				}
			}
			$sql = "SELECT {$find} FROM {$this->table}";
		}
		$this->sql = $sql;
	}
	
	public function where($where = ''){
		$sql .= " WHERE";
		foreach($where as $key => $value){
			if($value === end($where)){
				$sql .= " {$key} = :{$key}";
			$this->params = array($key => $value);
			}else{
				$sql .= " {$key} = :{$key} AND";
				$this->params = array($key => $value);
			}
		}
		$this->sql .= $sql;
	}
	
	public function create($data){
		$params = array();
		$sql = "INSERT INTO ". $this->table ." (";
		foreach($data as $key => $value){
			if($value === end($data)){
				$sql .= "{$key}";
			}else{
				$sql .= "{$key}, ";
			}
		}
		$sql .= ") VALUES (";
		foreach($data as $key => $value){
			if($value === end($data)){
				$sql .= ":{$key})";
			}else{
				$sql .= ":{$key}, ";
			}
			$params[":{key}"] = $value;
		}
		$this->params = $params;
		$this->sql = $sql;
	}
	
	public function update($id = '', $data = ''){
		extract($data);
		$this->sql = "UPDATE ". $this->table . " SET nome = :nome, descricao = :descricao, preco = :preco WHERE id = :id";
		$this->params = array(':nome' => $nome, ':descricao' => $descricao, ':preco' => $preco);
	}
	
	public function delete($id = ''){
		$this->sql = "DELETE FROM {$this->table} WHERE id = :id";
		$this->params = array(':id' => $id);
	}
	
	public function run(){
		$results = $this->db->execute($this->sql, $this->params);
		$rows = array();
		while($row = $results->fetch( $this->db::fetchMode )){ 
			$rows[] = $row;
		}
		return $rows;
	}
}