<?php

//Required files

require_once('inc/config.inc.php');
require_once('inc/owner.class.php');
require_once('inc/transportationType.class.php');
require_once('inc/vehicle.class.php');
require_once('inc/pdo.inc.php');
require_once('inc/ownerMapper.class.php');
require_once('inc/transportationTypeMapper.class.php');
require_once('inc/vehicleMapper.class.php');
require_once('inc/page.inc.php');

$page = new Page();


$page->header();
//Header

$objMapper;
$sampleObject;


$tableName = "Vehicles";
if(isset($_GET['tables'])){
    $tableName = $_GET['tables'];
}

//Check GET data to understand what Table we are dealing with and create an ObjectMapper based on that
if($tableName === "Transportation Type"){
    $objMapper = new TransportationType();
    if (empty($_POST))  {

    } else {

        //Verify the post data
        if (   empty($_POST['type'])if($tableName === "Transportation Type"){
            || empty($_POST['name'])
            || empty($_POST['description'])
            || empty($_POST['wheels']) )
            || empty($_POST['fuel']){

            //Display an alert
            echo '<DIV CLASS="alert alert-danger">You have not entered the appropriate details.<br/>
            Please go back and try again.</DIV> ';

            exit;
        } else {

                //We have the right data, lets go ahead and add the customer via the customer mapper
                unset($_GET['id']);
                unset($_GET['action']);
                $newid = $objMapper->create($_POST);

                //Display a message to the user that the customer has been created
                echo '<DIV CLASS="alert alert-success">New '.$tableName.' '.$newid.' has been created!<BR></DIV>';
        }

    }
}elseif($tableName === "Owner"){
    $objMapper = new OwnerMapper();
    if (empty($_POST))  {

    } else {

        //Verify the post data
        if (   empty($_POST['name'])
            || empty($_POST['city'])
            || empty($_POST['gender'])
            || empty($_POST['family']) )  {

            //Display an alert
            echo '<DIV CLASS="alert alert-danger">You have not entered the appropriate details.<br/>
            Please go back and try again.</DIV> ';

            exit;
        } else {

                //We have the right data, lets go ahead and add the customer via the customer mapper
                unset($_GET['id']);
                unset($_GET['action']);
                $newid = $objMapper->create($_POST);

                //Display a message to the user that the customer has been created
                echo '<DIV CLASS="alert alert-success">New '.$tableName.' '.$newid.' has been created!<BR></DIV>';
        }

    }
}else{
    //Create a default table
    $objMapper = new VehicleMapper();
    if (empty($_POST))  {

    } else {

        //Verify the post data
        if (   empty($_POST['makeModel'])
            || empty($_POST['color'])
            || empty($_POST['owner'])
            || empty($_POST['type']) )  {

            //Display an alert
            echo '<DIV CLASS="alert alert-danger">You have not entered the appropriate details.<br/>
            Please go back and try again.</DIV> ';

            exit;
        } else {

                //We have the right data, lets go ahead and add the customer via the customer mapper
                unset($_GET['id']);
                unset($_GET['action']);
                $newid = $objMapper->create($_POST);

                //Display a message to the user that the customer has been created
                echo '<DIV CLASS="alert alert-success">New '.$tableName.' '.$newid.' has been created!<BR></DIV>';
        }

    }
}

//Check GET data to see if we should delete a an object
if (isset($_GET['action']) && $_GET['action'] == "delete" && isset($_GET['id']))   {
    //Delete the object
    $results = $objMapper->delete($_GET['id']);
    echo '<DIV CLASS="alert alert-success">Customer '.$results.' has been deleted.</DIV>';
}



$page->tableChooser();


if($tableName === "Transportation Type"){
  $page->addTransportationTypeForm();
  $page->displaytransTypeData($objMapper->listAll());
}elseif($tableName === "Owner"){
  $page->addOwnerForm();
  $page->displayOwnerData($objMapper->listAll());
}else{
  $page->addVehicleForm();
  $page->displayVehicleData($objMapper->listAll());
}




//Display the data

//Footer
$page->footer();


?>
