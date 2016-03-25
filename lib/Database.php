<?php
namespace lib;
use \PDO as PDO;

class Database {
    private static $connection;
	private $db;
	public $fetchMode = PDO::FETCH_ASSOC;
	
	public function __construct(){
		require_once('./config/database.php');
		$this->db = $database['default'];
	}

    public function connect() {    
        if(!isset(self::$connection)) {
            try {
                self::$connection = new PDO("mysql:host={$this->db['host']};port={$this->db['port']};dbname={$this->db['dbname']};charset={$this->db['charset']}", $this->db['user'], $this->db['password']);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
                return self::$connection;
            } catch(PDOException $e) {
                echo 'Erro: ' . $e->getMessage();
            }
        }
        if(self::$connection === false) {
			throw new Exception('Não pôde ser estabelecida a conexão com o Banco de dados');
            return false;
        }
    }

    public function execute($query, $params = array()) {
        try {
            $this->connect();
			$statement = self::$connection->prepare($query);
            $statement->execute($params);
            $result = true;
        	try {
        		$result = array();
	            while($row = $statement->fetch( $this->fetchMode )){ 
	            	$result[] = $row;
	            }
	            return $result;
        	}catch(\PDOException $e) {
				unset($e);
				return $result;
			}
			//finally{
        		//return $result;
        	//}
        } catch(\PDOException $e) {
            echo 'Erro: '.$e->getMessage();
        }
    }
}