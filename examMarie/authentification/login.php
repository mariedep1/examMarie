<?php 


// on verifie que POST a bien été initialisée aux bons indexs
//on verifie qu'aucune des deux chaines de caractere n'est "" 

//on interroge la base de données : y a-t-il un username correspondant dans la table users ?

//si oui, est-ce que le mot de passe est le mme que celui entré
                //si oui  =   isLoggedIn devient true
  

if (isset($_POST['username']) && isset($_POST['password'])){
  
 $usernameEntre = $_POST['username'];
  $passwordEntre = $_POST['password'];

  if( $usernameEntre != "" && $passwordEntre !=""){
      require_once dirname(__FILE__)."/../access/db.php";

      $pdo = getPdo(); 
      $maRequete = $pdo->prepare("SELECT * FROM users WHERE username = :usernameEntre");
      $maRequete->execute(['usernameEntre'=>$usernameEntre]);
      $monResultatRequete = $maRequete->fetch();

      
          if($monResultatRequete){                     
                      $vraiMotDePasse =  $monResultatRequete['password'];
                      $userId = $monResultatRequete['id'];
                      $userName = $monResultatRequete['username'];     
                      
          

            //  require_once dirname(__FILE__)."/../access/salt.php";
              if( $passwordEntre == $vraiMotDePasse  ){

                  $isLoggedIn = true;
                  $_SESSION['userId'] = $userId;  
                  $_SESSION['username'] = $userName;  
                 
                  
              }else{
                  echo "mauvais mot de passe, $usernameEntre";
              }

          }else{
              echo "username inexistant dans la DB";
          }


  }else{

      echo "Veuillez entrer un username et un password";
  }


}

?>