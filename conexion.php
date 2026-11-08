<?php
class Conexion {
    private $host = "localhost";
    private $db_name = "db_sistema_web";
    private $username = "root"; 
    private $password = ""; 
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            // Exigido por la rúbrica: Manejo de excepciones
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            // El error real se registra en el servidor, no se muestra al usuario
            error_log("Error de conexión PDO: " . $exception->getMessage());
            die("Error crítico: No se pudo conectar a la base de datos.");
        }
        return $this->conn;
    }
}
?>