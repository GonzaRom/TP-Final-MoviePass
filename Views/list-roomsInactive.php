<div class="content-cinema-list">
    <div class="content-rgba-cinema-list">
        <?php include("nav.php"); ?>

        <section class="section-cinema-list">

            <form action="<?php echo FRONT_ROOT ?>Room/upRoom" method="GET" class="form-list-cinema">
                <table class="table-list-cinema">
                    <thead class="thead-list-cinema">
                        <tr class="tr-list-cinema">
                            <th>Nombre</th>
                            <th>Cine</th>
                            <th>Tipo de sala</th>
                            <th>Capacidad Maxima</th>
                            <th>Puntuacion</th>
                            <?php if (isset($_SESSION['userType']) && $_SESSION['userType'] == "Admin") : ?>
                                <th>Eliminar</th>
                                <th>Actualizar</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody class="tbody-list-cinema">
                        <?php
                        foreach ($listCinemas as $cinema) :
                        ?>
                            <?php foreach ($cinema->getRooms() as  $room) : ?>
                                <tr class="tr-list-information-cinema">
                                    <td><?php echo $room->getName(); ?></td>
                                    <td><?php echo $cinema->getName(); ?></td>
                                    <td><?php echo $room->getTypeRoom()->getName(); ?></td>
                                    <td><?php echo $room->getCapacity(); ?></td>
                                    <td><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></td>
                                    <?php if (isset($_SESSION['userType']) && $_SESSION['userType'] == "Admin") : ?>
                                        <td>
                                            <button class="button-remove-cinema" type="submit" name="id" value="<?php echo $room->getId(); ?>">Dar Alta</button>
                                        </td>
                                        <!--UPDATE-->
                                        <td>
                                            <a class="button-remove-cinema" href="<?php echo FRONT_ROOT . "Room/showUpdateView/" . $room->getId(); ?>">Actualizar</a>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </form>
        </section>
    </div>

</div>