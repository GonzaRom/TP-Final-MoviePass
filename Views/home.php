<div class="content-home ">
  <?php require_once('nav.php'); ?>
  <section class="slider d-flex">
    <div class="your-class">
      <?php for ($i = 0; $i < count($movieShows); $i++) :
        $movie = $movieShows[$i]->getMovie();
        $imgPath = $movie->getBackground();
        $nombre = $movie->getTitle();
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
                <h1><?php echo $nombre; ?></h1>
                <h3><?php echo $movie->getSynopsis(); ?></h3>
                <br><br>
                
                <h3><span class="badge badge-light"> <?php echo "Proxima funcion: ". $movieShows[$i]->getDate() . " " . $movieShows[$i]->getTime(); ?></span></h3>
                <h3><span class="badge badge-light"> <?php echo "Duracion: ". $duration." min"; ?></span></h3>
          
                <!--a class="btn btn-light btn-sm" href="<?php echo FRONT_ROOT."Movie/Get/" . $id; ?>" role="button">MAS INFO </a-->
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
        <?php foreach ($genreList as $genre) : ?>
          <li><?php echo $genre->getName(); ?></li>
        <?php endforeach; ?>
      </ul>
    </aside>
    <section class="peliculas">
      <?php for ($i = 0; $i < count($movieShows); $i++) :
        $movie = $movieShows[$i]->getMovie();
        $imgPath = $movie->getPoster();
        $id = $movie->getId();
      ?>
       
        <div class="movie"><a href="<?php echo FRONT_ROOT."Movie/Get/" . $id; ?>" ><img src="<?php echo $imgPath; ?>" alt=""></a></div>
       
      <?php endfor ?>
    </section>

  </section>

</div>