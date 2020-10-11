<section class="Add-Room">
    <?php include("nav.php"); ?>

    <div class="content-grid-room">
        <div class="grid-content-add-room">
            <div class="content-add-room">
                <div class="content-form">
                    <h1 class="tittle-add-room">Add room</h1>
                    <form action="<?php echo FRONT_ROOT; ?>room/Add" method="POST" class="form-add-room">
                        <div class="input-room">
                            <span>
                                <b>Nombre de la sala:</b>
                            </span>
                            <input type="text" name="name" id="" required>
                        </div>
                        <div class="input-room">
                            <span>
                                <b>Capacidad maxima:</b>
                            </span>
                            <input type="num" name="capacity" id="" required>
                        </div>
                        <div class="select-room">
                            <span>
                                <b>Tipo sala:</b>
                            </span>
                            <select name="typeroom" id="">
                                <option value="">Sala Premium</option>
                                <option value="">Sala Senior</option>
                                <option value="">Sala Nativa</option>
                            </select>
                        </div>
                        <div class="select-room">
                            <span>
                                <b>Tipo sala:</b>
                            </span>
                            <select name="typeroom" id="">
                                <?php foreach($listcinema as $cinema):?>
                                    <option value="<?php echo $cinema->GetId();?>"><?php echo $cinema->GetName();?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="contentButton">
                            <button class="button" type="submit">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>