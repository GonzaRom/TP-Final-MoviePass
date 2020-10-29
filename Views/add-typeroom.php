<div class="body" id="onload">
  <div class="container">
    <div class="loader"><span></span></div>
  </div>
</div>
<section class="Add-Room">
    <?php include("nav.php"); ?>

    <div class="content-grid-room">
        <div class="grid-content-add-room">
            <div class="content-add-room">
                <div class="content-form">
                    <h1 class="tittle-add-room">Agregar Tipo De Sala</h1>
                    <form action="<?php echo FRONT_ROOT; ?>TypeRoom/add" method="POST" class="form-add-room">                  
                        <div class="input-room">
                            <span>
                                <b>Nombre de tipo de sala:</b>
                            </span>
                            <input type="text" name="nametyperoom" required>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>