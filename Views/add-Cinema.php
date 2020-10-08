<section class="Add-cinema">

    <div class="grid-content-add-cinema">

        <div class="content-add-cimena">
            <div class="content-form">
                <h1 class="tittle-add-cinema">Add Cinema</h1>
                <form action="<?php echo FRONT_ROOT;?>Cinema/Add" method="POST" class="form-add-cinema">
                    <div class="input-cinema">
                        <span>
                            <b>Nombre de cine:</b> 
                        </span>
                        <input type="text" name="name" id="">
                    </div>
                    <div class="input-cinema">
                        <span>
                            <b>Direccion de cine:</b>
                        </span>
                        <input type="text" name="adress" id="">
                    </div>
                    <div class="input-cinema">
                        <span>
                            <b>Telfono:</b> 
                        </span>
                        <input type="text" name="phonenumber" id="">
                    </div>
                    <div class="input-cinema">
                        <span>
                            <b>Cantidad de Salas:</b>
                        </span>
                        <input type="number" name="rooms" id="">
                    </div>
                    
                    <button class="submit-add-cinema" type="submit">Agregar</button>

                </form>
            </div>


        </div>
    </div>

</section>