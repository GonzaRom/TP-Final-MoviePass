<?php
namespace Models;

class Purchase{
    private $id;
    private $date;
    private $tickets;
    private $idUser;
    private $costo;


    public function setId($id){
        $this->id = $id;
    }
    public function setDate($date){
        $this->date = $date;
    }
    public function setTickets($tickets){
        $this->tickets = $tickets;
    }
    public function setIdUser($idUser){
        $this->idUser = $idUser;
    }

    public function getId(){
        return $this->id;
    }
    public function getDate(){
        return $this->date;
    }
    public function getTickets(){
        return $this->tickets;
    }
    public function getIdUser(){
        return $this->idUser;
    }
    public function setCosto($costo){
        $this->costo = $costo;
    }
    public function getCosto(){
        return $this->costo;
    }

}





?>