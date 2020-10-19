<?php require_once (HELPERS_PATH . "helper-nav.php")?>
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
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo FRONT_ROOT; ?>Home/Index">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="<?php echo FRONT_ROOT; ?>Movie/GetAll" tabindex="-1" aria-disabled="true">Estrenos</a>
                </li>

                <?php if (!empty($_SESSION['userType']) && $_SESSION['userType'] == 2) : ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Generos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php foreach ($listGenre as $genre) : ?>
                                <a class="dropdown-item" href="#"><?php echo $genre->getName(); ?></a>
                            <?php endforeach; ?>
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
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="<?php echo FRONT_ROOT; ?>User/showSingInView">Agregar Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="<?php echo FRONT_ROOT; ?>MovieShow/showAddMovieShowView">Funcion</a>
                    </li>
                <?php elseif (!empty($_SESSION['userType']) && $_SESSION['userType'] == 1) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Generos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php foreach ($listGenre as $genre) : ?>
                                <a class="dropdown-item" href="#"><?php echo $genre->getName(); ?></a>
                            <?php endforeach; ?>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="<?php echo FRONT_ROOT; ?>Cinema/ShowListView">Cines</a>
                    </li>
                <?php endif; ?>

                <?php if (isset($_SESSION['loggedUser'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link " href="<?php echo FRONT_ROOT; ?>User/logout" tabindex="-1" aria-disabled="true">Logout</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Generos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php foreach ($listGenre as $genre) : ?>
                                <a class="dropdown-item" href="#"><?php echo $genre->getName(); ?></a>
                            <?php endforeach; ?>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="<?php echo FRONT_ROOT; ?>Cinema/ShowListView">Cines</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " href="<?php echo FRONT_ROOT; ?>MovieShow/showAddMovieShowView">Funcion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="<?php echo FRONT_ROOT; ?>User/showLoginView" tabindex="-1" aria-disabled="true">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>