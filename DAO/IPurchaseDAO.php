<?php

namespace DAO;

use Models\Purchase as Purchase;

interface IPurchaseDAO{
    public function add(Purchase $purchase);
    public function getByUser($idUser);
}





?>