<?php
require_once('inc/config.inc.php');
require_once('inc/functionHelperList.php');
require_once('inc/pdo.inc.php');
require_once('inc/page.inc.php');
require_once('inc/owner.class.php');
require_once('inc/transportationType.class.php');
require_once('inc/vehicle.class.php');
require_once('inc/ownerMapper.class.php');
require_once('inc/transportationTypeMapper.class.php');
require_once('inc/vehicleMapper.class.php');

//Create new Page
$page = new Page();

$page->header();

$objMapper;

//Get the table being used
$tableName = "Vehicles";
if(isset($_GET['tables'])){
    $tableName = $_GET['tables'];
}

//Code for the next 3 tables are similiar. Will comment mainly on the the first one.
if($tableName === "Transportation Type"){
    $objMapper = new TransportationTypeMapper();

    if(empty($_POST)) {
      //If nothing is posted, do nothing
    } else {
        //Else, verify data we need is complete
        if(empty($_POST['name'])
        || empty($_POST['description'])
        || (!isset($_POST['wheels']))
        || empty($_POST['fuel']) ){

            //Display an alert stating data is incomplete
            echo '<DIV CLASS="alert alert-danger">You have not entered the appropriate details.<br/>
            </DIV> ';
            returnForm();
            exit;
        } else {
            //Otherwise, update the object if the data is complete
            $results = $objMapper->update($_POST);
            returnForm();
        }
    }
        if (isset($_GET['id']))   {
            //If a proper ID target for updating is set, display the update form
            $page->editTransTypeForm($objMapper->read($_GET['id']));
        }else {
            //else display an error message
            echo '<DIV CLASS="alert alert-success">No ID to edit. </DIV>';
            returnForm();
        }

} elseif($tableName === "Owner") {
    $objMapper = new OwnerMapper();
    if(empty($_POST)) {

    } else {
            if(empty($_POST['name'])
            || empty($_POST['city'])
            || empty($_POST['gender'])
            || empty($_POST['familySize']) )  {
                // var_dump($_POST);
            //Display an alert
            echo '<DIV CLASS="alert alert-danger">You have not entered the appropriate details.<br/>
            </DIV> ';
            returnForm();

            exit;
            } else {
                $results = $objMapper->update($_POST);
                returnForm();
            }
        }
            if (isset($_GET['id']))   {
                $page->editOwnerForm($objMapper->read($_GET['id']));
            }else {
                echo '<DIV CLASS="alert alert-success">No owner ID to edit.</DIV>';
                returnForm();
            }
} else {
    $objMapper = new VehicleMapper();
    if(!empty($_POST)) {
        if (empty($_POST['makeModel'])
            || empty($_POST['color'])
            || empty($_POST['typeId'])
            || empty($_POST['ownerId']))  {
                //Display an alert
                echo '<DIV CLASS="alert alert-danger">You have not entered the appropriate details.<br/>
                </DIV> ';
                returnForm();

                exit;
            } else {
                $results = $objMapper->update($_POST);
                returnForm();

            }
        }
            if (isset($_GET['id']))   {
                $page->editVehicleForm($objMapper->read($_GET['id']));

            }else {
                echo '<DIV CLASS="alert alert-success">No vehicle ID to edit.</DIV>';
                returnForm();
            }
}

$page->footer();

?>
