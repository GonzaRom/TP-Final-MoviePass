<?php
<<<<<<< HEAD
  if(isset($_SESSION["loggedUser"])){
    header('Location:'.FRONT_ROOT.'Home/Index');
  }else{
    header('Location:'.FRONT_ROOT.'User/showLoginView'); 
=======
  if(!isset($_SESSION["loggedUser"])){
    header('Location:'.FRONT_ROOT.'User/showLoginView');  
  }else{
    header('Location:'.FRONT_ROOT.'Home/Index');
>>>>>>> origin/Gonzalo
  }
    
?>