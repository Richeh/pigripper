<?php 
require_once("filterFunctions.php");
require_once("dataFunctions.php");
loadSettings();

$GLOBALS['pdo'] = new PDO("mysql:host=localhost;dbname=".$GLOBALS['settings']['database'].";charset=utf8", $GLOBALS['settings']['dbuser'], $GLOBALS['settings']['dbpass'] );

//Centralized import of settings files.
function loadSettings(  ){  
    $GLOBALS['settings'] = parse_ini_file("/../settings/settings.ini");
    require_once("/../replacements/authors.php");
    require_once("/../replacements/countries.php");
    require_once("/../replacements/regions.php");
}


//Standard input.  Quick and dirty, it's a back-shop job.

function takeInput( $name ){
  $post = filter_input_array(INPUT_POST);
  $get = filter_input_array(INPUT_GET);
  $value = null;
  if( array_key_exists( $name, $_GET ) ){
      $value = $get[$name];
  }

  if( array_key_exists( $name, $_POST ) ){
      $value = $post[$name];
  }

  return $value;
}

?>