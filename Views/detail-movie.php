<div class="content-detail-movie ">
    <?php include("nav.php"); ?>
    <div class="container">
        <div class="jumbotron jumbotron-image "
            style="background-image: linear-gradient(rgba(0, 0, 0, 0.38), rgba(0, 0, 0, 0.2)), url(<?php echo $movieDTO->getBackground(); ?>)">
            <div class="container">
                <h1 class="display-3 font-weight-bold">
                    <?php echo $movieDTO->getName(); ?>
                </h1>
                <p class="back">
                    <?php echo $movieDTO->getSynopsis(); ?>
                </p>
                <hr class="my-4">
                <p class="lead">
                    <?php foreach ($movieDTO->getGenreId() as $genre) : ?>
                    <span class="badge badge-info"><?php echo $genre->getName(); ?> </span>
                    <?php endforeach; ?>
                    <span class="badge badge-info"><?php echo $movieDTO->getVoteAverage(); ?> </span>
                </p>
            </div>
        </div>
        <section class="container">
            <?php if ($movieDTO->getTrailer() != null) : ?>
            <div class="embed-responsive embed-responsive-21by9">
                <iframe width="560" height="315"
                    src="https://www.youtube.com/embed/<?php echo $movieDTO->getTrailer() ?>?autoplay=1&mute=1"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
            <?php endif; ?>
        </section>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>