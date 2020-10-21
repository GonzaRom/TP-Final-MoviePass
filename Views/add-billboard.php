<section class="Add-Room">
    <?php include("nav.php"); ?>
    <div class="content-grid-room">
        <div class="grid-content-add-room">
            <div class="content-add-room">
                <div class="content-form">
                    <h1 class="tittle-add-room">Add room</h1>
                    <form action="<?php echo FRONT_ROOT; ?>BillBoard/Add" method="GET" >
                        <div class="select-room">
                            <span>
                                <b>Cine:</b>
                            </span>
                            <select name="idCinema" id="" required>
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

                <p> <?php echo var_dump($message) ?></p>
                   
            </div>

        </div>
    </div>
</section>