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


                /* La funcion Add nos permite agregar un nuevocine(movietheater) a nuestro DAO,
                donde tenemos persistidos nuestra info*/
        public function Add($name,$adress,$phonenumber){
            $message="El cine ya existe";
            $cinemalist=$this->cinemadao->GetAll();/* variable donde guardamos la lista de cines traida desde json. */
            $flag=false;
            foreach($cinemalist as $cinema){
                if($cinema->GetName()==$name && $cinema->GetAdress()==$adress){
                    $flag=true;
                }
            }
            if(!$flag){
                $message="Cine agregao exitosamente";
                $newcinema=new Cinema;
                $newcinema->SetId();
            }
        }
    }
?>