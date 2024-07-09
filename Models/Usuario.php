<?php
class Usuario {
    private $conn;
    private $table_name = "usuarios";

    public $id_usuario;
    public $nombre_completo;
    public $correo;
    public $contraseña;
    public $fecha_registro;
    public $estado_cuenta;
    public $id_perfil;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function registrar() {
        $query = "INSERT INTO " . $this->table_name . " 
                  (nombre_completo, correo, contraseña, id_perfil) 
                  VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssi", $this->nombre_completo, $this->correo, $this->contraseña, $this->id_perfil);

        return $stmt->execute();
    }

    public function iniciarSesion() {
        $query = "SELECT u.*, p.nombre_perfil FROM " . $this->table_name . " u 
                  JOIN perfiles p ON u.id_perfil = p.id_perfil 
                  WHERE correo = ? LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $this->correo);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }
}
?>
