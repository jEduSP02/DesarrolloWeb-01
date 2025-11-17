<?php
// configuracion.php
$DB_HOST = 'localhost';
$DB_NAME = 'usuariosdb';
$DB_USER = 'jESP';
$DB_PASS = '2025.amaruTECH';

// Crear conexión
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

// Comprobar conexión
if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}
session_start();
?>
