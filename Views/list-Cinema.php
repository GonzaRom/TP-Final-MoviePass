    <div class="content-cinema-list">
        <div class="content-rgba-cinema-list">
            <?php include("nav.php"); ?>

        <section class="section-cinema-list">

            <form action="<?php echo FRONT_ROOT?>Cinema/Delete" method="POST" class="form-list-cinema">
                <table class="table-list-cinema">
                    <thead class="thead-list-cinema">
                        <tr class="tr-list-cinema">
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Ranking</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-list-cinema">
                            <?php
                                foreach($cinemalist as $cinema):
                            ?>
                            <tr class="tr-list-information-cinema" >
                                <td><?php echo $cinema->getName();?></td>
                                <td><?php echo $cinema->getAdress();?></td>
                                <td><?php echo $cinema->getPhonenumber();?></td>
                                <td><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i
                                        class="far fa-star"></i><i class="far fa-star"></i></td>
                                <td><button class="button-remove-cinema" type="submit" name="id" value="<?php echo $cinema->GetId();?>"> Remove </button></td>
                            </tr>
                            <?php endforeach;?>
                    </tbody>
                </table>
            </form>
        </section>
        </div>
        
    </div>