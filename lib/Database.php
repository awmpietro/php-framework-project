<?php
namespace lib;
use \PDO;

class Database {
    protected static $connection;
	protected static $fetchMode;

    public function connect() {    
        if(!isset(self::$connection)) {
            $config = parse_ini_file('./config/database.ini'); 
            try {
                self::$connection = new PDO("mysql:host={$config['host']};dbname={$config['database']}", $config['user'], $config['password']);
                self::$connection->setAttribute(\PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

    public function execute($query, $params) {
        try {
            $this->connect();
			$statement = self::$connection->prepare($query);
			if(!empty($params)){
				foreach($params as $key => $value){
					$statement->bindParam(":{key}", $value);
				}
			}
            $statement->execute();
            return $statement;
        } catch(PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }
}