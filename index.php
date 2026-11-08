<?php
require_once 'conexion.php';
$database = new Conexion();
$db = $database->getConnection();

$query = "SELECT id, nombres, apellidos, correo, fecha_creacion FROM usuarios ORDER BY id DESC";
$stmt = $db->prepare($query);
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        /* Diseño responsivo básico */
        @media screen and (max-width: 600px) {
            table, thead, tbody, th, td, tr { display: block; }
            th { display: none; }
            td { border-bottom: 1px solid #eee; position: relative; padding-left: 50%; }
            td:before { position: absolute; left: 6px; content: attr(data-label); font-weight: bold; }
        }
    </style>
</head>
<body>
    <h2>Usuarios Registrados</h2>
    <a href="registro.php" style="padding: 10px; background: #28a745; color: white; text-decoration: none;">Nuevo Registro</a>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Fecha de Registro</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <!-- htmlspecialchars previene XSS al convertir caracteres especiales en entidades HTML -->
                <td data-label="ID"><?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td data-label="Nombres"><?php echo htmlspecialchars($row['nombres'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td data-label="Apellidos"><?php echo htmlspecialchars($row['apellidos'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td data-label="Correo"><?php echo htmlspecialchars($row['correo'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td data-label="Fecha"><?php echo htmlspecialchars($row['fecha_creacion'], ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>