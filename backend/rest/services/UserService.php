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
        return $this->dao->createUser($data);
    }

    public function updateUser($id, $data) {
        return $this->dao->updateUser($id, $data);
    }

    public function deleteUser($id) {
        return $this->dao->deleteUser($id);
    }
}
