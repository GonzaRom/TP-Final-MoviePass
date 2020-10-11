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

        /* funcion q llama a la vista de agregado de cinema */
        public function ShowAddView($message=""){
            require_once(VIEWS_PATH."add-Cinema.php");
        }
        /* funcion q llama a la vista de listado de cinema */
        public function ShowListView($message=""){
            $cinemalist=$this->cinemadao->GetAll();/* lista q almacena nuestros cinemas para luego mostrarlos */
            require_once(VIEWS_PATH."list-Cinema.php");
        }

        /* La funcion Add nos permite agregar un nuevocine(cinema) a nuestro DAO,
        donde tenemos persistidos nuestra info*/
        public function Add($name,$adress,$phonenumber){
            $message=2;//variable q se va a usar como retorno para informar exito o no
            $cinemalist=$this->cinemadao->GetAll();/* variable donde guardamos la lista de cines traida desde json. */
            $flag=false; /*seteamos esta variable en falso para q nos permita agregar un cine*/
            foreach($cinemalist as $cinema){
                if($cinema->GetName()==$name && $cinema->GetAdress()==$adress){
                    $flag=true;  /* seteamos a true flag para q no nos permita agregar */
                }
            }
            if(!$flag){
                $message=1;
                $newcinema=new Cinema;//  cinema nuevo q se usara para agregar al DAO
                $newcinema->SetId(end($cinemalist)->GetId()+1);
                $newcinema->SetName($name);
                $newcinema->SetAdress($adress);
                $newcinema->SetPhoneNumber($phonenumber);
                $this->cinemadao->Add($newcinema);;/* pusheamos el nuevo cinema dentro del DAO */
            }
            $this->ShowAddView($message);//invocamos la vista enviandole como parametro el mensaje correspondiente.
        }

        /* La funcion delete elimina un cinema recibiendo como parametro el id del cinema */
        public function Delete($id){
            $message=2;//variable q se va a usar como retorno para informar exito o no
            $cinemalist=$this->cinemadao->GetAll();
            foreach($cinemalist as $key => $cinema){
                if($cinema->GetId()==$id){
                    $this->cinemadao->Delete($key);
                    $message=1;
                }
            }
            $this->ShowListView($message);//invocamos la vista enviandole como parametro el mensaje correspondiente.
        }
    }
?>