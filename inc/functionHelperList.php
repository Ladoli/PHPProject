<?php
//This file is mainly for helper functions that can be reused

//Would usually be in a page file, was placed here due to being used to handle errors in various other classes.
//Used to improve user experience letting them go back in case they come across errors
function returnForm(){
  if(isset($_GET['tables'])){
      echo '<div><a href="MACaroni.php?tables='.$_GET['tables'].'">Click here to go back</a></div>';
  }else{
    echo '<div><a href="MACaroni.php">Click here to go back</a></div>';
  }
}

//Cleans strings of various white spaces
function cleanString($string,$limit){
  $string = trim($string); //Remove whitespaces at tips
  $string = preg_replace('/\s+/', ' ',$string); //Removes multiple whitespaces and replaces them with a single space
  //Check if string is within limit, if not, display error and die
  if(strlen($string) > $limit){
    echo '<DIV CLASS="alert alert-danger">Entry '.$string.' exceeded limit of '.$limit.' for the field. </DIV>';
    returnForm();
    die;
  }
  return $string;
}

//Check if input is a number and it is within range, if not, display error and die
function validateNumber($num, $min, $max, $message){
  if(filter_var($num, FILTER_VALIDATE_INT) === 0 || filter_var($num, FILTER_VALIDATE_INT,array("options" => array("min_range"=>$min,"max_range"=>$max)))) {
    return;
  }else{
    echo '<DIV CLASS="alert alert-danger">'. $message.'</DIV>';
    returnForm();
    die;
  }
}

?>
