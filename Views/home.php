<div class="body" id="onload">
  <div class="container">
    <div class="loader"><span></span></div>
  </div>
</div>
<div class="content-home ">
  <?php require_once('nav.php'); ?>
  <section class="slider d-flex">
    <div class="your-class">
      <?php for ($i = 0; $i < count($movieShows); $i++) :
        $movie = $movieShows[$i]->getMovie();
        $imgPath = $movie->getBackground();
        $nombre = $movie->getName();
        $imgPoster = $movie->getPoster();
        $duration = $movie->getRunTime();
        $id = $movie->getId();
      ?>
        <div class="img-slider" style="background:url('<?php echo $imgPath; ?>');">
          <div class="background-img">
            <div class="content-movie-poster">
              <div class="img-poster">
                <img src="<?php echo $imgPoster; ?>" alt="">
              </div>
              <div class="content-movie-info">
                <h2><?php echo $nombre; ?></h2>
                <h3><?php echo $movie->getSynopsis(); ?></h3>
                <br>
                <br>
                <h3><span class="badge badge-light"> <?php echo "Proxima funcion: " . $movieShows[$i]->getDate() . " " . $movieShows[$i]->getTime(); ?></span></h3>
                <h3><span class="badge badge-light"> <?php echo "Duracion: " . $duration . " min"; ?></span></h3>
                <h3><span class="badge badge-light"><a style="color: #000; text-decoration:none; " href="<?php echo FRONT_ROOT; ?>MovieShow/getByMovie?movie=<?php echo $movie->getId(); ?>"><i class="fas fa-list"></i> Ver Funciones Disponibles </a></span></h3>
                <h3><span class="badge badge-light"><a style="color: #000; text-decoration:none; " href="<?php echo FRONT_ROOT; ?>Movie/detailMovie?movie=<?php echo $movie->getId(); ?>"><i class="fas fa-play-circle"></i> Detalle de pelicula</a></span></h3>
                <!--a class="btn btn-light btn-sm" href="<?php echo FRONT_ROOT . "Movie/Get/" . $id; ?>" role="button">MAS INFO </a-->
              </div>
            </div>
          </div>
        </div>

      <?php endfor; ?>
    </div>

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo SLICK; ?>/slick.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
        $('.your-class').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 4000,
          dots: true,
          infinite: true,
          speed: 300,
          slidesToShow: 1,
          adaptiveHeight: true,
          arrows: true
        });
      });
    </script>
  </section>

  <section class="content-peliculas-generos">
    <aside class="generos">
      <ul>
        <?php foreach ($listGenre as $genre) : ?>
          <li> <a onclick="selectMovie(<?php echo $genre->getId(); ?>);"><?php echo $genre->getName(); ?></a></li>
        <?php endforeach; ?>
      </ul>
    </aside>
    <section class="peliculas" id="movies">
      <?php foreach ($movieList as $movie) :
        /*$movie = $movieShows[$i]->getMovie();                  /////esto estaba asi para mostrar las funciones.
        $imgPath = $movie->getPoster();                          /////matias lo cambio para q el dia antes de la segunda entrega muestre las peliculas 
        $name =  $movie->getTitle();
        $id = $movie->getId();*/
      ?>

        <div class="movie">
          <div class="img-poster-movie">
            <img src="<?php echo $movie->getPoster(); ?>" alt="">
          </div>
          <div class="detalles">
            <h2><?php echo $movie->getName(); ?></h2>
            <span >
            <a  href="<?php echo FRONT_ROOT; ?>MovieShow/getByMovie?movie=<?php echo $movie->getId(); ?>">Reservar</a>
            <a href="<?php echo FRONT_ROOT; ?>Movie/detailMovie?movie=<?php echo $movie->getId(); ?>">Mas Info</a>
            
          </span>
          </div>
        </div>

      <?php endforeach ?>
    </section>

  </section>

</div>
<script src="<?php echo JS_PATH; ?>preloader.js"></script>
<script type="text/javascript">
  function selectMovie(str) {
    var conexion;
    if (str == "") {
      document.getElementById("txtHint").innerHTML = "";
      return;
    }
    if (window.XMLHttpRequest) {
      conexion = new XMLHttpRequest();
    }
    conexion.onreadystatechange = function() {
      if (conexion.readyState == 4 && conexion.status == 200) {
        document.getElementById("movies").innerHTML = conexion.responseText;
      }
    }
    conexion.open("GET", "filterByGenre?genre=" + str, true);
    conexion.send();
  }
</script>