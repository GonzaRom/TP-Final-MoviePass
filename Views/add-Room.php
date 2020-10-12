<section class="Add-Room">
    <?php include("nav.php"); ?>

    <div class="content-grid-room">
        <div class="grid-content-add-room">
            <div class="content-add-room">
                <div class="content-form">
                    <h1 class="tittle-add-room">Add room</h1>
                    <form action="<?php echo FRONT_ROOT; ?>Room/AddRooms" method="POST" class="form-add-room">
                        <div class="select-room">
                            <span>
                                <b>Cine:</b>
                            </span>
                            <select name="cinema" id="" required>
                                <option value="">Seleccione una opcion</option>
                                <?php foreach($listcinema as $cinema):?>
                                    <option value="<?php echo $cinema->GetId();?>"><?php echo $cinema->GetName();?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="select-room">
                            <span>
                                <b>Tipo sala:</b>
                            </span>
                            <select name="typeroom" id="" required>
                                <option value="">Seleccione una opcion</option>
                                <?php foreach($listtyperoom as $typeroom):?>
                                    <option value="<?php echo $typeroom->GetId();?>"><?php echo $typeroom->GetName();?></option>
                                <?php endforeach;?>
                            </select>
                        </div>                        
                        <div class="input-room">
                            <span>
                                <b>Capacidad maxima:</b>
                            </span>
                            <input type="num" name="capacity" id="" required>
                        </div>

                        
                        <div class="contentButton">
                            <button class="button" type="submit">Agregar</button>
                        </div>
                    </form>
                </div>

                <?php if ($message == 1) : ?>
                    <div class="affirmative">

                        <p>Cargado Exitosamente.</p>

                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>