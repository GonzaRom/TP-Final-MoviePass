<div class="content-home ">
  <?php require_once("nav.php"); ?>

  <section class="slider">
    <div class="your-class">
      <?php for ($i = 0; $i < count($nowPlayingMoviesList); $i++) :
        $movie = $nowPlayingMoviesList[$i];
        $imgPath = $movie->getBackground();
        $nombre = $movie->getName();
        $imgPoster = $movie->getPoster();
      ?>
        <div class="img-slider" style="background-image:url('<?php echo $imgPath; ?>');" >
          <div class="background-img">
            <div class="content-movie-poster">
              <div class="img-poster">
                <img src="<?php echo $imgPoster; ?>" alt="">
              </div>
              <div class="content-movie-info">
                <h2><?php echo $nombre; ?></h2>
              </div>
            </div>

          </div>
        </div>
      <?php endfor ?>
    </div>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo SLICK; ?>/slick.js"></script>
    <script type="text/javascript" src="<?php echo SLICK; ?>/slick.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
        $('.your-class').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 3000,
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
        <li>Accion</li>
        <li>Comedia</li>
        <li>Aventuras</li>
        <li>Animadas</li>
        <li>Accion</li>
        <li>Comedia</li>
        <li>Aventuras</li>
        <li>Animadas</li>
        <li>Accion</li>
        <li>Comedia</li>
        <li>Aventuras</li>
        <li>Animadas</li>
      </ul>
    </aside>
    <section class="peliculas">
      <?php for ($i = 0; $i < count($nowPlayingMoviesList); $i++) :
        $movie = $nowPlayingMoviesList[$i];
        $imgPath = $movie->getPoster();
      ?>
        <div class="movie"><a href=""><img src="<?php echo $imgPath; ?>" alt=""></a></div>
      <?php endfor ?>
    </section>

  </section>

</div>