<?php

function filterDate($record){
    return $record['datein']." ".$record['timein'];
    
}

function filterNews($record){
}


function filterCategories($record){
       
    $categoryIds = Array();
    if(strlen($record['categoryValues'])>0 ){
        $categoryIds = explode($record['categoryValues'], ",");
        $categoryIds = array_flip($categoryIds);
    }
    
    if(array_key_exists("category", $record) && $record['category'] != "0"){
        $categoryIds[$record['category']] = true;
    }
    
    if(array_key_exists("categoryid", $record) && $record['categoryid'] != "0"){
        $categoryIds[$record['categoryid']] = true;
    }
    
    
        $return[] = Array();
        unset($return[0]);
    foreach($categoryIds as $categoryId => $number){
        if( $categoryId != "" && $categoryId  && array_key_exists($categoryId ,$GLOBALS['categories'] ) 
                && is_array($GLOBALS['categories'][$categoryId]) 
                && $GLOBALS['categories'][$categoryId]['name'] != null 
                && $GLOBALS['categories'][$categoryId]['name'] != ""){
        $return[] = $GLOBALS['categories'][$categoryId]['name'];
        }
    }
    
    
    return $return;    
}

function filterImage($record){
    return $record['image_filename'];
}

function filterVideo($record){
    
}
function filterRegion($record){
    if(array_key_exists($record['region_name'], $GLOBALS['regionReplacements'])){
        return $GLOBALS['regionReplacements'][$record['region_name']];        
    }
    return $record['region_name'];
    
    
}

function filterAuthor($record){
    if(array_key_exists($record['authorName_definitive'], $GLOBALS['authorReplacements'])){
        return $GLOBALS['authorReplacements'][$record['authorName_definitive']];        
    }
    return $record['authorName_definitive'];
}

function filterCountry($record){
    if(array_key_exists($record['country_name'], $GLOBALS['countryReplacements'])){
        return $GLOBALS['countryReplacements'][$record['country_name']];        
    }
    return $record['country_name'];
}

function filterAdvertiser($record){
    return $record['advertiser_name'];
}