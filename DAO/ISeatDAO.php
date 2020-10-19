<?php

namespace DAO;

use Models\Seat as Seat;

interface ISeatDAO{
    public function add(Seat $seat);
    public function getAll();
    public function get($id);
}


?>