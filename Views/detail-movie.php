
<div class="content-detail-movie ">
  <?php include("nav.php"); ?>
  <div class="container">
    <div class="jumbotron jumbotron-image " style="background-image: linear-gradient(rgba(0, 0, 0, 0.38), rgba(0, 0, 0, 0.2)), url(<?php echo $movieDTO->getBackground(); ?>)">
      <div class="container">
        <h1 class="display-3 font-weight-bold">
          <?php echo $movieDTO->getName(); ?>
        </h1>
        <p class="back">
          <?php echo $movieDTO->getSynopsis(); ?>
        </p>
        <hr class="my-4">
        <p class="lead"> 
          <?php foreach($movieDTO->getGenreId() as $genre) : ?>
            <span class="badge badge-info"><?php echo $genre->getName(); ?> </span>
          <?php endforeach; ?>
          <!--span class="badge badge-info"><?php echo $movieDTO->getReleaseDate(); ?> </span>
          <span class="badge badge-info"><?php echo $movieDTO->getVoteAverage(); ?> </span-->
        </p>
      </div>
    </div>
    <section class="list-movieShow-byMovie">
    </section>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>