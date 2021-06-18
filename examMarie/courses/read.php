<?php

/**
 * 
 * retourne un tableau avec toutes les courses ou un bool 
 * @param int $userId
 * @return array|bool
 */

function findAllCourses(int $userId){

    $pdo = getPdo(); 
    $resultat = $pdo ->prepare('SELECT * FROM courses WHERE user_id = :user_id'); 
     $resultat->execute(['user_id'=>$userId]);
    $courses = $resultat->fetchAll();
    return $courses;

}