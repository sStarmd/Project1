<?php
class Database {
    private static $dbInstance = null;
    private $conn;

    private $host = "localhost";
    private $db_name = "proyecto_sena";
    private $username = "root";
    private $password = "";

    private function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
    }

    public static function getInstance() {
        if (self::$dbInstance === null) {
            self::$dbInstance = new self();
        }
        return self::$dbInstance;
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>
