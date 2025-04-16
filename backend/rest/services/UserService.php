<?php
require_once __DIR__ . '/../dao/UserDao.php';

class UserService {
    private $dao;

    public function __construct($conn) {
        $this->dao = new UserDao($conn);
    }

    public function getAllUsers() {
        return $this->dao->getAllUsers();
    }

    public function getUserById($id) {
        return $this->dao->getUserById($id);
    }

    public function createUser($data) {
        
        $existingUser = $this->dao->getUserByEmail($data['email']);
    
        if ($existingUser) {
            Flight::halt(400, json_encode(["error" => "User with this email already exists."]));
        }
    
        try {
            return $this->dao->createUser($data);
        } catch (PDOException $e) {
            
            throw $e;
        }
    }
    

    public function updateUser($id, $data) {
        return $this->dao->updateUser($id, $data);
    }

    public function deleteUser($id) {
        return $this->dao->deleteUser($id);
    }
}
