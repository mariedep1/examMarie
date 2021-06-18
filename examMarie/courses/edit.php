<?php

/**
 * 
 * Modifier une course via son id
 * @param string $description
 * @param integer $id
 * @return void
 */
function editCourse(string $description, int $id) :void{

    $pdo=getPdo(); 
    $requeteEdit = $pdo->prepare("UPDATE courses SET description = :description WHERE id = :id "); 
    $requeteEdit->execute(['description'=>$description,
                            'id'=>$id]);
    header("Location: index.php");

}