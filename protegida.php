<?php
require 'configuracion.php';

// verificar sesión
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$stmt = $mysqli->prepare('SELECT contUsuario, nombre, correo FROM usuarios WHERE contUsuario = ?');
$stmt->bind_param('i', $_SESSION['user_id']); 
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
} else {
    // Redirigir a la página HTML
    header('Location: index.php');
    exit(); // salida después de redirigir
}
?>
