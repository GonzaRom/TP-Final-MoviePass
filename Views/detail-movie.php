<div class="content-detail-movie ">
    <?php include("nav.php"); ?>
    <div class="container">
        <div class="jumbotron jumbotron-image "
            style="background-image: linear-gradient(rgba(0, 0, 0, 0.38), rgba(0, 0, 0, 0.2)), url(<?php echo $movieDTO->getBackground(); ?>)">
            <div class="container">
                <h1 class="display-3 font-weight-bold">
                    <?php echo $movieDTO->getTitle(); ?>
                </h1>
                <h4 class="display-4">
                    <?php echo $movieDTO->getOriginalTitle(); ?>
                </h4>
                <p class="back">
                    <?php echo $movieDTO->getSynopsis(); ?>
                </p>
                <hr class="my-4">
                <p class="lead">
                    <?php for ($i = 0; $i < count($genres); $i++) : ?>
                    <span class="badge badge-info"><?php echo $genres[$i]["name"]; ?> </span>
                    <?php endfor; ?>
                    <span class="badge badge-info"><?php echo $movieDTO->getReleaseDate(); ?> </span>
                    <span class="badge badge-info"><?php echo $movieDTO->getVoteAverage(); ?> </span>
                </p>
            </div>
        </div>
    </div>