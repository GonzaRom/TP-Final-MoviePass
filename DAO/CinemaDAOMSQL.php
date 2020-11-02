<?php

namespace DAO;

use Models\Cinema as Cinema;
use Models\CinemaDTO as  CinemaDTO;
use Exception;

class CinemaDAOMSQL implements ICinemaDAO
{
    private $conection;
    private $nameTable = "cinemas";


    public function get($id)
    {

        try {
            $sql = "call get_cinema_id(:id)";

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

            $sql = "call get_cinemas();";
            $this->conection = Connection::getInstance();

            $result = $this->conection->Execute($sql);
            foreach ($result as $cinema) {
                $newCinema = new CinemaDTO();
                $newCinema->setId($cinema['idcinema']);
                $newCinema->setName($cinema['namecinema']);
                $newCinema->setAdress($cinema['adress']);
                $newCinema->setPhonenumber($cinema['phonenumber']);
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
            $sql = "call add_cinema (:namecinema , :adress , :phonenumber , :isactivec)";

            $parameters['namecinema'] = $cinema->getName();
            $parameters['adress'] = $cinema->getAdress();
            $parameters['phonenumber'] = $cinema->getPhonenumber();
            $parameters['isactivec'] = $cinema->getIsActive();

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
            $sql = "call delete_cinema(:id)";
            $parameters['id'] = $cinema->getId();
            //$parameters['isactivec'] = $cinema->getIsActive();
            $this->conection = Connection::getInstance();
            $this->conection->ExecuteNonQuery($sql, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    

    public function update(CinemaDTO $cinema)
    {

        try {
            $sql = "call update_cinema(:namecinema, :adress , :phonenumber , :isactivec, :idcinema);";

            $parameters['idcinema'] = $cinema->getId();
            $parameters['namecinema'] = $cinema->getName();
            $parameters['adress'] = $cinema->getAdress();
            $parameters['phonenumber'] = $cinema->getPhonenumber();
            $parameters['isactivec'] = $cinema->getIsActive();
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
            $newCinema->setId($p['idcinema']);
            $newCinema->setName($p['namecinema']);
            $newCinema->setAdress($p['adress']);
            $newCinema->setPhonenumber($p['phonenumber']);
            $newCinema->setIsActive($p['isactivec']);;
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
