<?php


//http://php.net/manual/en/function.trim.php <--- Trimming data to remove unneeded white spaces.
//http://php.net/manual/en/function.preg-replace.php <--- Replacing extra white spaces with a single white space
//Required files

require_once('inc/config.inc.php');
require_once('inc/functionHelperList.php');
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
$page->searchForm();
//Header

$objMapper;
$sampleObject;

$tableName = "Vehicles";
if(isset($_GET['tables'])){
    $tableName = $_GET['tables'];
}

//Check GET data to understand what Table we are dealing with and create an ObjectMapper based on that
if($tableName === "Transportation Type"){
    $objMapper = new TransportationTypeMapper();
    if (empty($_POST))  {

    } else {
        if(isset($_POST['searchTerm'])){
            $page->displayTransTypeData($objMapper->searchDisplay($_POST['searchTerm']));
            exit;
        }
        //Verify the post data
        elseif (!isset($_POST['name'])
            || !isset($_POST['description'])
            || !isset($_POST['wheels'])
            || !isset($_POST['fuel'])){

            //Display an alert
            echo '<DIV CLASS="alert alert-danger">You have not entered the appropriate details.<br/>
            Please go back and try again.</DIV> ';

            exit;
        }else {

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
        if(isset($_POST['searchTerm'])){
            $page->displayOwnerData($objMapper->searchDisplay($_POST['searchTerm']));
            exit;
        }
        //Verify the post data
        elseif (!isset($_POST['name'])
            || !isset($_POST['city'])
            || !isset($_POST['gender'])
            || !isset($_POST['familySize']) )  {

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
        if(isset($_POST['searchTerm'])){
            $page->displayVehicleData($objMapper->searchDisplay($_POST['searchTerm']));
            exit;
        }
        //Verify the post data
        elseif (!isset($_POST['makeModel'])
            || !isset($_POST['color'])
            || !isset($_POST['typeId'])
            || !isset($_POST['ownerId']))  {

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
if (isset($_GET['action']) && $_GET['action'] === "delete" && isset($_GET['id']))   {
    //Delete the object
    $results = $objMapper->delete($_GET['id']);
    echo '<DIV CLASS="alert alert-success">Customer '.$results.' has been deleted.</DIV>';
}

$page->tableChooser();

//Display the data
if($tableName === "Transportation Type"){
  $page->addTransTypeForm();
  $page->displaytransTypeData($objMapper->listAll());
}elseif($tableName === "Owner"){
  $page->addOwnerForm();
  $page->displayOwnerData($objMapper->listAll());
}else{
  $page->addVehicleForm();
  $page->displayVehicleData($objMapper->listAll());
}




//Footer
$page->footer();


?>
