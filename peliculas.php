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

!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reseñas de Películas - Mis recomendaciones</title>
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
      <h1>Sección</h1>
    </header>
  <header>
    <h1>Películas</h1>
  </header>

  <main>
    <section>
      <p>El séptimo arte, no solo como entretenimiento, sino además como un refugio donde se pueden encontrar valiosas enseñanzas.</p>
    </section>
    <section class="libros">
      <figure class="book">
        <a href="https://tv.apple.com/us/movie/doctor-zhivago/umc.cmc.3gbmpvgdiylo7972s206q3yhb?l=es" target="_blank" rel="noopener">
          <img src="images/pelicula1.jpg"
            alt="Doctor Zhivago"
            width="300"
            height="500">
        </a>
        <figcaption>
          <h2>Doctor Zhivago - 1965</h2>
          <div class="review-js">
             <p class="review-text">
                Una épica adaptación cinematográfica ambientada en el convulso contexto de la Rusia revolucionaria. La película destaca por su cuidada dirección artística, un guion que fusiona el drama personal con los grandes eventos históricos y una banda sonora memorable. La narrativa sigue el viaje del protagonista, un médico y poeta, atrapado en medio de pasiones prohibidas, conflictos políticos y la fragilidad de la condición humana. Los planos majestuosos del paisaje ruso y la atención al detalle en la ambientación logran transportar al espectador a una época de transformaciones y tragedias, haciendo de esta cinta un clásico inolvidable del cine dramático y romántico.
             </p>
             <button class="read-more">Leer más</button>
          </div>
        </figcaption>
      </figure>

      <figure class="book">
        <a href="https://www.starwars.com/" target="_blank" rel="noopener">
          <img src="images/pelicula2.jpg"
               alt="StarWars"
               width="300"
               height="500">
        </a>
        <figcaption>
          <h2>StarWars</h2>
          <div class="review-js">
             <p class="review-text">
                Es mucho más que una simple película de ciencia ficción; es un fenómeno cultural que redefinió el género espacial. Con una narrativa que mezcla aventuras épicas, personajes icónicos y efectos especiales revolucionarios para su época, la saga se convertirá en una referencia ineludible en la historia del cine. La lucha entre el bien y el mal, encarnada en personajes como Luke Skywalker, Darth Vader y la Princesa Leia, es presentada en un universo vasto y lleno de detalles, donde la mitología se entrelaza con aspectos filosóficos y emocionales. La banda sonora, compuesta por John Williams, suma intensidad y emoción a cada escena, haciendo que cada visionado sea una experiencia única y emocionante.
             </p>
             <button class="read-more">Leer más</button>
          </div>
        </figcaption>
      </figure>

      <figure class="book">
        <a href="https://www.primevideo.com/-/es/detail/Lincoln/0MAS1JWD2VIMUWRP0SXS6F7RAQ" target="_blank" rel="noopener">
          <img src="images/pelicula3.jpg"
               alt="Lincoln - 2012"
               width="300"
               height="500">
        </a>
        <figcaption>
          <h2>Lincoln - 2012</h2>
          <div class="review-js">
             <p class="review-text">
                Impresionante recreación histórica que se centra en los últimos meses de la vida del 16º presidente de Estados Unidos, Abraham Lincoln, durante la turbulenta época de la Guerra Civil. Dirigida por Steven Spielberg y protagonizada magistralmente por Daniel Day-Lewis, la película se destaca por su enfoque en la política, la diplomacia y las complejidades morales que rodearon la aprobación de la Enmienda XIII, destinada a abolir la esclavitud en el país. La narrativa se adentra en el intenso proceso político y en los dilemas éticos de un líder comprometido con la unión y la libertad, mostrando a un Lincoln perspicaz, empático y resiliente ante las adversidades.
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