<?php
namespace lib;
use \PDO;

class Database {
    protected static $connection;

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

    public function query($query) {
        try {
            $this -> connect();
            $data = self::$connection->query($query);
            return $data;
        } catch(PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }

    public function select($query) {
        $rows = array();
        $result = $this -> query($query);
        if($result === false) {
            return false;
        }
        while($row = $result->fetch( PDO::FETCH_ASSOC )){ 
             $rows[] = $row;
        }
        return $rows;
    }
}