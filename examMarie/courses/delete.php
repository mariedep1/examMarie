<?php

/**
 * 
 * supprime une course via un id 
 * @param integer $id
 * @return void 
 */
function deleteCourse(int $id) :void {

    $pdo=getPdo(); 
    $requeteDelete = $pdo->prepare("DELETE FROM courses WHERE id = :id"); 
    $requeteDelete -> execute(['id'=> $id]);
    header("Location: index.php"); 
}