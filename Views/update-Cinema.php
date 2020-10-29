<section class="Add-cinema">
    <?php include("nav.php"); ?>
    <div class="content-grid-cinema">
        <div class="grid-content-add-cinema">
            <div class="content-add-cimena">
                <div class="content-form">
                    <h1 class="tittle-add-cinema">Actualizar Cinema</h1>
                    <form action="<?php echo FRONT_ROOT; ?>Cinema/update" method="PUT" class="form-add-cinema">
                    <div class="input-cinema" style="display: none;">
                            <span>
                                <b>Id</b>
                            </span>
                            <input type="num" name="id" value="<?php echo $cinema->getId();?>" required>
                        </div>
                        <div class="input-cinema">
                            <span>
                                <b>Nombre de cine:</b>
                            </span>
                            <input type="text" name="name" value="<?php echo $cinema->getName();?>" required>
                        </div>
                        <div class="input-cinema">
                            <span>
                                <b>Direccion de cine:</b>
                            </span>
                            <input type="text" name="adress" value="<?php echo $cinema->getAdress();?>" required>
                        </div>
                        <div class="input-cinema">
                            <span>
                                <b>Telfono:</b>
                            </span>
                            <input type="text" name="phonenumber" value="<?php echo $cinema->getPhonenumber();?>" required>
                        </div>
                        <div class="contentButton">
                            <button class="button" type="submit">Actualizar</button>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>