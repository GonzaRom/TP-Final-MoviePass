<div class="body" id="onload">
    <div class="container">
        <div class="loader"><span></span></div>
    </div>
</div>
<div class="content-movie-list">
    <div class="content-rgba-movie-list">
        <?php

        use Controllers\MovieShowController;
use Helpers\helper_rating;

include("nav.php"); ?>

        <div class="container">
            <div class="filtros">
                <select name="" id="cine" onclick="moviesByCinema(this.value);">
                    <option value="0">Todos</option>
                    <?php foreach ($cinemas as $cinema) : ?>
                        <option value="<?php echo  $cinema->getId(); ?>"><?php echo $cinema->getName(); ?></option>
                    <?php endforeach; ?>
                </select>
                <form action="<?php echo FRONT_ROOT ?>MovieShow/filterByDate" method="GET">
                    <input type="date" name="date">
                    <button type="submit">Filtrar</button>
                </form>
            </div>
            <?php foreach ($cinemas as $cinema) : ?>
                <?php $movieShows = $cinema->getBillBoard(); ?>
                <?php for ($j = 0; $j < count($movieShows); $j++) :

                    $movie = $movieShows[$j]->getMovie();
                    $nombre = $movie->getName();
                    $genres = $movie->getGenreId();
                    $duration = $movie->getRunTime();
                ?>
                    <form action="<?php echo FRONT_ROOT ?>Ticket/showAddTicketView" method="GET">

                        <div class="card mb-3" style="width:1250px;" id="movieShows">

                            <div class="content-none" style="display: none;">
                                <input type="text" name="cinema" value="<?php echo $cinema->getId(); ?>">
                                <input type="text" name="movieshow" value="<?php echo  $movieShows[$j]->getId(); ?>">
                            </div>

                            <div class="row no-gutters">
                                <!--IMAGEN-->
                                <div class="col-md-2">
                                    <img src="
                                    <?php echo $movie->getPoster(); ?>
                                    " alt="" class="card-img h-100" />
                                </div>
                                <!--Texto-->
                                <div class="col-md-8">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h5 class="card-title text-center ">
                                                <strong><?php echo $movie->getName(); ?></strong>
                                            </h5>
                                            <?php for ($i = 0; $i < count($genres); $i++) : ?>
                                                <span class="badge badge-info"><?php echo $genres[$i]->getName(); ?> </span>
                                            <?php endfor; ?>
                                            <p class="card-text">
                                                <?php echo $movie->getSynopsis(); ?></td>
                                            </p>
                                        </div>
                                        <div class="card-footer text-light bg-secondary">
                                            <p><span><strong>Cine:</strong>
                                                    <?php echo $cinema->getName(); ?></span>
                                                <span><strong>Sala:</strong>
                                                    <?php echo $movieShows[$j]->getRoom()->getName(); ?></span>
                                                <span><strong>Proxima funcion:
                                                    </strong><?php echo $movieShows[$j]->getDate() . " " . $movieShows[$j]->getTime(); ?></span>
                                                <span><strong>Duracion:
                                                    </strong><?php echo $duration . " min"; ?></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!--Valoracion mas botones-->
                                <div class="col-md-2">
                                    <div class="list-reserv">
                                        
                                        <?php helper_rating::showRating($movieShows[$j]->getMovie()->getVoteAverage()) ?>
                                        
                                        <button type="submit" value="" class="btn btn-secondary btn-sm">Reservar</button>

                                        <a  type="button" href="<?php echo FRONT_ROOT; ?>Movie/detailMovie?movie=<?php echo $movieShows[$j]->getMovie()->getId(); ?>" class="btn btn-secondary btn-sm">Mas Info</a>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </form>
                <?php endfor; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    function moviesByCinema(str) {
        var conexion;
        if (str == "") {
            document.getElementById("txtHint").innerHTML = "";
            return;
        }

        if (window.XMLHttpRequest) {
            conexion = new XMLHttpRequest();
        }

        conexion.onreadystatechange = function() {
            if (conexion.readyState == 4 && conexion.status == 200) {
                document.getElementById("movieShows").innerHTML = conexion.responseText;
            }
        }
        conexion.open("GET", "filterByCinema?billboard=" + str, true);
        conexion.send();
    }
</script>
<script src="<?php echo JS_PATH; ?>preloader.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>