<?php

class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'gestionlsj';

    private $connection;

    public function __construct() {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->database";
            $this->connection = new PDO($dsn, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connexion echouee: ' . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}
