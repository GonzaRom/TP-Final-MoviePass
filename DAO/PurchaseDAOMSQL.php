<?php

namespace DAO;

use Exception;
use Models\Purchase;

class PurchaseDAOMSQL implements IPurchaseDAO
{
    private $nameTable;
    private $coneccion;



    public function add(Purchase $purchase)
    {
        try {
            $sql = "INSERT INTO " . $this->nameTable . " (iduser , cost , date_) VALUES (:iduser , :cost , :date )";
            $parameters['iduser'] = $purchase->getIdUser();
            $parameters['cost'] = $purchase->getCosto();
            $parameters['date'] = $purchase->getDate();
            $this->coneccion = Connection::getInstance();
            $this->coneccion->ExecuteNonQuery($sql, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getByUser($idUser)
    {
        $listPurchase = array();
        try {
            $sql = "SELECT * FROM " . $this->nameTable . " WHERE iduser = :id ";
            $parameters['id'] = $idUser;
            $this->coneccion = Connection::getInstance();

            $result = $this->coneccion->Execute($sql, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }

        if (!empty($result)) {
            foreach ($result as $purchase) {
                $newPurchase = new Purchase();
                $newPurchase->setId($purchase['idpurchase']);
                $newPurchase->setCosto($purchase['cost']);
                $newPurchase->setDate($purchase['date']);

                array_push($listPurchase, $newPurchase);
            }
        }
        return $listPurchase;
    }
}
