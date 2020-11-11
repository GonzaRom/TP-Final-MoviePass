<section class="deliver-ticket-content">
    <?php require_once('nav.php');?>
    <div class="rgba-deliver-ticket">
        <h2>Gracias por su compra</h2>
        <table>
            <thead>
                <tr>
                    <th>
                        Usuario
                    </th>
                    <th>
                        Pelicula
                    </th>
                    <th>
                        Sala
                    </th>
                    <th>
                        Butaca
                    </th>
                    <th>
                        Fecha
                    </th>
                    <th>
                        Hora
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>
                        <?php echo $ticket->getUser()->getFirstname() .' '. $ticket->getUser()->getLastName();?>
                    </th>
                    <td>
                        <?php echo $ticket->getMovieshow()->getCinema()->getName();?>
                    </td>
                    <td>
                        <?php echo $ticket->getMovieshow()->getRoom()->getName();?>
                    </td>
                    <td>
                        <?php echo $ticket->getSeats()->getNumSeat();?>
                    </td>
                    <td>
                        <?php echo $ticket->getMovieshow()->getDate();?>
                    </td>
                    <td>
                        <?php echo $ticket->getMovieshow()->getTime();?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>