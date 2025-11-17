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
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Página Principal - Mi top de recomendaciones</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="wrapper">
    <!-- Botón hamburguesa -->
    <button id="menu-toggle" class="hamburger" aria-label="Abrir menú">
      &#9776;  <!-- ☰ -->
    </button>
    <!-- Menú lateral -->
    <nav id="side-nav" class="side-nav">
      <button id="menu-close" class="close-btn" aria-label="Cerrar menú">&times;</button>
      <ul>
        <li><a href=""></a></li>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="libros.php">Libros</a></li>
        <li><a href="peliculas.php">Películas</a></li>
        <li><a href="videojuegos.php">Videojuegos</a></li>
        <li><a href="contacto.php">Contacto</a></li>
        <li><a href="logout.php">Cerrar sesión</a></li>
      </ul>
    </nav>
    <header>
      <h1>Bienvenido a Mi Sitio de Reseñas</h1>
    </header>

    <div class="container">
      <h2>Acerca del Sitio</h2>
      <p>El rincón virtual donde la pasión por el entretenimiento se mezcla con un compromiso sincero por compartir opiniones honestas y constructivas. Nuestro sitio nace con la convicción de que cada experiencia, ya sea una película, un videojuego, un libro o cualquier otra forma de arte, merece ser apreciada y analizada con generosidad y respeto. Aquí encontrarás reseñas detalladas, recomendaciones inspiradoras y un espacio donde cada opinión se plasma con la intención de enriquecer y acompañar a nuestra comunidad amante de la cultura y el ocio. Te invitamos a sumergirte en nuestros contenidos y a descubrir un mundo donde la bondad y la honestidad son los motores que impulsan cada reseña. ¡Disfruta de la experiencia y comparte tu pasión con nosotros!
En este sitio encontrarás reseñas de libros, películas y videojuegos. Nuestro objetivo es compartir opiniones e información sobre lo último y lo mejor en entretenimiento.</p>
    </div>

    <footer>
      <p>&copy; 2025 Top de recomendaciones - por: jESP</p>
    </footer>
  </div>

  <script src="script.js"></script>
</body>
</html>

