<header class="d-flex justify-content-center bg-dark">
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg " style="width:1700px ;">
        <a class="navbar-brand" href="<?php echo FRONT_ROOT; ?>Home/Index">
            <img src="<?php echo IMG_PATH; ?>multiflex.png" width="200" height="30" class="d-inline-block align-top img-fluid height" alt="">
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
                    <a class="nav-link" href="#">Estrenos</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Generos
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo FRONT_ROOT; ?>Genre/Update">Update</a>
                        <a class="dropdown-item" href="<?php echo FRONT_ROOT; ?>Genre/ShowListView">Listar</a>
                    </div>
                </li>

                <?php if ($_SESSION['userType'] == 2):?>
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
                        <a class="dropdown-item" href="<?php echo FRONT_ROOT; ?>Room/ShowListView">Listar</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="<?php echo FRONT_ROOT; ?>User/showSingInView">Agregar Admin</a>
                </li>
                <?php elseif ($_SESSION['userType'] == 1): ?>
                <li class="nav-item">
                    <a class="nav-link " href="<?php echo FRONT_ROOT; ?>Cinema/ShowListView">Cines</a>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link " href="<?php echo FRONT_ROOT; ?>Movie/GetAll" tabindex="-1" aria-disabled="true">Peliculas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="<?php echo FRONT_ROOT; ?>User/logout" tabindex="-1" aria-disabled="true">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
