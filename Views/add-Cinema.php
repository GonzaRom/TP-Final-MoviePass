<section class="Add-cinema">
    <?php include("nav.php"); ?>

    <div class="content-grid-cinema">
        <div class="grid-content-add-cinema">
            <div class="content-add-cimena">
                <div class="content-form">
                    <h1 class="tittle-add-cinema">Add Cinema</h1>
                    <form action="<?php echo FRONT_ROOT; ?>Cinema/add" method="POST" class="form-add-cinema">
                        <div class="input-cinema">
                            <span>
                                <b>Nombre de cine:</b>
                            </span>
                            <input type="text" name="name" id="" required>
                        </div>
                        <div class="input-cinema">
                            <span>
                                <b>Direccion de cine:</b>
                            </span>
                            <input type="text" name="adress" id="" required>
                        </div>
                        <div class="input-cinema">
                            <span>
                                <b>Telefono:</b>
                            </span>
                            <input type="text" name="phonenumber" id="" required>
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

                <?php elseif ($message == 2) : ?>
                    <div class="negative">

                        <p>El cine ya existe.</p>

                    </div>
                <?php endif; ?>



            </div>

        </div>
    </div>


</section>