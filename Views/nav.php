<?php require_once(HELPERS_PATH . "helper-nav.php") ?>
<header class="d-flex justify-content-center bg-dark">
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg " style="width:1700px ;">
        <a class="navbar-brand" href="<?php echo FRONT_ROOT; ?>Home/Index">
            <img src="<?php echo IMG_PATH; ?>multiflex.png" width="150px" height="30px" class="d-inline-block align-top" alt="" loading="lazy">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarTogglerDemo01">
            <ul class="navbar-nav text-center ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT; ?>Home/Index">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="<?php echo FRONT_ROOT; ?>MovieShow/getAll" tabindex="-1" aria-disabled="true">Cartelera</a>
                </li>




                <?php if (!empty($_SESSION['userType']) && $_SESSION['userType'] == "Admin") : ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Peliculas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo FRONT_ROOT; ?>Movie/UpdateMoviesToDB">UPDATE DB!</a>
                            <a class="dropdown-item" href="<?php echo FRONT_ROOT; ?>Movie/ShowAllMovies">Listar</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Cines
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo FRONT_ROOT; ?>Cinema/ShowAddView">Agregar</a>
                            <a class="dropdown-item" href="<?php echo FRONT_ROOT; ?>Cinema/ShowListView">Listar</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Salas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo FRONT_ROOT; ?>Room/ShowAddView">Agregar</a>
                            <a class="dropdown-item" href="<?php echo FRONT_ROOT; ?>Room/showListView">Listar</a>
                            <a class="dropdown-item" href="<?php echo FRONT_ROOT; ?>Room/showListViewInactive">Alta</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="<?php echo FRONT_ROOT; ?>User/showSingInView">Agregar Admin</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Funcion
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo FRONT_ROOT; ?>MovieShow/showAddMovieShowView">Agregar</a>
                            <a class="dropdown-item" href="<?php echo FRONT_ROOT; ?>MovieShow/ShowListMovieShowView">Listar</a>
                        </div>
                    </li>
                <?php endif; ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Generos
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php foreach ($listGenre as $genre) : ?>
                            <a class="dropdown-item" href="<?php echo FRONT_ROOT; ?>Home/filterByGenres?genre=<?php echo $genre->getId(); ?>"><?php echo $genre->getName(); ?></a>
                        <?php endforeach; ?>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="<?php echo FRONT_ROOT; ?>Cinema/ShowListView">Cines</a>
                </li> 
                
                
                
                
                
                
                
                <?php if (isset($_SESSION['loggedUser'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link " href="<?php echo FRONT_ROOT; ?>Purchase/showAddPurchase"><i style="font-size: 20px; color:brown" class="fas fa-shopping-cart"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="<?php echo FRONT_ROOT; ?>User/logout" tabindex="-1" aria-disabled="true">Logout</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link " href="<?php echo FRONT_ROOT; ?>User/showLoginView" tabindex="-1" aria-disabled="true">Login</a>
                    </li>
                <?php endif; ?>



            </ul>
        </div>
    </nav>
</header>
<script type="text/javascript">
    function selectMovie(str) {
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
                document.getElementById("movies").innerHTML = conexion.responseText;
            }
        }
        conexion.open("GET", "<?php echo FRONT_ROOT; ?>Home/filterByGenre?genre=" + str, true);
        conexion.send();
    }
</script>