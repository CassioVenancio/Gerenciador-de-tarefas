<?php

class Conexao{
    private $host = '127.0.0.1:3307';
    private $dbName = 'pdo';
    private $user = 'root';
    private $password = 'root';

    public function conectar(){
        try {
            $conexao = new PDO(
                "mysql:host=$this->host;dbname=$this->dbName",
                "$this->user",
                "$this->password"
            );
            return $conexao;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}