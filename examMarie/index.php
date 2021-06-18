<?php 

require "courses/logique.php";
?>




<!DOCTYPE html>
<html lang="fr">
  <head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
<body>
   
 

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
      </ul>


      <?php if($isLoggedIn){?>
      <h3 class='me-2'>Bonjour <?php 
            echo $_SESSION['username'];?></h3>

        <form method="POST" class="d-flex">
        
        <button type="submit" name="logOut" class="btn btn-danger my-2 my-sm-0" >Deconnexion</button>
        </form>
      <?php } ?>
        

    </div>
  </div>
</nav>







 <hr>


<?php if($isLoggedIn){?>


<br><br><br><br>

      <div class="lesCourses">

      <table class="table">
  <thead>
    <tr>
    
      <th scope="col">Course</th>
      <th scope="col">Status</th>
      <th scope="col">Editer</th>
      <th scope="col">Supprimer</th>
    </tr>
  </thead>
  <tbody>
    <tr>

    <?php foreach($courses as $course){ ?>
      <td>
        <!-- condition edition -->
        <?php if( isset($_POST['idAEditer']) && $_POST['idAEditer']!="" && $_POST['idAEditer'] == $course['id'] ){   ?> 

        <form action="" method="post">
          <input type="text" name="modification" value="<?php echo $course['description'];?>" >
          <button type="submit"  class="btn btn-success"name="idModification" value="<?php echo $course['id'] ?>">Modifier</button>
        </form>
          <!-- fin condition edition -->
            <?php }else{ ?>
          <strong><?php echo $course['description'];  ?></strong> 
          <?php } ?> 
          <!-- else condition edition -->
      </td>
      <td>
        <!-- condition achete -->
        <?php if($course['deja_achete']==1){ ?> 

          <form action="" method="POST">
            <button type="submit" class=" btn btn-success" name="achete" value="<?php echo $course['id'] ?>">Acheté</button> 
          </form>
        <?php }else{ ?> 
          <form action="" method="POST">
            <button type="submit" class="btn btn-warning" name="pasAchete" value="<?php echo $course['id'] ?>">Pas encore acheté</button> 
          </form>
        <?php } ?> 
        <!-- fin condition achete -->
      </td>
      <td>
        
        <form action="" method="POST">
              <input type="hidden" name="idAEditer" value="<?php echo $course['id'] ?>">
              <button type="submit" class="btn btn-info">Editer</button> 
        </form>

      </td>
      <td>
        
        <form action="" method="POST">
              
              <input type="hidden" name="idASupprimer" value="<?php echo $course['id'] ?>">
              <button type="submit" class="btn btn-danger" >Supprimer</button>

          </form>
      </td>
    </tr>

    <?php } ?>
    <!-- fin boucle -->
        </tbody>
  </table>


  <br><br><br><br>
  <div class="nouvelleCourse">
  
  <form action="" method="POST">
      <input type="text" placeholder="Nouveau truc à ajouter à la liste" name="descriptionCourse">
      <button type="submit" class="btn btn-success">Ajouter</button>
  </form>
  
  <?php }else{ ?>
      
      <form action="" method="post">

        <input type="text" name="username" placeholder="username">
        <input type="password" name="password" placeholder="password" >
        <button type="submit" class="btn btn-success">Se connecter</button>


      </form>
<!-- fin condition logged -->
    <?php } ?>
        





      </div>


  </div>

  <br><br>
  <p>on veut pouvoir cliquer pour changer le booleen dejaAchete, et ainsi recharger la page et que le bouton prenne la bonne couleur</p>
  <p>on veut cliquer pour supprimer et recharger la page egalement</p>
  <p>on veut editer uniquement la description lorsque l'on clique sur Editer : le nom devient alors un formulaire avec un echo dans la value</p>
  <p>pour déclencher le mode edition : on envoie dans POST l'id de la course, et la prochaine fois que l'on l'affiche, cette derniere sera en mode Edition si son ID est le même que retrouvé dans POST</p>
  <p>il y aura donc une condition pertinente dans le foreach, qui decidra pour chaque course d'un affichage normal ou en mode edition</p>

  <br><br>




  <p>Les requis, obligatoire : </p>
  <ul>
    <li>utiliser PDO</li>
    <li>utiliser bootstrap</li>
    <li>une course par ligne, utiliser soit une table, soit une liste, soit des rows</li>
    <li>la structure de la base de données est à respecter</li>
  </ul>
  <h2>1. Réaliser le projet SANS gestion d'utilisateurs</h2>
  <p>imagine que cette version ne sera utilisée que par une seule personne. La database :</p>
<img src="db.png" alt="">

<p><strong>travailler strictement dans cet ordre </strong>: afficher, supprimer, créer, et <strong>EN DERNIER</strong>, éditer</p>




  <h2>2. Uniquement quand tout marche en 1., s'intérésser au dossier authentification et à la gestion des utilisateurs</h2>
  <p>il faudra commencer sans encryption et sans salt, avec des users et passwords créés directement dans phpmyadmin </p>
  <p>l'idée sera qu'il y ait une liste de courses par utilisateur (donc une colonne user_id dans la table courses)</p>
<p>la database dans cette version-la :</p>
  <img src="db2.png" alt="">

  <h2>3.Uniquement si tout ce qui est dit avant est fonctionnel, créer un module d'inscription (signup.php) dans /authentification</h2>
      <p>c'est la partie bonus/facultative. essentiellement cela doit fonctionner sans utilisateurs, ensuite avec une connexion sur des comptes crées directement via phpmyadmin non-cryptés </p>
      <p>UNIQUEMENT APRES CES DEUX ETAPES FONCTIONNELLES  un module d'inscription et cryptage des mots de passe</p>



      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>