<?php
namespace DAO;

use Models\BillBoard;

interface IBillBoardDAO {
    public function add(BillBoard $newBillBoard);
    public function getAll();
    public function remove($id);
    public function get($id);
    public function getByIdCinema($id = 0);
    
}



?>