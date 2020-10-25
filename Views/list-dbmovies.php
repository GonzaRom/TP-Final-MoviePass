<div class="content-movie-list">
    <div class="content-rgba-movie-list">
        <?php include("nav.php"); ?>
        <div class="container">
            <form action="<?php echo FRONT_ROOT ?>MovieShow/getByMovie" method="GET">
                <select name="" id="">
                    <option value="">Todos</option>
                    <option value="">Amabasador</option>
                    <option value="">Aldrey</option>
                    <option value="">Gallegos</option>
                </select> 
                <div class="card mb-3" style="max-width: 100%;">

                    <?php for ($j = 0; $j < count($movieList); $j++) :
                        $movie = $movieList[$j];
                        $nombre = $movie->getTitle();
                        $genres = $movie->getGenres();
                        $duration =$movie->getRunTime();
                    ?>
                    <div class="row no-gutters">
                        <!--IMAGEN-->
                        <div class="col-md-2">
                            <img src="
                                    <?php echo $movie->getPoster(); ?>
                                    " alt="..." class="card-img h-100" />
                        </div>
                        <!--Texto-->
                        <div class="col-md-8">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title text-center ">
                                        <strong><?php echo $movie->getTitle(); ?></strong>
                                    </h5>
                                    <?php for ($i = 0; $i < count($movie->getGenres()); $i++) : ?>
                                    <span class="badge badge-info"><?php echo $genres[$i]["name"]; ?> </span>
                                    <?php endfor; ?>
                                    <p class="card-text">
                                        <?php echo $movie->getSynopsis(); ?></td>
                                    </p>
                                </div>
                                <div class="card-footer text-light bg-secondary">
                                    <p><span><strong>Cine:</strong>
                                            <?php echo $movieShows[$j]->getNameCinema(); ?></span>
                                        <span><strong>Sala:</strong>
                                            <?php echo $movieShows[$j]->getRoomName(); ?></span>
                                        <span><strong>Proxima funcion:
                                            </strong><?php echo $movieShows[$j]->getDate() . " " . $movieShows[$j]->getTime(); ?></span>
                                        <span><strong>Duracion: 
                                            </strong><?php echo $duration." min"; ?></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!--Valoracion mas botones-->
                        <div class="col-md-2">
                            <div class="list-reserv">
                                <small class="card-text">
                                    <i class="fas fa-star "></i><i class="fas fa-star"></i><i class="far fa-star"></i><i
                                        class="far fa-star"></i><i class="far fa-star"></i>
                                </small>
                                <button type="submit" class="btn btn-secondary btn-sm" name="movieId"
                                    value="<?php echo $movie->getId(); ?>">Reservar</button>
                            </div>
                        </div>

                    </div>
                    <?php endfor; ?>
                </div>
            </form>
        </div>
    </div>
</div>