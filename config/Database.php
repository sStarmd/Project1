<?php
class Database {
    private $host = "localhost";
    private $db_name = "proyecto_sena_1";
    private $username = "root";
    private $password = "";
    public $conn;

    // Hacer que el constructor sea público
    public function __construct() {
        $this->conn = $this->getConnection();
    }

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            echo "Error de conexión: " . $e->getMessage();
        }

        return $this->conn;
    }
}
?>
