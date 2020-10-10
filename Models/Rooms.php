<?php 

namespace Models;


class Rooms{
    private $id;
    private $name;
    private $capacity;
    private $typeRoom;
    private $Cinema;

    public function set_id($id){
        $this->id = $id;
    }
    public function set_name($name){
        $this->name = $name;
    }
    public function set_capacity($capacity){
        $this->capacity = $capacity;
    }
    public function set_typeRoom($typeRoom){
        $this->typeRoom = $typeRoom;
    }
    public function set_Cinema($idCinema){
        $this->idCinema = $idCinema;
    }
    public function get_id(){
        return $this->id;
    }
    public function get_name(){
        return $this->name;
    }
    public function get_capacity(){
        return $this->capacity;
    }
    public function get_typeRoom(){
        return $this->typeRoom;
    }
    public function get_Cinema(){
        return $this->idCinema;
    }

}



?>