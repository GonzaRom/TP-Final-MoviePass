<div class="content-detail-movie ">
    <div class="content-rgba-detail-movie">
        <?php include("nav.php"); ?>
        <div class="container">
            <div class="jumbotron jumbotron-image " style="background-image: url(<?php echo $movieDTO->background; ?>" );">
                <div class="container">
                    <h1 class="display-3 font-weight-bold">
                        <?php echo $movieDTO->title; ?>
                    </h1>
                    <h4 class="display-4">
                        <?php echo $movieDTO->originalTitle; ?>
                    </h4>
                    <p class="back">
                        <?php echo $movieDTO->overview; ?>
                    </p>
                    <hr class="my-4">
                    <p class="lead">
                        <?php for ($i = 0; $i < count($movieDTO->genres); $i++) : ?>
                            <span class="badge badge-info"><?php echo $movieDTO->genres[$i]["name"]; ?> </span>
                        <?php endfor; ?>
                        <span class="badge badge-info"><?php echo $movieDTO->releaseDate; ?> </span>
                        <span class="badge badge-info"><?php echo $movieDTO->originalLanguage; ?> </span>
                        <span class="badge badge-info"><?php echo $movieDTO->voteAverage; ?> </span>
                    </p>
                </div>
            </div>
        </div>
    </div>