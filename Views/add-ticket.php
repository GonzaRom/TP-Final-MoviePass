<section class="add-ticket-content">

<div class="rgba-add-ticket">

    <div class="flex-add-ticket">
    
        <form action="" method="post">
        
        <input type="text" placeholder="idUser" value="<?php echo $_SESSION['loggedUser']; ?>">
        <input type="text" placeholder="<?php echo $nameMovie;?>">
        <select name="" id="">
            <option value="">Seleccione una opcion</option>
            <?php foreach($listmovieShow as $movieShow):?>
                <option value="<?php echo $movieShow->getId(); ?>"><?php echo $movieShow->getDate();?></option>
            <?php endforeach;?>
        </select>
        <input type="text">
        <input type="text">
        
        
        </form>
    </div>



</div>


</section>