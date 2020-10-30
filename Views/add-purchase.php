<!--div class="body" id="onload">
  <div class="container">
    <div class="loader"><span></span></div>
  </div>
</div-->
<section class="add-puchase-content">
    <?php require_once('nav.php'); ?>
    <div class="rgba-add-puchase">

        <div class="flex-add-puchase">

            <form action="<?php FRONT_ROOT."Purchase/createTickets"?>" method="post">
                <h2>Reservar Entrada</h2>
                <div class="input-box" style="display: none;">
                    <input type="text" name="idUser" placeholder="idUser" value="<?php echo $_SESSION['loggedUser']; ?>">
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
                    <span>Fecha y hora </span><span class="input"><?php echo $movieshow->getDate() ." " . $movieshow->getTime(); ?></span>
                </div>

                <div class="input-box">
                    <span>Cantidad de entradas: </span> <input type="number" name="cantidad">
                </div>


                <button class="submit-add-purchase" type="submit">Comprar Ticket</button>
            </form>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>