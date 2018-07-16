<?php

//Required files

require_once('inc/config.inc.php');
require_once('inc/object1.inc.php');
require_once('inc/pdo.inc.php');
require_once('inc/object1mapper.inc.php');
require_once('inc/page.inc.php');

$page = new Page();


$page->header();
//Header

$obj;

//Check GET data to understand what Table we are dealing with and create an ObjectMapper based on that
if(false){

}elseif(false){

}else{
    //Create a default table
    $objMapper = new object1Mapper("Cars");
}


//Check POST data to see if we should delete/edit. If yes, unset GET variables.

//Check other GET data to see if we should display edit form or add a new object 


$page->tableChooser();

$page->addForm();

$page->diplayData();

//Display the data

//Footer
$page->footer();


?>