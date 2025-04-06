<?php
class Database {
    private $host = 'localhost';
    private $dbName = 'movie_app'; 
    private $dbPort = 3306;
    private $username = 'root';
    private $password = '';
    private $connection;

    public function __construct() {
        try {
            $this->connection = new PDO(
                "mysql:host={$this->host};dbname={$this->dbName};port={$this->dbPort}",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            throw $e;
        }
    }

    
    public function getConnection() {
        return $this->connection;
    }
}
?>
