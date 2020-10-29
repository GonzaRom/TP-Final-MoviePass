<div class="body" id="onload">
  <div class="container">
    <div class="loader"><span></span></div>
  </div>
</div>
<section class="content-add-movieShow">
    <?php require_once('nav.php');  ?>
    <div class="rgba-content">
        <div class="dflex-form">
            <form action="<?php echo FRONT_ROOT . "MovieShow/add"; ?>" method="POST">
                <h2>Agregar Funcion</h2>
                <label for="movie">Pelicula:
                    <select name="movie" id="movie">
                        <option value="">Seleccione una pelicula</option>
                        <?php foreach ($listMovies as $movies) : ?>
                            <option value="<?php echo $movies->getId(); ?>"><?php echo $movies->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>

                <label for="">Cine:
                    <select name="cinema" id="" onclick="selectCines(this.value);">
                        <option value="">Seleccione un cine</option>
                        <?php foreach ($listCinema as $cinema) : ?>
                            <option value="<?php echo $cinema->getId(); ?>"><?php echo $cinema->getName(); ?></option>
                            <?php  endforeach; ?>
                    </select>
                    </select>
                </label>

                <label for="room" id="salas">Sala:
                    <select name="room" id="room">
                        <option value="">Seleccione una sala</option>
                    </select>
                </label>

                <label for="">Tipo de pelicula:
                    <div class="div-checkbox">
                        <?php foreach ($listTypeMovieShow as $typeMovieShow) : ?>
                            <div class="input-checkbox">
                                <input type="radio" class="radio" name="typeMovieShow" id="typeMovieShow" value="<?php echo $typeMovieShow->getId(); ?>"><?php echo $typeMovieShow->getName(); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </label>



                <label for="">
                    <div class="inputDateTime">
                        <div class="input-date">
                            Fecha<input type="date" name="date" id="">
                        </div>

                        <div class="input-time">
                            Hora<input type="time" name="time" id="">
                        </div>

                    </div>
                </label>

                <button class="submit-add-movieShow" type="submit">Guardar</button>
                <?php if ($message == 1) : ?>
                    <div class="negative">

                        <p>Ingrese una fecha superior a la actual.</p>

                    </div>

                <?php elseif ($message == 2) : ?>
                    <div class="negative">

                        <p>La funcion ya existe.</p>

                    </div>
                <?php elseif ($message == 3) : ?>
                    <div class="affirmative">

                        <p>Guardado exitosamente.</p>

                    </div>
                <?php endif; ?>
            </form>


        </div>
    </div>
</section>
<script type="text/javascript">
        function selectCines(str) {
            var conexion;
            if (str == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            }
            if (window.XMLHttpRequest) {
                conexion = new XMLHttpRequest();
            }
            conexion.onreadystatechange = function() {
                if (conexion.readyState == 4 && conexion.status == 200) {
                    document.getElementById("salas").innerHTML = conexion.responseText;
                }
            }
            conexion.open("GET", "salas?cinema=" + str, true);
            conexion.send();
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>