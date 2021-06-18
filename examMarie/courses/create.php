<?php

/**
 * 
 * 
 * ajoute une course 
 * @param string $description
 * @param int $user_id
 * @return void
 */
function createCourse(string $description, int $user_id) :void{

    $pdo=getPdo(); 

    $requeteCreate = $pdo->prepare("INSERT INTO courses(description, deja_achete, user_id) VALUES (:description, 0, :user_id)"); 
    $requeteCreate->execute(['description'=>$description,
                              'user_id'=>$user_id]); 
    header("Location: index.php"); 

}