<?php 
namespace Models;

class TypeMovieShow{

    private $id;
    private $name;
    private $costTicket;


    public function setId($id){
        $this->id=$id;
    }

    public function getId(){
        return $this->id;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function setCostTicket($costTicket){
        $this->costTicket = $costTicket;
    }

    public function getCostTicket(){
        return $this->costTicket;
    }
}
?>