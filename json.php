<?php 
header('Content-Type: application/json');
require("imports/bootstrap.php");

$startDate = takeInput("startDate");
$endDate = takeInput("endDate");
$table = takeInput('table');

$GLOBALS['categories'] = getCategories();

switch($table){
    
    case "articles":
        
        $sql = "
            SELECT
	*,
	GROUP_CONCAT(
		DISTINCT `article_categories_linker`.`category` SEPARATOR ','
	) AS `categoryValues`,
COALESCE(`user_name`,`author`) as `authorName_definitive`
FROM
	`articles`
LEFT JOIN `article_categories_linker` ON `articles`.`id` = `article_categories_linker`.`article`
left join (select `id` as `advertiser_id`, `name` as `advertiser_name` from `advertisers`) as `advertisers` on `articles`.`advertiser` = `advertisers`.`advertiser_id` 
left join (select `id` as `user_id`, CONCAT(`firstname`, ' ', `lastname`) as `user_name` from `users`) as `users` on `articles`.`author` = `users`.`user_id` 
WHERE
	`datein` >= '".$startDate."'
AND `datein` <= '".$endDate."'
GROUP BY `articles`.`id`;  
            ";
        
        $itemTemplate = Array(
           "id",
           "title",
           "date",
           "snippet",
           "url",
           "categories",
           "hidden",
           "advertiser",
           "articletext", 
           "author",
           "video_url",
           "url_name"
        );
        $filterFunctions = Array(
            "date"=>"filterDate",
            "categories"=>"filterCategories",
            "newsregion"=>"filterRegion",
            "country"=>"filterCountry",
            "imagelibid"=>"filterImage",
            "advertiser" => "filterAdvertiser",
            "author" => "filterAuthor",
            "video_url"=>"filterVideo");


        break;
    
     case "news":
    
        $sql = "
            SELECT
	*,
	GROUP_CONCAT(
		DISTINCT `news_categories_linker`.`categoryid` SEPARATOR ','
	) AS `categoryValues`,
COALESCE(`user_name`,`author`) as `authorName_definitive`
FROM
	`news`
LEFT JOIN `news_categories_linker` ON `news`.`id` = `news_categories_linker`.`newsid`
left join (select `id` as `user_id`, CONCAT(`firstname`, ' ', `lastname`) as `user_name` from `users`) as `users` on `news`.`author` = `users`.`user_id` 
left join (select `iso` as `iso`, `printable_name` as `country_name` from `country`) as `countries` on `news`.`country` = `countries`.`iso` 
left join (select `id` as `image_id`, `filename` as `image_filename` from `imagelib`) as `imagelib` on `news`.`imagelibid` = `imagelib`.`image_id` 
left join (select `id` as `region_id`, `name` as `region_name` from `regions`) as `regions` on `news`.`newsregion` = `regions`.`region_id` 
WHERE
	`datein` >= '".$startDate."'
AND `datein` <= '".$endDate."'
GROUP BY `news`.`id`;  
            ";
        
        $itemTemplate = Array(
           "id",
           "title",
           "date",
           "snippet",
           "url",
           "newsregion",
           "categories",
           "hidden",
           "articletext", 
           "country",
           "author",
           "imagelibid",
           "video_url",
           "url_name"
        );
        $filterFunctions = Array(
            "date"=>"filterDate",
            "categories"=>"filterCategories",
            "newsregion"=>"filterRegion",
            "country"=>"filterCountry",
            "imagelibid"=>"filterImage",
            "advertiser" => "filterAdvertiser",
            "author" => "filterAuthor",
            "video_url"=>"filterVideo");


        break;
    
    
    default:
      
        break;
}


//echo $sql;
$query = $GLOBALS['pdo']->prepare($sql);
$query->execute();
$records = $query->fetchAll();

$items = Array();
$items['entries'] = Array();

foreach($records as $record){
  $item = Array();
    foreach( $itemTemplate as $itIndex => $itName){
      if(array_key_exists($itName, $filterFunctions)){          
       
          eval('$item[$itName]='.$filterFunctions[$itName].'($record);');
      }
      else{
          $item[$itName] = $record[$itName];
      }
  }
  
  $items["entries"][] = $item;
   
   
   
}


echo json_encode($items, JSON_PRETTY_PRINT);


?>