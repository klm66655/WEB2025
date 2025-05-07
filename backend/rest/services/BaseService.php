<?php

class BaseService {
    protected $dao;

    public function __construct($dao) {
        $this->dao = $dao;
    }

    public function getAll() {
        return $this->dao->query("SELECT * FROM " . $this->dao->getTableName());
    }

    public function getById($id) {
        return $this->dao->query_unique("SELECT * FROM " . $this->dao->getTableName() . " WHERE id = :id", ['id' => $id]);
    }

    public function create($data) {
        return $this->dao->add($data);
    }

    public function update($id, $data) {
        return $this->dao->update($data, $id);
    }

    public function delete($id) {
        return $this->dao->delete($id);
    }
}
