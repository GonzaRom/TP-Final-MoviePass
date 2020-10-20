<div class="content-movie-list" style="width:100%; height:auto; padding:0px;">
    <div class="content-rgba-movie-list">
        <?php include("nav.php"); ?>
        <div class="container">
            <table class="table table-hover table-dark">
                    <thead>
                        <tr>
                            
                            <th scope="col" style="text-align: center;">ID</th>
                            <th scope="col" style="text-align: center;">Name</th>
                        </tr>
                    </thead>
                    <tbody><?php foreach ($genreslist as $genre) : ?>
                        <tr scope="row">
                            <td style="text-align: center;"><?php echo $genre->getId(); ?></td>
                            <td style="text-align: center;"><?php echo $genre->getName(); ?></td>
                        </tr>
                        <?php endforeach; ?> 
                    </tbody>
            </table>
        </div>
    </div>
</div>