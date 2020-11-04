<?php

    namespace Helpers;

    class IsAuthorize{

        public static function isauthorize(){
            if(!isset($_SESSION['loggedUser'])){
                require_once(VIEWS_PATH."validate-session.php");
            }else if($_SESSION['userType']!="Admin"){
                require_once(VIEWS_PATH."validated-userType.php");
            }else{
                return true;
            }
        }       
    }
?>