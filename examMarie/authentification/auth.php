<?php




$isLoggedIn = false;



            if(  isset($_SESSION['userId'])  ){
                $isLoggedIn = true;
            }

            else{
                require_once "login.php";

            }




?>