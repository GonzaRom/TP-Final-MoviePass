<?php
/*
namespace DAO;

use Models\Ticket;

class TicketDAO implements ITicketDAO{
    private $listTicket = array();
    private $fileName;

    public function __construct()
    {
        $this->fileName = dirname(__DIR__)."/Data/Ticket.json";
    }
    
    public function add(Ticket $ticket)
    {
        $this->retriveData();
        array_push($this->listTicket , $ticket);
        $this->saveData();
    }

    public function get($id)
    {
        $getTicket = null;
        $this->retriveData();
        foreach($this->listTicket as $ticket){
            if($ticket->getId() == $id){
                $getTicket = $ticket;
            }
        }
        return $getTicket;
    }

    public function getAll()
    {
        $this->retriveData();
        return $this->listTicket;
        
    }

    public function getUser($idUser)
    {   
        $getUser=array();

        $this->retriveData();
        foreach($this->listTicket as $ticket){
            if($ticket->getUser() == $idUser){
                array_push($getUser , $ticket);
            }
        }
    return $getUser;
    }

    private function retriveData(){
        $this->listTicket = array();

        if(file_exists($this->fileName)){
            
            $jsonContent  = file_get_contents($this->fileName);

            $jsonDecode = ($jsonContent) ? json_decode($jsonContent , true) : array();

            foreach($jsonDecode as $ticket){
               $newTicket =  new Ticket();
               
               $newTicket->setId($ticket['id']);
               $newTicket->setMovieShow($ticket['movieShow']);
               $newTicket->setSeat($ticket['seat']);
               $newTicket->setUser($ticket['user']);
               $newTicket->setDiscount($ticket['discount']);

               array_push($this->listTicket , $newTicket);
            }
        }
    }

    private function saveData(){
        $jsonEncode = array();

        foreach($this->listTicket as $ticket){
            $valueTicket = array();
            $valueTicket['id'] = $ticket->getId();
            $valueTicket['movieShow'] = $ticket->getMovieshow();
            $valueTicket['seat'] =$ticket->getSeat();
            $valueTicket['user'] = $ticket->getUser();
            $valueTicket['discount'] = $ticket->getDiscount();

            array_push($jsonEncode , $valueTicket);
        }

        $jsonContent = json_encode ($jsonEncode , JSON_PRETTY_PRINT);

        file_put_contents($jsonContent , $this->fileName);
    }
}
*/
?>