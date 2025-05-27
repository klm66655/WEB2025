<?php
require_once __DIR__ . '/BaseDaov2.php';

class AuthDao extends BaseDaov2 {

    public function __construct() {
        parent::__construct("users"); 
    }

    public function get_user_by_email($email) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
        return $this->query_unique($query, ['email' => $email]);
    }
}
