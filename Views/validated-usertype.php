<?php
    if(isset($_SESSION['loggedUser'])){
        if($_SESSION['userType']=="User"){
            header('Location:'.FRONT_ROOT.'Home/Index');
        }
    }
    else{
        header('Location:'.FRONT_ROOT.'Home/Index');
    }
?>