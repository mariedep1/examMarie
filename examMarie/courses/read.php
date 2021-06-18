<?php

/**
 * 
 * retourne un tableau avec toutes les courses ou un bool 
 * @return array|bool
 */

function findAllCourses(){

    $pdo = getPdo(); 
    $resultat = $pdo ->query('SELECT * FROM courses'); 
    $courses = $resultat->fetchAll();
    return $courses;

}