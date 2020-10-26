<section class="add-puchase-content">
    <?php require_once('nav.php'); ?>
    <div class="rgba-add-puchase">

        <div class="flex-add-puchase">

            <form action="" method="post">
                <h2>Reservar Entrada</h2>
                <div class="input-box" style="display: none;">
                    <input type="text" name="idUser" placeholder="idUser" value="<?php/* echo $_SESSION['loggedUser']; */?>">
                </div>
                <div class="input-box">
                    <span>Pelicula: </span><span class="input"><?php /*echo $nameMovie;*/ ?>Pelicula</span>
                </div>

                <div class="input-box">
                    <span>Funcion: </span><select class="form-control " name="movieShow" id="">
                        <option  value="">Seleccione una opcion</option>
                        <?php /*foreach ($listmovieShow as $movieShow) :*/ ?>
                        <option value="<?php/* echo $movieShow->getId();*/ ?>"><?php /*echo $movieShow->getDate() . " " . $movieShow->getTime(); */ ?></option>
                        <?php /*endforeach;*/ ?>
                    </select>
                </div>

                <div class="input-box">
                    <span>Cantidad de entradas: </span> <input type="number" name="cantidad">
                </div>


                <button class="submit-add-purchase" type="submit" value="<?php ?>">Comprar Ticket</button>
            </form>
        </div>
    </div>
</section>