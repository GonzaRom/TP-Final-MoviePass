<div class="listMovieShow">
    <?php require_once("nav.php"); ?>
    <div class="rgba-content-listMovieShow">
        <?php foreach ($listMovieShow as $movieShow) : ?>
            <div class="infoMovieShow">
                <div class="infoLocation">
                    <div class="tituloMovie">
                        <h2>
                            <?php foreach ($listMovie as $movie) {
                                if ($movieShow->getMovie() == $movie->getImdbId()) {
                                    echo $movie->getName();
                                }
                            } ?>
                        </h2>
                    </div>
                    <div class="cinemaMovieShow">
                        <h3><?php echo $movieShow->getNameCinema(); ?></h3>
                    </div>

                    <div class="roomMovieShow">
                        <h3><?php echo $movieShow->getRoomName(); ?></h3>
                    </div>
                    <div class="dateMovieShow">
                        <h5><?php echo $movieShow->getDate(); ?></h5>
                    </div>
                    <div class="timeMovieShow">
                        <h5><?php echo $movieShow->getTime(); ?></h5>
                    </div>
                </div>


                <div class="seatMovieShow">
                    <h3>Desocupados:</h3>
                    <ul> <?php $listSeat = $movieShow->getSeats();
                            foreach ($listSeat as $seat) :
                            ?>
                            <li> <?php if ($seat->getOccupied() == false) : ?>
                                    <i class="fas fa-chair" style="color:#aaa;">( <?php echo $seat->getId(); ?>)</i>
                                <?php else : ?>
                                    <i class="fas fa-chair" style="color:red;">( <?php echo $seat->getId(); ?>)</i>
                                <?php endif; ?>

                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            </div>

            </label>
        <?php endforeach; ?>

    </div>


</div>