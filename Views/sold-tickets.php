<section class="content-sold">
    <div class="rgba-sold">
        <?php require_once("nav.php"); ?>
        <div class="content-form-sold">
            <?php if ($listTickets == null) : ?>
                <div class="invitacion">
                    <h2 style="color: #fff;">Sus reservas seran vistas aqui</h2>
                </div>
            <?php else : ?>
                <form action="<?php echo FRONT_ROOT; ?>Purchase/addPurchase" method="POST">
                    <table class="table-list-sold">
                        <thead class="thead-list-sold">
                            <tr class="ticket">
                                <th>Pelicula</th>
                                <th>Cine</th>
                                <th>Sala</th>
                                <th>Dia</th>
                                <th>Hora</th>
                                <th>Butaca</th>
                                <th>Costo</th>
                            </tr>
                        </thead>
                        <?php for ($i = 0; $i < count($listTickets); $i++) : ?>
                            <tbody class="tbody-list-sold">
                                <tr class="ticket">
                                    <td><?php echo $listTickets[$i]->getMovieshow()->getMovie()->getName(); ?></td>
                                    <td><?php echo $listTickets[$i]->getMovieshow()->getCinema()->getName(); ?></td>
                                    <td><?php echo $listTickets[$i]->getMovieshow()->getRoom()->getName(); ?></td>
                                    <td><?php echo $listTickets[$i]->getMovieshow()->getDate(); ?></td>
                                    <td><?php echo $listTickets[$i]->getMovieshow()->getTime(); ?></td>
                                    <td><?php echo $listTickets[$i]->getSeat(); ?></td>
                                    <td><?php echo $listTickets[$i]->getTicketCost(); ?></td>
                                </tr>
                            </tbody>
                        <?php endfor; ?>

                    </table>
                    <div class="totalcost">
                        <h3><?php echo $purchase->getCosto(); ?></h3>
                    </div>
                    <div class="content-button-sold">
                        <button class="submit-sold" type="submit">Finalizar Compra</button>
                    </div>
                    <br>
                    <div class="container totalcost">
                        <div class="form-group col-md-5">
                            <label class="text-white" for="name">Nombre Completo</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group col-md-5">
                            <label class="text-white" for="creditnumber">Numero tarjeta</label>
                            <input type="number" class="form-control" id="creditnumber" name="creditnumber" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="text-white" for="verifcod">Codigo Verificacion</label>
                                <input type="number" class="form-control" id="verifcod" name="verifcod" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="text-white" for="expire">Fecha Vencimiento</label>
                                <input type="month" class="form-control" id="expire" name="expire" required>
                            </div>
                        </div>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</section>