<?php
//This file is mainly for helper functions that can be reused

function returnForm(){
  if(isset($_GET['tables'])){
      echo '<a href="finalproject.php?tables='.$_GET['tables'].'">Click here to go back</a>';
  }else{
    echo '<a href="finalproject.php">Click here to go back</a>';
  }
}

function cleanString($string){
  $string = trim($string); //Remove whitespaces at tips
  $string = preg_replace('/\s+/', ' ',$string); //Removes multiple whitespaces and replaces them with a single space
  return $string;
}

function validateNumber($num, $min, $message){
  if(filter_var($num, FILTER_VALIDATE_INT) === 0 || filter_var($num, FILTER_VALIDATE_INT,array("options" => array("min_range"=>$min)))) {
    return;
  }else{
    echo '<DIV CLASS="alert alert-danger">'. $message.'</DIV>';
    returnForm();
    die;
  }
}

?>
