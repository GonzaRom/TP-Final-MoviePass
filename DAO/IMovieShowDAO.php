<?php
namespace DAO;

use Models\MovieShow;

interface IMovieShowDAO {

    public function add(MovieShow $newMovieShow);
    public function getAll();
    public function remove($id);
    public function get($id);
    
}



?>