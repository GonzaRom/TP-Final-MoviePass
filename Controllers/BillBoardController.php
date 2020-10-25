<?php
namespace Controllers;

use Models\BillBoard as BillBoard;
use Models\BillBoardDTO as BillBoardDTO;
use Models\MovieShowDTO as MovieShowDTO;
use DAO\MovieShowDAO as MovieShowDAO;
use DAO\CinemaDAO as CinemaDAO;
use DAO\BillBoardDAO as BillBoardDAO;
use DAO\RoomDAO as RoomDAO;

class BillBoardController
{
    private $movieShowDAO;
    private $cinemaDAO;
    private $billBoardDAO;
    private $roomDAO;
    //se crea el constructor que instancia todas los DAO que van a ser necesarios para aplicar en las funciones
    public function __construct()
    {
        $this->cinemaDAO = new CinemaDAO();
        $this->movieShowDAO = new MovieShowDAO();
        $this->billBoardDAO = new BillBoardDAO();
        $this->roomDAO= new RoomDAO();
    }
    
    //se encarga de mostrar la vista para agregar un nuevo Billboard dependiendo el cinema.
    public function add($message = ""){
        $listCinema = $this->cinemaDAO->getAll();
        require_once(VIEWS_PATH . "add-billboard.php");
    }
   
   
    //recibe el parametro del cinema y crear una nueva instancia de billboard y se llama al billboarDAO ,
    //el cual tiene la responsabilidad de guardar la instancia en sus respetivo espacio en la bdd
    
    public function addBillBoard($idCinema){
        echo $idCinema;
        $billBoard = new BillBoard();
        $billBoard->setId(1);
        $billBoard->setIdCinema($idCinema);
        $this->billBoardDAO->add($billBoard);
        
    }

    //retorna todas las billboards correspondientes a un cinema.
    public function getAllByIdCinema($idCinema)
    {
        if ($idCinema == null || empty($idCinema)) return $message = "ERROR Id solo puede ser un numero entero."; //compara que el parametro no sea nulo
        $cinemaArray = $this->cinemaDAO->getAll(); //trae todos los cinemas.
        if (in_array($idCinema, $cinemaArray)) { // buscar el $idCinema dentro del arreglo $cinemaArray
            $billBoard = $this->billBoardDAO->getByIdCinema($idCinema); //se almacena en $billBoard, un billBoard traido desde json, comparando el $idCinema.
            $billBoardDTO = new BillBoardDTO(); //se crea la instancia de BillBoardDTO().
            $billBoardDTO->setId($billBoard->getId()); //se setean las variables.
            $billBoardDTO->setIdCinema($idCinema); //se setean las variables.
            $billBoardDTO->setMovieShows($this->getMovieShowList($idCinema)); //se el array de movieShows correspondiente al cinema.
            /**   
                 ACA va la vista que muestre solo las funciones del cine solicitado
            **/ 
        } else {
            //404 status code
            echo "E R R O R no existe el cinema";
        }
    }
    //retorna todas las movieShow correspondientes a un cinema;
    private function getMovieShowList($idCinema)
    {
        $movieShows = $this->movieShowDAO->getByCinema($idCinema); //se traen todas las movieShow correspondientes a un cinema.
        $cinema = $this->cinemaDAO->get($idCinema); //se trae el objeto cinema.
        $listMovieShow = array();
        foreach ($movieShows as $movieShow) {
            $movieShowDTO = new MovieShowDTO(); 
            $movieShowDTO->setId($movieShow->getId()); // se cargar movieShowDTO con todas los atributos de movieShow.
            $movieShowDTO->setDate($movieShow->getDate()); //se cargar movieShowDTO con todas los atributos de movieShow.
            $movieShowDTO->setTime($movieShow->getTime()); //se cargar movieShowDTO con todas los atributos de movieShow.
            $movieShowDTO->setMovie($this->movieDAO->get($movieShow->getMovie())); //se cargar movieShowDTO con todas los atributos de movieShow.
            $movieShowDTO->setNameCinema($cinema->getName()); // se carga el nombre del cinema.
            $room = $this->roomDAO->get($movieShow->getRoom()); // se trae la room de donde se va a dar la movieShow.
            $movieShowDTO->setRoomName($room->getName()); // se cargar movieShowDTO con los atributos de room.
            $movieShowDTO->setTypeMovieShow($this->typeMovieShowDAO->getName($movieShow->getTypeMovieShow())); // se cargar movieShowDTO con los atributos de room.
            array_push($listMovieShow, $movieShowDTO); // se agrega al arreglo de movieShows.
            }
        return $listMovieShow;
    }
}
