<?php
  if(isset($_SESSION["loggedUser"])){
    if(isset($_SESSION['movieshow'])){
      header('Location:'.FRONT_ROOT.'Ticket/showAddTicketView?movieshow='. $_SESSION['movieshow']);
    }else{
      header('Location:'.FRONT_ROOT.'Home/Index');
    }
    
  }else{
    header('Location:'.FRONT_ROOT.'User/showLoginView'); 
  }
    
?>