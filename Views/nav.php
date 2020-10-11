<header>
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
                    <li><a href="">Logout</a> </li>
                </ul>
            </nav>
        </div>
    </div>
</header>