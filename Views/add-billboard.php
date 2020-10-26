<section class="Add-Room">
    <?php include("nav.php"); ?>
    <div class="content-grid-room">
        <div class="grid-content-add-room">
            <div class="content-add-room">
                <div class="content-form">
                    <h1 class="tittle-add-room">Add Cartelera</h1>
                    <form action="<?php echo FRONT_ROOT; ?>BillBoard/add" method="POST" >
                        <div class="select-room">
                            <span>
                                <b>Cine:</b>
                            </span>
                            <select class="form-control" name="idCinema" id="" required>
                                <option value="">Seleccione una opcion</option>
                                <?php foreach($listCinema as $cinema):?>
                                    <option value="<?php echo $cinema->getId();?>"><?php echo $cinema->getName();?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="contentButton">
                            <button class="button" type="submit">Agregar</button>
                        </div>
                    </form>
                </div>

                <?php if ($message == 2) : ?>
                    <div class="negative">

                        <p>Falla en creacion de Cartelera.</p>

                    </div>
                <?php elseif ($message == 1) : ?>
                    <div class="affirmative">

                        <p>Creacion exitosamente.</p>

                    </div>
                <?php endif; ?>
                   
            </div>

        </div>
    </div>
</section>