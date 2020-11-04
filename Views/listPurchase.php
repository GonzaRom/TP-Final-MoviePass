<section class="content-list-pruchase">
    <?php require_once('nav.php'); ?>
    <div class="rgba-content-list-purchase">
        <h2 class="mc">Mis Compras</h2>
        <?php foreach ($purchases as $purchase) { ?>
            <div class="content-purchase-info">
                <h2>
                    <ul>
                        <li><?php echo $purchase->getDate(); ?></li>
                        <li><?php echo $purchase->getTime(); ?></li>
                        <li><?php echo $purchase->getCosto(); ?></li>
                    </ul>
                </h2>
                <?php foreach ($purchase->getTickets() as $ticket) : ?>
                    <ul>
                        <li><?php echo $ticket->getMovieshow()->getMovie()->getName(); ?></li>
                        <li>Cinema</li>
                        <li><?php echo $ticket->getMovieshow()->getRoom()->getName(); ?></li>
                        <li><?php echo $ticket->getMovieshow()->getDate(); ?></li>
                        <li><?php echo $ticket->getMovieshow()->getTime(); ?> </li>
                        <li><?php echo $ticket->getSeats()->getNumSeat(); ?></li>
                    </ul>
                <?php endforeach; ?>
            </div>
        <?php } ?>
    </div>
</section>