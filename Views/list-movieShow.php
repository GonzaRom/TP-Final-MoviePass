<div class="listMovieShow">
    <?php require_once("nav.php"); ?>
    <div class="rgba-content-listMovieShow">
            <?php foreach ($cinemas as $cinema) : ?>
            <?php $movieShows = $cinema->getBillBoard()->getMovieShows(); ?>
            <?php foreach ($movieShows as $movieShow) : ?>
            <div class="infoMovieShow">
                <div class="infoLocation">
                    <div class="tituloMovie">
                        <h2>
                            <?php echo $movieShow->getMovie()->getName(); ?>
                        </h2>
                    </div>
                    <div class="cinemaMovieShow">
                        <h3><?php echo $cinema->getName(); ?></h3>
                    </div>

                    <div class="roomMovieShow">
                        <h3><?php echo $movieShow->getRoom()->getName(); ?></h3>
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
                                    <i class="fas fa-chair" style="color:#aaa;">( <?php echo $seat->getNumSeat(); ?>)</i>
                                <?php else : ?>
                                    <i class="fas fa-chair" style="color:red;">( <?php echo $seat->getNumSeat(); ?>)</i>
                                <?php endif; ?>

                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            </div>

            </label>
        <?php endforeach; ?>
        <?php endforeach; ?>

    </div>


</div>