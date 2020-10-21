<?php namespace DAO;

use Models\Ticket;



interface ITicketDAO{
    public function add(Ticket $ticket);
    public function getAll();
    public function get($id);
    public function getUser($idUser);
}
?>