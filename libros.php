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
  <title>Reseñas de Libros - Mi top de recomendaciones</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .tooltip {
      display: none;
      position: absolute;
      background-color: rgba(0, 0, 0, 0.7);
      color: white;
      padding: 5px;
      border-radius: 5px;
      z-index: 10;
      font-size: 12px;
    }
  </style>
  <script>
    function showTooltip(event) {
      const tooltip = document.getElementById('tooltip');
      tooltip.style.display = 'block';
      tooltip.style.left = event.pageX + 'px';
      tooltip.style.top = event.pageY + 'px';
      tooltip.textContent = 'Clic para descargar';
    }

    function hideTooltip() {
      const tooltip = document.getElementById('tooltip');
      tooltip.style.display = 'none';
    }
  </script>
</head>
<body>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
      <h1>Bienvenido</h1>
    </header>
  <header>
    <h1>Reseñas de Libros</h1>
  </header>

  <main>
    <section>
      <p>Acá vamos a hablar de tecnología básicamente, aunque con diferentes enfoques desde lo político, pasando por la vigilancia y las nuevas formas de dominación...</p>
      <p>Además, ahora se incorporan los enlaces de descarga correspondientes a las recomendaciones que se comparten semanalmente. Confío en que estas lecturas resultarán tan enriquecedoras e interesantes para ustedes como lo han sido para mí. ¡que disfruten! =D</p>
    </section>
    <section class="libros">
      <div id="tooltip" class="tooltip"></div>

      <figure class="book">
        <a href="descargar.php?file=01.pdf" class="image-link" onmouseover="showTooltip(event)" onmouseout="hideTooltip()">
          <img src="images/libro1.jpg"
            alt="Byung-Chul Han. Infocracia: la digitalización y la crisis de la democracia"
            width="300"
            height="500">
        </a>
        <figcaption>
          <h2>Infocracia: la digitalización y la crisis de la democracia</h2>
          <div class="review-js">
            <p class="review-text">
              ¿Cómo entender la situación actual de nuestras sociedades?, pues la respuesta se encuentra en este libro; ...
            </p>
            <button class="read-more">Leer más</button>
          </div>
        </figcaption>
      </figure>

      <figure class="book">
        <a href="descargar.php?file=02.pdf" class="image-link" onmouseover="showTooltip(event)" onmouseout="hideTooltip()">
          <img src="images/libro2.jpg"
               alt="Edward Snowden. Permanent record - Vigilancia permanente"
               width="300"
               height="500">
        </a>
        <figcaption>
          <h2>Permanent record – Vigilancia permanente</h2>
          <div class="review-js">
            <p class="review-text">
              Librazo, a quienes les gusta la tecnología… lectura obligatoria. ...
            </p>
            <button class="read-more">Leer más</button>
          </div>
        </figcaption>
      </figure>

      <figure class="book">
        <a href="descargar.php?file=03.pdf" class="image-link" onmouseover="showTooltip(event)" onmouseout="hideTooltip()">
          <img src="images/libro3.jpg"
               alt="Antony Loewenstein. El laboratorio Palestino"
               width="300"
               height="500">
        </a>
        <figcaption>
          <h2>El laboratorio Palestino</h2>
          <div class="review-js">
            <p class="review-text">
              El oscuro mundo detrás del armamento y la tecnología de origen israelí. ...
            </p>
            <button class="read-more">Leer más</button>
          </div>
        </figcaption>
      </figure>
    </section>

  </main>

  <footer>
    <p>&copy; 2025 Top de recomendaciones - por: jESP</p>
  </footer>

  <script src="script.js"></script>
</body>
</html>