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
  <title>Reseñas de Videojuegos - Mis sugerencias</title>
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
      <h1>Zona</h1>
    </header>
  <header>
    <h1>Videojuegos</h1>
  </header>

  <main>
    <section>
      <p>Un poco de entrenimiento, nunca será sobrevalorado, acá unas pocas opciones...</p>
    </section>
    <section class="libros">
      <figure class="book">
        <a href="https://www.ageofempires.com/" target="_blank" rel="noopener">
          <img src="images/videojuego1.jpg"
            alt="Age of empires"
            width="300"
            height="500">
        </a>
        <figcaption>
          <h2>Age of empires - La era de los imperios</h2>
          <div class="review-js">
             <p class="review-text">
                Un clásico de la estrategia en tiempo real que ha marcado generaciones de jugadores. En este juego, los participantes gestionan civilizaciones a lo largo de diferentes eras históricas, desarrollando recursos, construyendo imperios y librando batallas monumentales. Su mecánica combina la planificación estratégica con la gestión de recursos y la ejecución táctica en el campo de batalla. Una de sus virtudes es la capacidad de sumergir al jugador en distintos contextos históricos, desde la antigüedad hasta épocas medievales, lo que enriquece tanto la experiencia de juego como el conocimiento cultural. Su jugabilidad adictiva y su profundidad estratégica han convertido a Age of Empires en un referente perenne en el género de la estrategia.
             </p>
             <button class="read-more">Leer más</button>
          </div>
        </figcaption>
      </figure>

      <figure class="book">
        <a href="https://www.ea.com/es-es/games/need-for-speed/need-for-speed-no-limits" target="_blank" rel="noopener">
          <img src="images/videojuego2.jpg"
            alt="Need for speed"
            width="300"
            height="500">
        </a>
        <figcaption>
          <h2>Need for speed</h2>
          <div class="review-js">
             <p class="review-text">
                Sinónimo de adrenalina y velocidad. Esta franquicia, que ha sabido evolucionar a lo largo de los años, ofrece una experiencia de conducción intensa, con gráficos y efectos de sonido que hacen sentir cada derrape, aceleración y persecución al límite. Cada entrega suele apostar por la personalización de vehículos y la emoción de las carreras, ya sean ilegales, callejeras o en escenarios más formales. La sensación de velocidad y la respuesta inmediata al volante destacan en este título, haciendo que tanto los aficionados a la conducción rápida como los que disfrutan de un buen reto de habilidad, se sumerjan en un mundo donde la técnica y la pasión por la velocidad se fusionan de forma espectacular.
             </p>
             <button class="read-more">Leer más</button>
          </div>
        </figcaption>
      </figure>

      <figure class="book">
        <a href="https://www.ea.com/es-es/games/fifa/fifa-23" target="_blank" rel="noopener">
          <img src="images/videojuego3.jpg"
               alt="FIFA"
               width="300"
               height="500">
        </a>
        <figcaption>
          <h2>FIFA</h2>
          <div class="review-js">
             <p class="review-text">
                La serie FIFA se ha consolidado como la franquicia líder en simulación de fútbol, ofreciendo una experiencia lo más cercana posible a las emociones y la intensidad de este deporte tan popular. Cada entrega permite a los jugadores enfrentarse en partidos llenos de tensión, estrategia y habilidad, tanto en ligas oficiales como en modos de juego personalizados. FIFA combina gráficos realistas, inteligencia artificial avanzada y una jugabilidad fluida que captura la esencia del fútbol moderno. Además, su robusto modo multijugador y las constantes actualizaciones y desafíos en línea mantienen al público enganchado, convirtiéndose en una plataforma no solo de entretenimiento, sino también de comunidad y competencia global.
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