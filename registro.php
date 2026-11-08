<?php
require_once 'conexion.php';
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombres = trim($_POST['nombres']);
    $apellidos = trim($_POST['apellidos']);
    $correo = trim($_POST['correo']);

    if (!empty($nombres) && !empty($apellidos) && filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        try {
            $database = new Conexion();
            $db = $database->getConnection();

            $query = "INSERT INTO usuarios (nombres, apellidos, correo) VALUES (:nombres, :apellidos, :correo)";
            $stmt = $db->prepare($query);

            $stmt->bindParam(':nombres', $nombres);
            $stmt->bindParam(':apellidos', $apellidos);
            $stmt->bindParam(':correo', $correo);

            if ($stmt->execute()) {
                $mensaje = "<div class='exito'>Usuario registrado exitosamente.</div>";
            }
        } catch (PDOException $e) {
            $mensaje = "<div class='error'>Error al registrar: El correo podría ya estar en uso.</div>";
        }
    } else {
        $mensaje = "<div class='error'>Por favor, complete todos los campos correctamente.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuarios</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        .form-group input { padding: 8px; width: 100%; max-width: 300px; }
        .btn { padding: 10px 15px; background: #007bff; color: white; border: none; cursor: pointer; }
        .exito { color: green; } .error { color: red; }
    </style>
</head>
<body>
    <h2>Registrar Nuevo Usuario</h2>
    <?php echo $mensaje; ?>
    <form method="POST" action="registro.php">
        <div class="form-group">
            <label>Nombres:</label><br>
            <input type="text" name="nombres" required>
        </div>
        <div class="form-group">
            <label>Apellidos:</label><br>
            <input type="text" name="apellidos" required>
        </div>
        <div class="form-group">
            <label>Correo Electrónico:</label><br>
            <input type="email" name="correo" required>
        </div>
        <button type="submit" class="btn">Registrar</button>
    </form>
    <br>
    <a href="index.php">Ver Registros</a>
</body>
</html>