<div class="content-detail-movie ">
  <?php include("nav.php"); ?>
  <div class="container">
    <div class="jumbotron jumbotron-image " style="background-image: linear-gradient(rgba(0, 0, 0, 0.38), rgba(0, 0, 0, 0.2)), url(<?php echo $movieDTO->getBackground(); ?>)">
      <div class="container">
        <h1 class="display-3 font-weight-bold">
          <?php echo $movieDTO->getName(); ?>
        </h1>
        <h4 class="display-4">
          <?php echo $movieDTO->getOriginalTitle(); ?>
        </h4>
        <p class="back">
          <?php echo $movieDTO->getSynopsis(); ?>
        </p>
        <hr class="my-4">
        <p class="lead">
          <?php for ($i = 0; $i < count($listGenre); $i++) : ?>
            <span class="badge badge-info"><?php echo $listGenre[$i]["name"]; ?> </span>
          <?php endfor; ?>
          <span class="badge badge-info"><?php echo $movieDTO->getReleaseDate(); ?> </span>
          <span class="badge badge-info"><?php echo $movieDTO->getVoteAverage(); ?> </span>
        </p>
      </div>
    </div>
    <section class="list-movieShow-byMovie">

        <?php foreach($listMovieShow as $movieShow):?>
          <div class="movieShowContent">
            <h2><?php echo $movieShow->getBillBoard();?></h2>
            <h3><?php echo $movieShow->getRoom();?></h3>
            <h3><?php echo $movieShow->getDate();?></h3>
            <h3><?php echo $movieShow->getTime();?></h3>
          </div>
        <?php endforeach;?>
    </section>
  </div>
</div>