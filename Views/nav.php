<!--header>
    <div class="content-header">
        <div class="logo"><img src="<?php echo IMG_PATH; ?>multiflex.png" alt=""></div>
        <div class="menu">
            <nav>
                <ul>
                    <li><a href="<?php echo FRONT_ROOT; ?>Home/Index">Home</a> </li>
                    <li><a href="">Estrenos</a> </li>
                    <li><a href="">Generos</a> </li>
                    <li class="despegable"><a href="">Cines</a>
                        <ul>
                            <li><a href="<?php echo FRONT_ROOT; ?>Cinema/ShowAddView">Agregar</a></li>
                            <li><a href="<?php echo FRONT_ROOT; ?>Cinema/ShowListView">Listar</a></li>
                        </ul>
                    </li>
                    <li class="despegable"><a href="">Salas</a>
                        <ul>
                            <li><a href="<?php echo FRONT_ROOT; ?>Room/ShowAddView">Agregar</a></li>
                            <li><a href="<?php echo FRONT_ROOT; ?>Room/ShowListView">Listar</a></li>

                        </ul>
                    </li>
                    <li class="despegable"><a href="">Peliculas</a>
                        <ul>
                            <li><a href="<?php echo FRONT_ROOT; ?>Movie/GetAll">Listar</a></li>
                        </ul>
                    </li>
                    <li><a href="">Logout</a> </li>
                </ul>
            </nav>
        </div>
    </div>
</header-->
<header class="d-flex sticky-top justify-content-center bg-dark">
    <nav class="navbar navbar-dark  bg-dark navbar-expand-lg " style="width:1700px ;">
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
                <li class="nav-item">
                    <a class="nav-link" href="#">Generos</a>
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
                        <a class="dropdown-item" href="<?php echo FRONT_ROOT; ?>Room/ShowListView">Listar</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="<?php echo FRONT_ROOT; ?>Movie/GetAll" tabindex="-1" aria-disabled="true">Peliculas</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
