<?php

namespace DAO;

use Models\Cinema as Cinema;
use Models\CinemaDTO as  CinemaDTO;
use Exception;
use Models\BillBoard;
use Models\BillBoardDTO;

class CinemaDAOMSQL implements ICinemaDAO
{
    private $conection;
    private $nameTable = "cinemas";


    public function get($id)
    {

        try {
            $sql = "SELECT * FROM " . $this->nameTable . " as c INNER JOIN billboards as b ON c.idcinema = b.idcinema WHERE c.idcinema = :id";

            $parameter['id'] = $id;
            $this->conection = Connection::getInstance();
            $cinema = $this->conection->Execute($sql, $parameter);
        } catch (Exception $ex) {
            throw $ex;
        }
        if (!empty($cinema)) {
            return $this->mapear($cinema);
        } else {
            return false;
        }
    }

    public function getAll()
    {
        try {
            $cinemalist = array();

            $sql = "SELECT * FROM " . $this->nameTable. " as c INNER JOIN billboards as b ON c.idcinema = b.idcinema";
            $this->conection = Connection::getInstance();

            $result = $this->conection->Execute($sql);
            foreach ($result as $cinema) {
                $newCinema = new CinemaDTO();
                $newBillBoard = new BillBoardDTO();
                $newBillBoard->setId($cinema['idbillboard']);
                $newCinema->setId($cinema['idcinema']);
                $newCinema->setName($cinema['namecinema']);
                $newCinema->setAdress($cinema['adress']);
                $newCinema->setPhonenumber($cinema['phonenumber']);
                $newCinema->setBillBoard($newBillBoard);
                array_push($cinemalist, $newCinema);
            }
           return $cinemalist;  
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function add(Cinema $cinema)
    {


        try {
            $sql = "INSERT INTO " . $this->nameTable . " (namecinema , adress , phonenumber , isactive) VALUES (:namecinema , :adress , :phonenumber , :isactive)";

            $parameters['namecinema'] = $cinema->getName();
            $parameters['adress'] = $cinema->getAdress();
            $parameters['phonenumber'] = $cinema->getPhonenumber();
            $parameters['isactive'] = $cinema->getIsActive();

            $this->conection = Connection::getInstance();
            $result = $this->conection->ExecuteNonQuery($sql, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function delete(CinemaDTO $cinema)
    {
        print_r($cinema);
        try {
            $sql = "UPDATE " . $this->nameTable . " SET isactive = :isactive WHERE idcinema = :id";
            $parameters['id'] = $cinema->getId();
            $parameters['isactive'] = $cinema->getIsActive();
            $this->conection = Connection::getInstance();
            $this->conection->ExecuteNonQuery($sql, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    

    public function update(CinemaDTO $cinema)
    {

        try {
            $sql = "UPDATE " . $this->nameTable . " SET namecinema = :namecinema, adress = :adress , phonenumber = :phonenumber , isactive = :isactive WHERE idcinema = :idcinema ;";

            $parameters['idcinema'] = $cinema->getId();
            $parameters['namecinema'] = $cinema->getName();
            $parameters['adress'] = $cinema->getAdress();
            $parameters['phonenumber'] = $cinema->getPhonenumber();
            $parameters['isactive'] = $cinema->getIsActive();

            $this->conection = Connection::getInstance();
            $result = $this->conection->ExecuteNonQuery($sql, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    protected function mapear($value)
    {
        $value = ($value) ? $value : array();
        $resp = array_map(function ($p) {
            $newCinema = new CinemaDTO();
            $newBillBoard = new BillBoardDTO();
            $newBillBoard->setId($p['idbillboard']);
            $newCinema->setId($p['idcinema']);
            $newCinema->setName($p['namecinema']);
            $newCinema->setAdress($p['adress']);
            $newCinema->setPhonenumber($p['phonenumber']);
            $newCinema->setIsActive($p['isactive']);
            $newCinema->setBillBoard($newBillBoard);
            return $newCinema;
        }, $value);

        return count($resp) > 1 ? $resp : $resp[0];
    }

    protected function mapearTypeRoom($value)
    {
        $value = ($value) ? $value : array();
        $resp = array_map(function ($p) {
            $newCinema = new CinemaDTO();
            $newCinema->setId($p['idcinema']);
            $newCinema->setName($p['namecinema']);
            $newCinema->setAdress($p['adress']);
            $newCinema->setPhonenumber($p['phonenumber']);
            $newCinema->setIsActive($p['isactive']);
            return $newCinema;
        }, $value);

        return count($resp) > 1 ? $resp : $resp[0];
    }
}
