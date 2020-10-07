<div class="content-home">
  <?php require_once("nav.php"); ?>

  <section class="slider">
    <div class="your-class">
      <div class="img-slider"><img class="img" src="<?php echo SLIDER_PATH; ?>/bds_first-class_poster-091.jpg" alt=""></div>
      <div class="img-slider"><img class="img" src="<?php echo SLIDER_PATH; ?>/guardians-of-the-galaxy_banner.jpg" alt=""></div>
      <div class="img-slider"><img class="img" src="<?php echo SLIDER_PATH; ?>/Maléfica_Banner_Oficial_Latino_b_JPosters.jpg" alt=""></div>
    </div>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo SLICK; ?>/slick.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
        $('.your-class').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 5000,
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
      <div class="movie"><a href=""><img src="<?php echo MOVIE_PATH; ?>/598cbd9d31af07d62c81e75f6c2e925b.jpg" alt=""></a></div>
      <div class="movie"><a href=""><img src="<?php echo MOVIE_PATH; ?>/C_20107.jpg" alt=""></a></div>
      <div class="movie"><a href=""><img src="<?php echo MOVIE_PATH; ?>/descarga.jpg" alt=""></a></div>
      <div class="movie"><a href=""><img src="<?php echo MOVIE_PATH; ?>/resize_1541386116.jpg" alt=""></a></div>

    </section>

  </section>

</div>