<?php
class Usuario {
    private $conn;
    private $table_name = "Usuarios";

    public $id_usuario;
    public $nombre_completo;
    public $correo;
    public $contraseña;
    public $perfil;
    public $fecha_registro;
    public $estado_cuenta;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function registrar() {
        $query = "INSERT INTO " . $this->table_name . " 
                  (nombre_completo, correo, contraseña, perfil) 
                  VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $this->nombre_completo, $this->correo, $this->contraseña, $this->perfil);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function iniciarSesion() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE correo = ? LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $this->correo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
}
?>
