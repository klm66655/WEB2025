<?php
require_once __DIR__ . '/../db.php'; 

class UserDao {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }
    

    
    public function getAllUsers() {
        $stmt = $this->connection->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function getUserById($id) {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    
    public function createUser($data) {
        $stmt = $this->connection->prepare(
            "INSERT INTO users (username, email, password, role, created_at)
             VALUES (:username, :email, :password, :role, NOW())"
        );
    
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':email', $data['email']);
    
        
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashedPassword);
    
        $role = $data['role'] ?? 'user'; 
        $stmt->bindParam(':role', $role);
    
        return $stmt->execute();
    }
    

    
    public function deleteUser($id) {
        $stmt = $this->connection->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    
    public function updateUser($id, $data) {
        $stmt = $this->connection->prepare(
            "UPDATE users SET username = :username, email = :email, password = :password, role = :role WHERE id = :id"
        );
    
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
    
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $data['role']);
        $stmt->bindParam(':id', $id);
    
        return $stmt->execute();
    }


    public function getUserByEmail($email) {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    
}





?>