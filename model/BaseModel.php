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
	}
	
	public function select($fields = ''){
		if(empty($fields)){
			$this->sql = "SELECT * FROM {$this->table}";
		}else{
			$lastKey = $this->getLastItem($fields);
			$find = '';
			foreach($fields as $key => $field){
				if($key === $lastKey){
					$find .= $key;
				}else{
					$find .= "{$key}, ";
				}
			}
			$this->sql = "SELECT {$find} FROM {$this->table}";
		}
	}
	
	public function create($data){
		$lastKey = $this->getLastItem($data);
		$this->sql = "INSERT INTO ". $this->table ." (";
		foreach($data as $key => $value){
			if($key === $lastKey){
				$this->sql .= "{$key}";
			}else{
				$this->sql .= "{$key}, ";
			}
		}
		$this->sql .= ") VALUES (";
		foreach($data as $key => $value){
			if($key === $lastKey){
				$this->sql .= ":{$key})";
			}else{
				$this->sql .= ":{$key}, ";
			}
			$this->params [":{$key}"] = $value;
		}
	}
	
	public function update($data = ''){
		$lastKey = $this->getLastItem($data);
		$this->sql = "UPDATE ". $this->table ." SET";
		foreach($data as $key => $value){
			if($key === $lastKey){
				$this->sql .= " {$key} = :{$key}";
			}else{
				$this->sql .= " {$key} = :{$key},";
			}
			$this->params[":{$key}"] = $value;
		}
	}
	
	public function delete(){
		$this->sql = "DELETE FROM {$this->table}";
	}
	
	public function where($where = ''){
		$lastKey = $this->getLastItem($where);
		$sql = " WHERE";
		foreach($where as $key => $value){
			if($key === $lastKey){
				$sql .= " {$key} = :{$key}";
			}else{
				$sql .= " {$key} = :{$key} AND";
			}
			$this->params[":{$key}"] = $value;
		}
		$this->sql .= $sql;
	}
	
	public function orderBy($fields){
		$mode = array('ASC', 'DESC');
		$sql = " ORDER BY";
		if(is_array($fields)){
			$lastKey = $this->getLastItem($fields);
			foreach($fields as $key => $value){
				if($key === $lastKey){
					if(in_array($value, $mode)){
						$sql .= " {$key} {$value}";
					}else{
						$sql .= " {$value}";
					}
				}else{
					if(in_array($value, $mode)){
						$sql .= " {$key} {$value}, ";
					}else{
						$sql .= " {$value}, ";
					}
				}
			}
		}else{
			$sql .= " {$fields}";
		}
		$this->sql .= $sql;
	}
	
	private function getLastItem($data){
		$keys = array_keys($data);
		$lastKey = array_pop($keys);
		return $lastKey;
	}
	
	public function run(){
		$results = $this->db->execute($this->sql, $this->params);
		return $results;
	}
}