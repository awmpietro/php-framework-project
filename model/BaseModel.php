<?php
namespace Model;
use \lib\Database as Database;

class BaseModel{
	
	protected $db;
	protected $params = array();
	protected $sql;
	protected $table;
	
	public function __construct(){
		$this->db = new Database;
	}
	
	/**
	* Abstraction of the SELECT clause in query.
	* @params optional $fields = array of specific fields to select. If $fields is empty will perform a select all.
	*/
	public function select($fields = ''){
		if(empty($fields)){
			$this->sql = "SELECT *";
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
			$this->sql = "SELECT {$find}";
		}
	}
	
	/**
	* Abstraction of the FROM clause in query.
	* @params associative array of table names or string with a single table name
	*/
	public function from($tables = ''){
		$this->sql .= " FROM";
		if(is_array($tables)){
			$lastKey = $this->getLastItem($fields);
			foreach ($tables as $table) {
				if($key === $lastKey){
					$this->sql .= "{$table}";
				}else{
					$this->sql .= "{$table}, ";
				}
			}
		}else{
			$this->table = $tables;
			$this->sql .= " {$tables}";
		}
	}
	
	/**
	* Abstraction of the INSERT clause in query.
	* @params $data = associative array where the keys are the fields and the values the corresponding values for each field.
	*/
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
	
	/**
	* Abstraction of the UPDATE clause in query.
	* @params $data = associative array where the keys are the fields to update and the values the corresponding values for each field.
	*/
	public function update($data){
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
	
	/**
	* Abstraction of the DELETE clause in query.
	* WARNING: Used in conjunction with self::where(), otherwise it will remove all fields in a table.
	*/
	public function delete(){
		$this->sql = "DELETE FROM {$this->table}";
	}
	
	/**
	* Abstraction of the WHERE clause in query.
	* @params $where = associative array where the keys are the table fields and the $values are the corresponding fields values.
	*/
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
	
	/**
	* Abstraction of the JOIN clause in query.
	* @params $table = string name of the table to join
	* @params $match = 1 length associative array where the key is the matching field from original table and $value the matching field from joined table
	* @params $mode = optional string mode of JOIN. Can be INNER, LEFT, RIGHT...
	*/
	public function join($table, $match, $mode = ''){
		$keys = array_keys($match);
		$key = $keys[0];
		if($mode != ''){
			$this->sql .= " {$mode} JOIN {$table} ON {$key} = {$match[$key]}";
		} else{
			$this->sql .= " JOIN {$table} ON {$key} = {$match[$key]}";
		}
	}
	
	/**
	* Abstraction of the ORDER BY clause in query.
	* @params $fields = associative array where the keys are the fields and the values are ASC or DESC, or $fields = string representing one field. 
	*/
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
	
	/**
	* Abstraction of the LIMIT and OFFSET clauses in query.
	* @params $limit = integer to limit, $offset = integer to offset.
	*/
	public function limit($limit, $offset = ''){
		$sql = " LIMIT {$limit}";
		if($offset != ''){
			$sql .= " OFFSET {$offset}";
		}
		$this->sql .= $sql;
	}
	
	/**
	* This is an utility function to return last key of an array
	* @params $data = array
	*/
	private function getLastItem($data){
		$keys = array_keys($data);
		$lastKey = array_pop($keys);
		return $lastKey;
	}
	
	/**
	* Function that calls the execute method, which will execute the query in database. Should be called for last.
	*/
	public function run(){
		print_r($this->sql);exit;
		$results = $this->db->execute($this->sql, $this->params);
		return $results;
	}
}