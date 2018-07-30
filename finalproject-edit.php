<?php
require_once('inc/config.inc.php');
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

//Ensure the right table is used
$tableName = "Vehicles";
if(isset($_GET['tables'])){
    $tableName = $_GET['tables'];
}

if($tableName === "Transportation Type"){
    $objMapper = new TransportationTypeMapper();

    if(empty($_POST)) {

    } else {
        //Verify data
        if(empty($_POST['name'])
        || empty($_POST['description'])
        || empty($_POST['wheels'])
        || empty($_POST['fuel']) ){
        
            //Display an alert
            echo '<DIV CLASS="alert alert-danger">You have not entered the appropriate customer details.<br/>
            Please go back and try again.</DIV> ';

            exit;
        } else {
            $results = $objMapper->update($_POST);
            echo '<DIV CLASS="alert alert-success">Customer '.$results.' has been updated.<br>
            <a href="finalproject.php?tables=Transportation Type">Click here to go back</a></DIV>';
        }
    }
        if (isset($_GET['id']))   {
            $page->editTransTypeForm($objMapper->read($_GET['id']));   
        }else {
            echo '<DIV CLASS="alert alert-success">No customer ID to edit. Please go update a customer from <a href="Lab08AVi_68076.php">this</a> page.</DIV>';
        }

} elseif($tableName === "Owner") {
    $objMapper = new OwnerMapper();
    if(empty($_POST)) {

    } else {
            if(empty($_POST['name'])
            || empty($_POST['city'])
            || empty($_POST['gender'])
            || empty($_POST['familySize']) )  {
                var_dump($_POST);
            //Display an alert
            echo '<DIV CLASS="alert alert-danger">You have not entered the appropriate customer details.<br/>
            Please go back and try again.</DIV> ';

            exit;
            } else {
                $results = $objMapper->update($_POST);
                echo '<DIV CLASS="alert alert-success">Customer '.$results.' has been updated.<br>
                <a href="finalproject.php?tables=Owner">Click here to go back</a></DIV>';
            }
        }
            if (isset($_GET['id']))   {
                $page->editOwnerForm($objMapper->read($_GET['id']));   
            }else {
                echo '<DIV CLASS="alert alert-success">No customer ID to edit. Please go update a customer from <a href="Lab08AVi_68076.php">this</a> page.</DIV>';
            }
} else {
    $objMapper = new VehicleMapper();
    if(empty($_POST)) {

    } else {
        if (empty($_POST['makeModel'])
            || empty($_POST['color'])
            || empty($_POST['typeId'])
            || empty($_POST['ownerId']))  {
                //Display an alert
                echo '<DIV CLASS="alert alert-danger">You have not entered the appropriate customer details.<br/>
                Please go back and try again.</DIV> ';
            
                exit;
            } else {
                $results = $objMapper->update($_POST);
                echo '<DIV CLASS="alert alert-success">Customer '.$results.' has been updated.<br>
                <a href="finalproject.php?tables=Vehicles">Click here to go back</a></DIV>';
            }
        }
            if (isset($_GET['id']))   {
                $page->editVehicleForm($objMapper->read($_GET['id']));   
            }else {
                echo '<DIV CLASS="alert alert-success">No customer ID to edit. Please go update a customer from <a href="Lab08AVi_68076.php">this</a> page.</DIV>';
            }
}

$page->footer();

?>