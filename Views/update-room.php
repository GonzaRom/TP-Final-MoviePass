<section class="Add-Room">
    <?php include("nav.php"); ?>

    <div class="content-grid-room">
        <div class="grid-content-add-room">
            <div class="content-add-room">
                <div class="content-form">
                    <h1 class="tittle-add-room">Add room</h1>
                    <form action="<?php echo FRONT_ROOT; ?>Room/updateRoom" method="POST" class="form-add-room">
                        <input style="display: none;" type="text" name="id" id="" value="<?php echo $room->getId();?>">
                        <div class="select-room">
                            <span>
                                <b>Tipo sala:</b>
                            </span>
                            <select name="typeroom" id="" required>
                                <option value="<?php echo $room->getTypeRoom()->getId();?>"><?php echo $room->getTypeRoom()->getName();?></option>
                                <?php foreach($listTypeRoom as $typeroom):?>
                                    <option value="<?php echo $typeroom->getId();?>"><?php echo $typeroom->getName();?></option>
                                <?php endforeach;?>
                            </select>
                        </div>                        
                        <div class="input-room">
                            <span>
                                <b>Capacidad maxima:</b>
                            </span>
                            <input type="num" name="capacity" id="" value="<?php echo $room->getCapacity();?>"required>
                        </div>
                        <div class="input-room">
                            <span>
                                <b>Precio de sala:</b>
                            </span>
                            <input type="num" name="ticketcost" id=""  value="<?php echo $room->getTicketCost();?>"required>
                        </div>
                        <div class="contentButton">
                            <button class="button" type="submit">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>