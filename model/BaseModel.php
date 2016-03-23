<?php
namespace model;
use \lib\Database as Database;

class BaseModel{
	
	protected $db;
	protected $table;
	
	function __construct(){
		$this->db = new Database;
	}
}