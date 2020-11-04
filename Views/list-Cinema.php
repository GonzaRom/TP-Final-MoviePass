<div class="body" id="onload">
  <div class="container">
    <div class="loader"><span></span></div>
  </div>
</div>
<div class="content-cinema-list">
        <div class="content-rgba-cinema-list">
            <?php include("nav.php"); ?>
            <section class="section-cinema-list">
                <form action="<?php echo FRONT_ROOT ?>Cinema/delete" method="GET" class="form-list-cinema">
                    <table class="table-list-cinema">
                        <thead class="thead-list-cinema">
                            <tr class="tr-list-cinema">
                                <th>Nombre</th>
                                <th>Direccion</th>
                                <th>Telefono</th>
                                <?php if (isset($_SESSION['userType']) && $_SESSION['userType'] == "Admin") : ?>
                                    <th>Eliminar</th>
                                    <th>Actualizar</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody class="tbody-list-cinema">
                            <?php
                            foreach ($cinemalist as $cinema) :
                            ?>
                                    <tr class="tr-list-information-cinema">
                                        <td><?php echo $cinema->getName(); ?></td>
                                        <td><?php echo $cinema->getAdress(); ?></td>
                                        <td><?php echo $cinema->getPhonenumber(); ?></td>
                                        <?php if (isset($_SESSION['userType']) && $_SESSION['userType'] == "Admin") : ?>
                                            <td>
                                                <button class="button-remove-cinema" type="submit" name="id" value="<?php echo $cinema->getId(); ?>"> Eliminar </button>
                                            </td>
                                            <!--UPDATE-->
                                            <td>
                                                <a class="button-remove-cinema" href="<?php echo FRONT_ROOT . "Cinema/showUpdateView/" . $cinema->getId(); ?>">Actualizar</a>
                                            </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </form>
            </section>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    