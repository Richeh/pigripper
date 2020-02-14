<?php

function getCategories(){
    $sql = "SELECT * FROM `article_categories`;";
    $query = $GLOBALS['pdo']->prepare($sql);
    $query->execute();
    $categories = $query->fetchAll(PDO::FETCH_ASSOC);
    $return = Array();
    foreach( $categories as $category ){
        $return[$category['id']] = $category;
    }
    return $return;
} 

function getArticlesCategories(){
    
}