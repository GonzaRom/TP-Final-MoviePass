<div class="contenedor">
    <header>
        <div class="logo">
            <div class="navbar-header">
                <a class="d-flex flex-row" href="<?php echo FRONT_ROOT; ?>Home/Index">
                    <img src="<?php echo IMG_PATH; ?>multiflex.png" alt="">
                </a>
            </div>
        </div>
        <nav class="navbar sticky-top ">
            <a href="">Estrenos</a>
            <a href="">Generos</a>
            <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Cines
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Listar</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
            <a href="<?php echo FRONT_ROOT; ?>Cinema/ShowListView">Listar</a>
            <a href="">Salas</a>
            <a href="<?php echo FRONT_ROOT; ?>Room/ShowAddView">Agregar</a>
            <a href="<?php echo FRONT_ROOT; ?>Room/ShowListView">Listar</a>
            <a href="">Peliculas</a>
            <a href="<?php echo FRONT_ROOT; ?>Movie/GetAll">Listar</a>
            <a href="">Logout</a>
        </nav>
    </header>
</div>