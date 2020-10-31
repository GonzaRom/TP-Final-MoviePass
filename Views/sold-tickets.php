<section class="content-sold">
    <div class="rgba-sold">
        <?php require_once("nav.php"); ?>
        <div class="content-form-sold">
            <form action="">
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
                            <th>Quitar</th>
                        </tr>
                    </thead>

                    <?php foreach ($listTickets as $ticket) : ?>
                        <tbody class="tbody-list-sold">
                            <tr class="ticket">
                                <td><?php echo $ticket->getMovieshow()->getMovie()->getName(); ?></td>
                                <td>Ambasador</td>
                                <td><?php echo $ticket->getMovieshow()->getRoom()->getName(); ?></td>
                                <td><?php echo $ticket->getMovieshow()->getDate(); ?></td>
                                <td><?php echo $ticket->getMovieshow()->getTime(); ?></td>
                                <td><?php echo $ticket->getSeat(); ?></td>
                                <td><?php echo $ticket->getTicketCost(); ?></td>
                                <td><i style="color: red; font-size:25px;" class="fas fa-times"></i></td>
                            </tr>
                        </tbody>
                    <?php endforeach; ?>

                </table>
                <div class="totalcost">
                    <h3>200</h3>
                </div>
                <div class="content-button-sold">
                    <button class="submit-sold" type="submit">Finalizar Compra</button>
                </div>

            </form>
        </div>
    </div>
</section>