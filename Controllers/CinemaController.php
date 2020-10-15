<?php

namespace Controllers;

use Models\Cinema as Cinema;
use DAO\CinemaDAO as CinemaDAO;

class CinemaController
{
    private $cinemadao;   /*DAO con el cual vamos a gestionar la informacion persistida
                                    momentaneamente en json*/

    public function __construct()
    {
        $this->cinemadao = new CinemaDAO;
    }

    /* funcion q llama a la vista de agregado de cinema */
    public function showAddView($message = "")
    {
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
            $newcinema->setId(end($cinemalist)->getId() + 1);
            $newcinema->setName($name);
            $newcinema->setAdress($adress);
            $newcinema->setPhoneNumber($phonenumber);
            $this->cinemadao->add($newcinema);;/* pusheamos el nuevo cinema dentro del DAO */
        }
        $this->showAddView($message); //invocamos la vista enviandole como parametro el mensaje correspondiente.
    }

    /* La funcion delete elimina un cinema recibiendo como parametro el id del cinema */
    public function delete($id)
    {
        $message = 2; //variable q se va a usar como retorno para informar exito o no
        $cinemalist = $this->cinemadao->getAll();
        foreach ($cinemalist as $key => $cinema) {
            if ($cinema->getId() == $id) {
                $this->cinemadao->delete($key);
                $message = 1;
            }
        }
        $this->showListView($message); //invocamos la vista enviandole como parametro el mensaje correspondiente.
    }

    public function update($id)
    {
        $message = "";
        $cinema = $this->cinemadao->get($id);
        if ($cinema == null) {
            $message = "Error, cinema no encontrado";
            require_once(VIEWS_PATH . "list-Cinema.php");
        } else {
            require_once(VIEWS_PATH . "update-Cinema.php");
            $cinema = new Cinema();
            $cinema->setName($name);
            $cinema->setAdress($adress);
            $cinema->setPhonenumber($phonenumber);
            $flag = $this->cinemadao->update($id, $cinema);
            ($flag) ? $this->showListView($message = "Actualizacion exitosa!") : $this->showListView($message = "Falla en actualizacion!");
        }
    }
}
