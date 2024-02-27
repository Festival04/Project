<?php
// 02.2024 Artur Z (HUSKI3@GitHub)
class Repository {
    protected $conn;

    public function __construct() {
        $this->conn = sql_connect("db.sql");
    }
}
?>