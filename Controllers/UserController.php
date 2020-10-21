<?php

namespace Controllers;

use DAO\UserDAO;
use DAO\UserTypeDAO;
use DAO\MovieDAO as MovieDAO;
use Models\User;
use DAO\GenreDAO;

class UserController
{
    private $userDAO;
    private $userTypeDAO;
    private $movieDAO;
    private $genreDAO;

    public  function __construct()
    {
        $this->userDAO = new UserDAO();
        $this->userTypeDAO = new UserTypeDAO();
        $this->movieDAO = new MovieDAO();
        $this->genreDAO = new GenreDAO();
    }
    public function showLoginView($message = "")
    {
        require_once(VIEWS_PATH . "login.php");
    }

    public function showSingInView($message = "")
    {
        $userTypeList = $this->userTypeDAO->getAll();
        require_once(VIEWS_PATH . "sign-in.php");
    }

    public function showHomeView($message = "")
    {
        $nowPlayingMoviesList = array();
        try {
            $nowPlayingMoviesList = $this->movieDAO->getAllBackground();
            $genreList = $this->genreDAO->getAll();

            require_once(VIEWS_PATH . "home.php");
        } catch (\Exception $e) {
            //Por hacer:
            //return require_once(VIEWS_PATH."error_404.php");
            $message=$e->getMessage();
        }
    }

    public function login($userName = "", $password = "")
    {
        $userList = $this->userDAO->getAll();

        foreach ($userList as $user) {

            if ($user->getUsername() == $userName) {

                if (password_verify($password, $user->getPassword())) {
                    $_SESSION['loggedUser'] = $user->getId();
                    $_SESSION['userType'] = $user->getUsertype();
                    require_once(VIEWS_PATH.'validate-session.php');
                } else {
                    $message = "Contraseña Incorrecta";

                    $this->showLoginView($message);
                }
            }
        }

        $message = "Usuario no encontrado";
        $this->showLoginView($message);
    }

    public function signIn($firstName, $lastName, $userName, $email, $password, $userType = 1)
    {
        $userList = $this->userDAO->getAll();
        foreach ($userList as $user) {
            if ($user->getUserName() == $userName) {
                $message = "Nombre de usuario existente.";
                $this->showSingInView($message);
            }
        }

        $password = password_hash($password, PASSWORD_DEFAULT, array("cost" => 12));
        $newUser = new User();
        $newUser->setId($this->userid());
        $newUser->setFirstname($firstName);
        $newUser->setLastname($lastName);
        $newUser->setUserName($userName);
        $newUser->setEmail($email);
        $newUser->setPassword($password);
        $newUser->setUsertype($userType);
        $this->userDAO->add($newUser);
        if (isset($_SESSION['loggedUser'])) {
            $this->showSingInView();
        } else {
            $this->showLoginView();
        }
    }

    public function logout()
    {
        session_destroy();
        $_SESSION['loggedUser'] = array();
        $_SESSION['userType'] = array();
        $this->showLoginView();
    }

    private function userid()
    {
        $userList = $this->userDAO->getAll();
        $lastUser = end($userList);
        $id = 0;

        if ($lastUser) {

            $id = $lastUser->getId();
        }

        $id++;

        return $id;
    }
}
