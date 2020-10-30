<!--div class="body" id="onload">
  <div class="container">
    <div class="loader"><span></span></div>
  </div>
</div-->
<section class="add-puchase-content">
    <?php require_once('nav.php'); ?>
    <div class="rgba-add-puchase">

        <div class="flex-add-puchase">

            <form action="<?php echo FRONT_ROOT . "Purchase/createTickets" ?>" method="get">
                <h2>Reservar Entrada</h2>

                <div class="content-info-movieshow">
                    <div class="info-movieshow">
                    <div class="input-box" style="display: none;">
                        <input type="text" name="idUser" placeholder="idUser" value="<?php echo $user; ?>">
                        <input type="text" name="cinema" value="<?php echo $idcinema;?>">
                        <input type="text" name="movieshow" value="<?php echo  $idMovieshow;?>">
                    </div>
                    <div class="input-box">
                        <span>Pelicula: </span><span class="input"><?php echo $movieshow->getMovie()->getName(); ?></span>
                    </div>

                    <div class="input-box">
                        <span>Cinema: </span><span class="input"><?php echo $cinema->getName(); ?></span>
                    </div>


                    <div class="input-box">
                        <span>Sala: </span><span class="input"><?php echo $movieshow->getRoom()->getName(); ?></span>

                    </div>

                    <div class="input-box">
                        <span>Fecha y hora </span><span class="input"><?php echo $movieshow->getDate() . " " . $movieshow->getTime(); ?></span>
                    </div>
                </div>


                <div class="seatMovieShow">
                    <h3>Desocupados:</h3>
                    <ul> <?php $listSeat = $movieshow->getSeats();
                            foreach ($listSeat as $seat) :
                            ?>
                            <li> <?php if ($seat->getOccupied() == false) : ?>
                                <input class="checkbox" value="<?php echo $seat->getNumSeat(); ?>" type="checkbox" name="seats[<?php echo $seat->getNumSeat() - 1; ?>]" id="seats<?php echo $seat->getNumSeat(); ?>">
                                <label class="" for="seats<?php echo $seat->getNumSeat(); ?>"><i class="fas fa-chair" style="font-size:18px;">[ <?php echo $seat->getNumSeat(); ?>]</i></label>
                                    
                                <?php else : ?>
                                    <i class="fas fa-chair" style="color:red;">[ <?php echo $seat->getNumSeat(); ?>]</i>
                                <?php endif; ?>

                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                </div>
                


                <button class="submit-add-purchase" type="submit">Comprar Ticket</button>
            </form>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>