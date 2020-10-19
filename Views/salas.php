<?php

use DAO\RoomDAO as RoomDAO;

$newRoomDAO = new RoomDAO();

$listRoom = $newRoomDAO->getAll();

echo '<select name="room" id="">';
echo '<option value="">Seleccione una sala</option> ';
if (isset($_GET['cinema'])) {
    foreach ($listRoom as $room) {
        if ($room->getCinema() == $_GET['cinema']) {
            echo '<option value="'. $room->getId() . '">'. $room->getName()  .'</option> ';
        }
    }
}

echo '</select>';

?>