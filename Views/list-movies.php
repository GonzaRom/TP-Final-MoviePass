<div class="content-movie-list">
    <div class="content-rgba-movie-list">
        <?php include("nav.php"); ?>
        <div class="container">
            <form action="<?php echo FRONT_ROOT ?>Movie/Get" method="GET">
                <div class="card mb-3" style="max-width: 100%;">
                    <?php
                    $var = count($nowPlayingMoviesList);
                    $var = $var / 4;

                    for ($i = 0; $i < $var; $i++) :
                    ?>
                        <div class="row no-gutters">
                            <!--IMAGEN-->
                            <?php $movie = $nowPlayingMoviesList[$i]; ?>

                            <div class="col-md-2">
                                <img src="
                                    <?php echo $movie->getPoster() ?>
                                    " alt="..." class="card-img" width="100%" height="250" />
                            </div>
                            <!--Texto-->
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title text-center "><strong><?php echo $movie->getName(); ?></strong></h5>
                                    <p class="card-text badge badge-info"><?php echo $movie->getGenreName(); ?>
                                    </p>
                                    <p class="card-text">
                                        <?php echo $movie->getSynopsis(); ?></td>

                                    </p>
                                </div>
                            </div>
                            <!--Valoracion mas botones-->
                            <div class="col-md-2">
                                <div class="d-flex align-content-sm-around flex-column">
                                    <small class="card-text">
                                        <i class="fas fa-star "></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                                    </small>
                                    <button type="submit" class="btn btn-secondary btn-sm" name="movieId" value="<?php echo $movie->getImdbID(); ?>">Reservar</button>
                                </div>
                            </div>

                        </div>
                    <?php endfor; ?>
                </div>
                <div class="card mb-3" style="max-width: 100%;">
                    <?php
                    for ($i = $var * 2; $i < $var * 3; $i++) :
                    ?>
                        <div class="row no-gutters">
                            <!--IMAGEN-->
                            <?php $movie = $nowPlayingMoviesList[$i]; ?>

                            <div class="col-md-2">
                                <img src="
                                    <?php echo $movie->getPoster() ?>
                                    " alt="..." class="card-img" width="100%" height="250" />
                            </div>
                            <!--Texto-->
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title text-center "><strong><?php echo $movie->getName(); ?></strong></h5>
                                    <p class="card-text badge badge-info"><?php echo $movie->getGenreName(); ?>
                                    </p>
                                    <p class="card-text">
                                        <?php echo $movie->getSynopsis(); ?></td>

                                    </p>
                                </div>
                            </div>
                            <!--Valoracion mas botones-->
                            <div class="col-md-2">
                                <div class="d-flex align-content-sm-around flex-column">
                                    <small class="card-text">
                                        <i class="fas fa-star "></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                                    </small>
                                    <button type="submit" class="btn btn-secondary btn-sm" name="movieId" value="<?php echo $movie->getImdbID(); ?>">Reservar</button>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
                <div class="card mb-3" style="max-width: 100%;">
                    <?php
                    for ($i = $var * 3; $i < $var * 4; $i++) :
                    ?>
                        <div class="row no-gutters">
                            <!--IMAGEN-->
                            <?php $movie = $nowPlayingMoviesList[$i]; ?>

                            <div class="col-md-2">
                                <img src="
                                    <?php echo $movie->getPoster() ?>
                                    " alt="..." class="card-img" width="100%" height="250" />
                            </div>
                            <!--Texto-->
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title text-center "><strong><?php echo $movie->getName(); ?></strong></h5>
                                    <p class="card-text badge badge-info"><?php echo $movie->getGenreName(); ?>
                                    </p>
                                    <p class="card-text">
                                        <?php echo $movie->getSynopsis(); ?></td>

                                    </p>
                                </div>
                            </div>
                            <!--Valoracion mas botones-->
                            <div class="col-md-2">
                                <div class="d-flex align-content-sm-around flex-column">
                                    <small class="card-text">
                                        <i class="fas fa-star "></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                                    </small>
                                    <button type="submit" class="btn btn-secondary btn-sm" name="movieId" value="<?php echo $movie->getImdbID(); ?>">Reservar</button>
                                </div>
                            </div>

                        </div>
                    <?php endfor; ?>
                </div>
            </form>
        </div>
    </div>
</div>