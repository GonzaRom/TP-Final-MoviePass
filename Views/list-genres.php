<div class="content-movie-list">
    <div class="content-rgba-movie-list">
        <?php include("nav.php"); ?>
        <div class="container">
            <table class="table table-hover table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                        </tr>
                    </thead>
                    <tbody><?php foreach ($genreslist as $genre) : ?>
                        <tr>
                            <th scope="row">1</th>
                            <td><?php echo $genre->getId(); ?></td>
                            <td><?php echo $genre->getName(); ?></td>
                        </tr> <?php endforeach; ?>
                    </tbody>
               
            </table>
        </div>
    </div>
</div>