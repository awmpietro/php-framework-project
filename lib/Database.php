<?php
namespace lib;
use \PDO;

class Database {
    private static $connection;
	public $fetchMode = PDO::FETCH_ASSOC;

    public function connect() {    
        if(!isset(self::$connection)) {
            $config = parse_ini_file('./config/database.ini'); 
            try {
                self::$connection = new PDO("mysql:host={$config['host']};dbname={$config['database']}", $config['user'], $config['password']);
                self::$connection->setAttribute(\PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
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
        	}finally{
        		return $result;
        	}
        } catch(\PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }
}