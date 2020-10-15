<?php

namespace DAO;

use Models\User;

interface IUserDAO{
    public function add(User $newUser);
    public function getAll();
    public function get($id);
    public function remove($id);
    public function update($newUser);
}


?>