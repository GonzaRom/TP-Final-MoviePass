<section class="content-list-pruchase">
    <?php require_once('nav.php'); ?>
    <div class="rgba-content-list-purchase">

        <?php if (!empty($getAll)) : ?>
            <h2 class="mc">Todas las compras</h2>
            <form action="<?php echo FRONT_ROOT; ?>Purchase/getByCinema">
                <select name="cinema" id="">
                    <option value="0">Seleccione una opcion</option>
                    <?php foreach ($cinemas as $cinema) : ?>
                        <option value="<?php echo $cinema->getId(); ?>"><?php echo $cinema->getName(); ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Filtrar</button>
            </form>
        <?php else : ?>
            <h2 class="mc">Mis Compras</h2>
        <?php endif; ?>
        <?php foreach ($purchases as $purchase) { ?>
            <div class="content-purchase-info">
                <h2>
                    <ul>
                        <li> <b>Dia :</b> <?php echo $purchase->getDate(); ?></li>
                        <li> <b>Hora :</b> <?php echo $purchase->getTime(); ?></li>
                        <li> <b>Total :</b>$<?php echo $purchase->getCosto(); ?></li>
                    </ul>
                </h2>
                <table>
                    <thead>
                        <tr>
                            <th>
                                Pelicula
                            </th>
                            <th>
                                Cine
                            </th>
                            <th>
                                Sala
                            </th>
                            <th>
                                Dia
                            </th>
                            <th>
                                Hora
                            </th>
                            <th>
                                Butaca
                            </th>
                        </tr>
                    </thead>
                    <?php foreach ($purchase->getTickets() as $ticket) : ?>

                        <tbody>
                            <tr>
                                <td><?php echo $ticket->getMovieshow()->getMovie()->getName(); ?></td>
                                <td><?php echo $ticket->getMovieshow()->getCinema()->getName(); ?></td>
                                <td><?php echo $ticket->getMovieshow()->getRoom()->getName(); ?></td>
                                <td><?php echo $ticket->getMovieshow()->getDate(); ?></td>
                                <td><?php echo $ticket->getMovieshow()->getTime(); ?> </td>
                                <td><?php echo $ticket->getSeats()->getNumSeat(); ?></td>
                            </tr>
                        </tbody>

                    <?php endforeach; ?>
                </table>
            </div>
        <?php } ?>
    </div>
</section>