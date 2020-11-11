<?php

namespace Controllers;

use DAO\UserDAOMSQL as UserDAOMSQL;
use DAO\UserTypeDAOMSQL as UserTypeDAOMSQL;
use DAO\MovieDAO as MovieDAO;
use Models\User;
use DAO\GenreDAOMSQL as GenreDAOMSQL;

class UserController
{
    private $userDAO;
    private $userTypeDAO;
    private $movieDAO;
    private $genreDAO;

    public  function __construct()
    {
        $this->userDAO = new UserDAOMSQL();
        $this->userTypeDAO = new UserTypeDAOMSQL();
        $this->movieDAO = new MovieDAO();
        $this->genreDAO = new GenreDAOMSQL();
    }
    public function showLoginView($message = "")
    {   require_once("Facebook/facebookConfig.php");
        $data = ["email"];
        $loginUrl = $handler->getLoginUrl($callbackUrl, $data);
        require_once(VIEWS_PATH . "login.php");
    }

    public function showHomeView($message = "")
    {
        $nowPlayingMoviesList = array();
        try {
            $nowPlayingMoviesList = $this->movieDAO->getAllBackground();
            require_once(VIEWS_PATH . "home.php");
        } catch (\Exception $e) {
            //Por hacer:
            //return require_once(VIEWS_PATH."error_404.php");
            echo $e->getMessage();
        }
    }

    public function showSingInView($message = "")
    {
        $userTypeList = $this->userTypeDAO->getAll();
        require_once(VIEWS_PATH . "sign-in.php");
    }


    public function login($userName = "", $password = "")
    {
        $user = new User();
        $user = $this->userDAO->get($userName);
        if (!empty($user)) {
            if (password_verify($password, $user->getPassword())) {
                $_SESSION['loggedUser'] = $user->getId();
                $_SESSION['userType'] = $user->getUsertype()->getName();
                require_once(VIEWS_PATH . 'validate-session.php');
            } else {
                $message = "Usuario o Contraseña Incorrecta";

                $this->showLoginView($message);
            }
        }
        $message = "Usuario no encontrado";
        $this->showLoginView($message);
    }

    public function signIn($firstName, $lastName, $userName, $email, $password, $userType = 1)
    {
        //Validaciones
        if (empty($firstName) || empty($lastName) || empty($userName) || empty($email) || empty($password)) $this->showSingInView("Todos los campos son requeridos.");
        if (!ctype_alpha($lastName)) $this->showSingInView("Solo se permiten caracteres alfabeticos en apellido!");
        if (!ctype_alpha($firstName)) $this->showSingInView("Solo se permiten caracteres alfabeticos en nombre!");
        $userName = filter_var(trim($userName), FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $this->showSingInView("Email no valido!");

        $userList = $this->userDAO->getAll();
        foreach ($userList as $user) {
            if ($user->getUserName() == $userName) {
                $message = "Nombre de usuario existente!";
                $this->showSingInView($message);
            }
            if ($user->getEmail() == $email)  $this->showSingInView("Email ya exite!");
        }

        $password = password_hash($password, PASSWORD_DEFAULT, array("cost" => 12));
        $newUser = new User();
        $newUser->setId($this->userid());
        $newUser->setFirstname(trim($firstName));
        $newUser->setLastname(trim($lastName));
        $newUser->setUserName($userName);
        $newUser->setEmail($email);
        $newUser->setPassword(trim($password));
        $newUser->setUsertype($userType);
        $this->userDAO->add($newUser);
        if (isset($_SESSION['loggedUser'])) {
            require_once(VIEWS_PATH . 'validate-session.php');
        } else {

            $para      = $email;
            $titulo    = 'Confirmar usuario.';
            $mensaje   = '<html>' .
                '<head><title>Bienvenido a multiflex</title></head>' .
                '<body><h1>Confirmar Usuario</h1>' .
                '<h2>Haga click en este enlace para confirma</h2>' .
                '<hr>' .
                '<a href=http://localhost/Projects/TP-Final-MoviePass/Home/Index>Haga clik <b>AQUI</b></a>' .
                '</body>' .
                '</html>';
            $cabeceras = 'Content-type: text/html; charset=utf-8' . "\r\n";
            $cabeceras .= 'From: ' . $email . "\r\n" .
                'Reply-To:' . $email . '"\r\n" ' .
                'X-Mailer: PHP/' . phpversion();

            mail($para, $titulo, $mensaje, $cabeceras);
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

    public function loginFacebook($userDataFacebook)
    {
        if ($userDataFacebook != null) {
            $user = $this->userDAO->get($userDataFacebook["email"]);
            if (!empty($user)) {
                $_SESSION['loggedUser'] = $user->getId();
                $_SESSION['userType'] = $user->getUsertype()->getName();
                require_once(VIEWS_PATH . 'validate-session.php');
            } else {
                //A diferencia de un usurio clasico, el usuario de FB guarda el id de FB (para futuras consultas a la API)
                $newUserFromFacebook["id"] = $userDataFacebook["id"];
                $newUserFromFacebook["email"] = $userDataFacebook["email"];
                $newUserFromFacebook["password"] = $userDataFacebook["password"];
                $newUserFromFacebook["firstName"] = $userDataFacebook["first_name"];
                $newUserFromFacebook["lastName"] = $userDataFacebook["last_name"];
                //$newUserFromFacebook["photo"] = $userDataFacebook["picture"]; <--Si nesecitamos la imagen
                $this->signUpFromFacebook($newUserFromFacebook);
            }
        } else {
            $this->homeController->showLoginView();
        }
    }

    private function signUpFromFacebook($newUserFromFacebook)
    {
        if ($newUserFromFacebook != null) {
            $password = password_hash($newUserFromFacebook["password"], PASSWORD_DEFAULT, array("cost" => 12));

            $newUser = new User();
            $newUser->setId($newUserFromFacebook["id"]);
            $newUser->setFirstname($newUserFromFacebook["firstName"]);
            $newUser->setLastname($newUserFromFacebook["lastName"]);
            //Username va a ser el mismo email
            $newUser->setUserName($newUserFromFacebook["email"]);
            $newUser->setEmail($newUserFromFacebook["email"]);
            $newUser->setPassword($password);
            $newUser->setUsertype("1");
            //Agregamos el nuevo usario a la base de datos
            $this->userDAO->add($newUser);
            //hacemos la consulta para confirmar que se guardo correctamente
            $user = $this->userDAO->get($newUser->getEmail());
            $_SESSION['loggedUser'] = $user->getId();
            $_SESSION['userType'] = $user->getUsertype()->getName();
            require_once(VIEWS_PATH . 'validate-session.php');
        } else {
            $this->homeController->showLoginView();
        }
    }
}
