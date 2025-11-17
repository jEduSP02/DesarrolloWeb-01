<?php
require 'configuracion.php';

// Middleware simple: verificar sesión
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Cargar datos frescos del usuario
$stmt = $mysqli->prepare('SELECT contUsuario, nombre, correo FROM usuarios WHERE contUsuario = ?');
$stmt->bind_param('i', $_SESSION['user_id']); // 'i' porque contUsuario es un entero
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($contUsuario, $nombre, $correo);
$stmt->fetch();

if (!$contUsuario) {
    // Si el usuario ya no existe, cerrar sesión
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}

// Ruta base de los archivos
$baseDir = 'D:/XAMPP/htdocs/01_intento/descargas/';
// Obtiene el nombre del archivo desde la URL
$fileName = $_GET['file'] ?? '';

if (!empty($fileName)) {
    $file = $baseDir . basename($fileName); // Asegúrate de usar basename para evitar problemas de seguridad

    if (file_exists($file)) {
        // Establecer las cabeceras para la descarga
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));

        // Limpiar el búfer de salida
        flush();

        // Leer el archivo
        readfile($file);
        exit;
    } else {
        // Manejo del error si el archivo no existe
        echo "El archivo no existe.";
    }
} else {
    echo "No se ha seleccionado ningún archivo.";
}

$stmt->close(); // Cerrar la declaración después de su uso
?>
