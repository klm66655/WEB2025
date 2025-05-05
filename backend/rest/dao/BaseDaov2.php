<?php
require_once __DIR__ . '/../db.php';

class BaseDaov2 {
    public $connection;
    public $table_name;

    public function __construct($table_name) {
        $this->table_name = $table_name;

        try {
            $db = new Database(); 
            $this->connection = $db->getConnection(); 
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function getTableName() {
        return $this->table_name;
    }

    public function query($query, $params = []) {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function query_unique($query, $params = []) {
        $results = $this->query($query, $params);
        return reset($results);
    }

    public function add($entity) {
        $columns = array_keys($entity);
        $query = "INSERT INTO " . $this->table_name . " (" . implode(',', $columns) . ") VALUES (:" . implode(',:', $columns) . ")";
        $stmt = $this->connection->prepare($query);
        $stmt->execute($entity);
        $entity['id'] = $this->connection->lastInsertId();
        return $entity;
    }

    public function update($entity, $id, $id_column = "id") {
        $set = [];
        foreach ($entity as $column => $value) {
            $set[] = "$column = :$column";
        }
        $query = "UPDATE " . $this->table_name . " SET " . implode(", ", $set) . " WHERE $id_column = :id";
        $stmt = $this->connection->prepare($query);
        $entity['id'] = $id;
        $stmt->execute($entity);
        return $entity;
    }

    public function delete($id) {
        $stmt = $this->connection->prepare("DELETE FROM " . $this->table_name . " WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
}
