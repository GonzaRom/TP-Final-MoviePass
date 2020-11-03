<?php

namespace DAO;

use Exception;
use Models\Purchase;

class PurchaseDAOMSQL implements IPurchaseDAO
{
    private $nameTable = "purchase";
    private $coneccion;



    public function add(Purchase $purchase)
    {
        try {
            $sql = "INSERT INTO " . $this->nameTable . " (iduser , cost , date_ , time_) VALUES (:iduser , :cost , :date , :time )";
            $parameters['iduser'] = $purchase->getIdUser();
            $parameters['cost'] = $purchase->getCosto();
            $parameters['date'] = $purchase->getDate();
            $parameters['time'] = $purchase->getTime();
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
                $purchase->setTime($purchase['time']);
                $newPurchase->setIdUser($purchase['iduser']);

                array_push($listPurchase, $newPurchase);
            }
        }
        return $listPurchase;
    }

    public function getPurchase($idUser, $date, $time)
    {
        $purchase = null;
        try {
            $sql = "SELECT * FROM " . $this->nameTable . " WHERE iduser = :id AND date_ = :date AND time_ = :time";
            $parameters['id'] = $idUser;
            $parameters['date'] = $date;
            $parameters['time'] = $time;
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
                $newPurchase->setDate($purchase['date_']);
                $newPurchase->setTime($purchase['time_']);
                $newPurchase->setIdUser($purchase['iduser']);

                $purchase =  $newPurchase;
            }
        }
        return $purchase;
    }

    public function getAll()
    {
        $purchase = null;
        try {
            $sql = "SELECT * FROM " . $this->nameTable . " as p INNER JOIN tickets as t ON p.idpurchase = t.idpurchase";
            $this->coneccion = Connection::getInstance();

            $result = $this->coneccion->Execute($sql);
        } catch (Exception $ex) {
            throw $ex;
        }

        if (!empty($result)) {
            foreach ($result as $purchase) {
                $newPurchase = new Purchase();
                $newPurchase->setId($purchase['idpurchase']);
                $newPurchase->setCosto($purchase['cost']);
                $newPurchase->setDate($purchase['date_']);
                $newPurchase->setTime($purchase['time_']);
                $newPurchase->setIdUser($purchase['iduser']);

                $purchase =  $newPurchase;
            }
        }
        return $purchase;
    }
}
