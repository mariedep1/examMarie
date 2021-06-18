
<?php 
session_start();
if(isset($_POST['logOut'])){
   session_unset();
} 

require_once dirname(__FILE__)."/../access/db.php";
require_once dirname(__FILE__)."/../authentification/auth.php";
require_once "create.php";
require_once "read.php";
require_once "edit.php";
require_once "delete.php";




// on surveille ici POST ou GET, on vérifie les données et on appelle les function selon.



//on récupère toutes les courses 
if($isLoggedIn ){
$courses = findAllCourses($_SESSION['userId']); 
}

//supprimer une course


if( isset($_POST['idASupprimer']) && $_POST['idASupprimer']!=""){
    $courseId = $_POST['idASupprimer']; 
        if($isLoggedIn){
            deleteCourse($courseId); 
    }
}

//ajouter une course 

if(isset($_POST['descriptionCourse']) && $_POST['descriptionCourse']!=""){
    $descriptionCourse = htmlspecialchars($_POST['descriptionCourse']);
    createCourse($descriptionCourse, $_SESSION['userId']); 
}

//modifier une course 

if(isset($_POST['idModification']) && $_POST['idModification']!=""){
    $courseId=$_POST['idModification']; 
    if(isset($_POST['modification']) && $_POST['modification']!=""){
        $descriptionCourse= $_POST['modification']; 
        editCourse($descriptionCourse, $courseId); 

    }
}

if( isset($_POST['achete']) && $_POST['achete']!=""){
    $pdo = getPdo(); 
    $courseId= $_POST['achete'];
    $maRequete = $pdo->prepare("UPDATE courses SET deja_achete = 0 WHERE id =:course_id");
    $maRequete->execute(['course_id'=>$courseId]);
    header("Location: index.php"); 
}
if( isset($_POST['pasAchete']) && $_POST['pasAchete']!=""){
    $pdo = getPdo(); 
    $courseId= $_POST['pasAchete'];
    $maRequete = $pdo->prepare("UPDATE courses SET deja_achete = 1 WHERE id =:course_id");
    $maRequete->execute(['course_id'=>$courseId]);
    header("Location: index.php"); 
}