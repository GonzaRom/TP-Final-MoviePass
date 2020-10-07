<?php
    namespace Controllers;

    use Models\Cinema as Cinema;
    use DAO\CinemaDAO as CinemaDAO;

    class CinemaController{
        private $cinemadao;   /*DAO con el cual vamos a gestionar la informacion persistida
                                    momentaneamente en json*/
        
        public function __Construct(){
            $this->cinemadao=new CinemaDAO;
        }

        public function ShowAddView($message=""){

            require_once(VIEWS_PATH."add-Cinema.php");
        }

        /* La funcion Add nos permite agregar un nuevocine(cinema) a nuestro DAO,
        donde tenemos persistidos nuestra info*/
        public function Add($name,$adress,$phonenumber){
            $message="El cine ya existe";
            $cinemalist=$this->cinemadao->GetAll();/* variable donde guardamos la lista de cines traida desde json. */
            $flag=false; /*seteamos esta variable en falso para q nos permita agregar un cine*/
            foreach($cinemalist as $cinema){
                if($cinema->GetName()==$name && $cinema->GetAdress()==$adress){
                    $flag=true;  /* seteamos a true flag para q no nos permita agregar */
                }
            }
            if(!$flag){
                $message="Cine agregao exitosamente";
                $newcinema=new Cinema;
                $newcinema->SetId(count($cinemalist));
                $newcinema->SetName($name);
                $newcinema->SetAdress($adress);
                $newcinema->SetPhoneNumber($phonenumber);
                $this->cinemadao->add($newcinema);;/* pusheamos el nuevo cinema dentro del DAO */
            }
            $this->ShowAddView($message);
        }
    }
?>