
<div class="content-movie-list">
    <div class="content-rgba-movie-list">
        <?php include("nav.php"); ?>

        <div class="container">
                <form action="<?php echo FRONT_ROOT ?>MovieShow/filterByDate" method="GET">
                    <input type="date" name="date">
                    <button type="submit">Filtrar</button>
                </form>
            <form action="<?php echo FRONT_ROOT ?>MovieShow/getByMovie" method="GET">
                <select name="" id="cine" onclick="moviesByCinema(this.value);">
                    <option value="0">Todos</option>
                    <?php foreach ($cinemas as $cinema) : ?>
                        <option value="<?php echo  $cinema->getId(); ?>"><?php echo $cinema->getName(); ?></option>
                    <?php endforeach; ?>
                </select>

                <div class="card mb-3" style="width:1250px;" id="movieShows">
                    <?php foreach ($cinemas as $cinema) : ?>
                        <?php $movieShows = $cinema->getBillBoard()->getMovieShows(); ?>
                        <?php for ($j = 0; $j < count($movieShows); $j++) :
                            $movie = $movieShows[$j]->getMovie();
                            $nombre = $movie->getName();
                            $genres = $movie->getGenreId();
                            $duration = $movie->getRunTime();
                        ?>
                            <div class="row no-gutters">
                                <!--IMAGEN-->
                                <div class="col-md-2">
                                    <img  src="
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
                                        <small class="card-text">
                                            <i class="fas fa-star "></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                                        </small>
                                        <button type="submit" class="btn btn-secondary btn-sm" name="movieId" value="<?php echo $movie->getId(); ?>">Reservar</button>
                                    </div>
                                </div>

                            </div>
                        <?php endfor; ?>
                    <?php endforeach; ?>
                </div>
            </form>
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