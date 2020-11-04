<?php

namespace Controllers;


use Models\Cinema as Cinema;
use DAO\CinemaDAOMSQL as CinemaDAOMQSQL;
use DAO\RoomDAOMSQL as RoomDAO;
use Helpers\IsAuthorize as IsAuthorize;

class CinemaController
{
    private $cinemadao;   /*DAO con el cual vamos a gestionar la informacion persistida momentaneamente en json*/
    private $roomDAO;                             

    public function __construct()
    {
        $this->cinemadao = new CinemaDAOMQSQL();
        $this->roomDAO = new RoomDAO();
    }

    /* funcion q llama a la vista de agregado de cinema */
    public function showAddView($message = "")
    {
        require_once(VIEWS_PATH."validated-usertype.php");
        require_once(VIEWS_PATH . "add-Cinema.php");
    }
    /* funcion q llama a la vista de listado de cinema */
    public function showListView($message = "")
    {
        $cinemalist = $this->cinemadao->GetAll();/* lista q almacena nuestros cinemas para luego mostrarlos */
        require_once(VIEWS_PATH . "list-Cinema.php");
    }

    /* La funcion Add nos permite agregar un nuevocine(cinema) a nuestro DAO,
        donde tenemos persistidos nuestra info*/
    public function add($name, $adress, $phonenumber)
    {
        if(IsAuthorize::isauthorize()){
            $message = 2; //variable q se va a usar como retorno para informar exito o no
            $cinemalist = $this->cinemadao->getAll();/* variable donde guardamos la lista de cines traida desde json. */
            $flag = false; /*seteamos esta variable en falso para q nos permita agregar un cine*/
            foreach ($cinemalist as $cinema) {
                if ($cinema->getName() == $name && $cinema->getAdress() == $adress) {
                    $flag = true;  /* seteamos a true flag para q no nos permita agregar */
                }
            }
            if (!$flag) {
                $message = 1;
                $newcinema = new Cinema; //  cinema nuevo q se usara para agregar al DAO
                $newcinema->setId($this->idCinema());
                $newcinema->setName($name);
                $newcinema->setAdress($adress);
                $newcinema->setPhoneNumber($phonenumber);
                $newcinema->setIsActive(true);
                $this->cinemadao->add($newcinema);
            }
            $this->showAddView($message); //invocamos la vista enviandole como parametro el mensaje correspondiente.
        }
    }

    /* La funcion delete elimina un cinema recibiendo como parametro el id del cinema */
    public function delete($nameCinema)
    {
        if(IsAuthorize::isauthorize()){
            $message = 2; //variable q se va a usar como retorno para informar exito o no
            $cinema = $this->cinemadao->get($nameCinema);//elimina el objeto Cinema , y devuelte true si se encontro el cinema y false , si no lo encontro.
            if (!empty($cinema)) {
                //$cinema->setIsActive(false);
                $this->cinemadao->delete($cinema);
                
                $message = 1;
                
            }
            $this->showListView($message); //invocamos la vista enviandole como parametro el mensaje correspondiente.
        }
    }

    //trae el ultimo objeto del arreglo y devuelte el id incrementado.
    private function idCinema()
    {
        $cinemaList = $this->cinemadao->getAll();
        $id = 0;
        $lastCinema = end($cinemaList);
        if ($lastCinema) {
            $id = $lastCinema->getId();
        }
        $id++;
        echo $id;
        return $id;
    }

    // llama a la vista de updateCinema.
    public function showUpdateView($id)
    {
        if(IsAuthorize::isauthorize()){
            $message = "";
            $cinema = $this->cinemadao->get($id);// busca un objeto que contenga el id recibido.
            if ($cinema == null) {
                $message = "Error, cinema no encontrado";
                $this->showListView($message); // si no lo encuentra , lo regresa a la vista de list-cinema , con un mensaje de error.
            } else {
                require_once(VIEWS_PATH . "update-Cinema.php"); // si lo encuentra , muestra la vista update-cinema.
            }
        }
    }

    // actualiza el cinema, trayendo los datos por parametro.
    public function update($id, $name, $adress, $phonenumber)
    {
        if(IsAuthorize::isauthorize()){
            $cinema = $this->cinemadao->get($id);
            $cinema->setName($name);
            $cinema->setAdress($adress);
            $cinema->setPhonenumber($phonenumber);
            $flag = $this->cinemadao->update($cinema);
            ($flag) ? $this->showListView($message = "Actualizacion exitosa!") : $this->showListView($message = "Falla en actualizacion!");
        }
    }
}
