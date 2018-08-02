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
//Header
$page->header();
//Search form
$page->searchForm();

//Declare mapper
$objMapper;

//Declare default table name
$tableName = "Vehicles";

//If table name is set, update table name
if(isset($_GET['tables'])){
    $tableName = $_GET['tables'];
}

//Check table name to understand what Table we are dealing with and create an ObjectMapper based on that
//Code is similair for the 3 table types. Therefor, commenting only on the first one.
if($tableName === "Transportation Type"){
    //Assign objectMapper to a TransportationMapper class
    $objMapper = new TransportationTypeMapper();
    if (empty($_POST) || isset($_POST['searchTerm']))  {
      //If tere is no POST data or search term is set, do nothing. We can't search and add an entry at the same time you see.
    } else {

        //Verify the post data is complete for our needs to create a new entry.
    if (!isset($_POST['name'])
            || !isset($_POST['description'])
            || !isset($_POST['wheels'])
            || !isset($_POST['fuel'])){

            //If not, display an alert
            echo '<DIV CLASS="alert alert-danger">You have not entered the appropriate details.<br/>
            Please go back and try again.</DIV> ';

            exit;
        }else {
                //Clean get variables incase a delete action get in the way of adding
                unset($_GET['id']);
                unset($_GET['action']);
                $newid = $objMapper->create($_POST);

                echo '<DIV CLASS="alert alert-success">New '.$tableName.' '.$newid.' has been created!<BR></DIV>';
        }

    }
}elseif($tableName === "Owner"){
    $objMapper = new OwnerMapper();
    if (empty($_POST) || isset($_POST['searchTerm']))  {

    } else {
        //Verify the post data
        if (!isset($_POST['name'])
            || !isset($_POST['city'])
            || !isset($_POST['gender'])
            || !isset($_POST['familySize'])){

            //Display an alert
            echo '<DIV CLASS="alert alert-danger">You have not entered the appropriate details.<br/>
            Please go back and try again.</DIV> ';

            exit;
        } else {

                unset($_GET['id']);
                unset($_GET['action']);
                $newid = $objMapper->create($_POST);

                echo '<DIV CLASS="alert alert-success">New '.$tableName.' '.$newid.' has been created!<BR></DIV>';
        }

    }
}else{
    //Create a default table
    $objMapper = new VehicleMapper();
    if (empty($_POST) || isset($_POST['searchTerm']))  {
      if(isset($_POST['searchTerm'])){ //If there is a set search term, it means we will not be deleting
        unset($_GET['id']);
        unset($_GET['action']);
      }
    } else {
        //Verify the post data
        if (!isset($_POST['makeModel'])
            || !isset($_POST['color'])
            || !isset($_POST['typeId'])
            || !isset($_POST['ownerId']))  {

            //Display an alert

            echo '<DIV CLASS="alert alert-danger">You have not entered the appropriate details.<br/>
            Please go back and try again.</DIV> ';

            exit;
        } else {

                unset($_GET['id']);
                unset($_GET['action']);
                $newid = $objMapper->create($_POST);

                echo '<DIV CLASS="alert alert-success">New '.$tableName.' '.$newid.' has been created!<BR></DIV>';
        }

    }
}
//Check GET data to see if we should delete a an object
if (isset($_GET['action']) && $_GET['action'] === "delete" && isset($_GET['id']))   {
    //Delete the object
    $results = $objMapper->delete($_GET['id']);
    echo '<DIV CLASS="alert alert-success">'.$tableName.' '.$results.' has been deleted.</DIV>';
}

//Display table chooser
$page->tableChooser();

//Display an add form based on the table.
//Display the data based on the table or display filtered data if there is a set search

if($tableName === "Transportation Type"){
  $page->addTransTypeForm();

  if(isset($_POST['searchTerm']) && empty($_POST['searchTerm'])) {
    echo '<DIV CLASS="alert alert-danger">Please enter a valid search term.<br/><br/>
    </DIV> ';
    returnForm();
  }elseif(isset($_POST['searchTerm'])){
      $page->displayTransTypeData($objMapper->searchDisplay($_POST['searchTerm']));
  }else{
    $page->displayTransTypeData($objMapper->listAll());
  }
}elseif($tableName === "Owner"){
  $page->addOwnerForm();
  if(isset($_POST['searchTerm']) && empty($_POST['searchTerm'])) {
    echo '<DIV CLASS="alert alert-danger">Please enter a valid search term.<br/><br/>
    </DIV> ';
    returnForm();
  }elseif(isset($_POST['searchTerm'])){
      $page->displayOwnerData($objMapper->searchDisplay($_POST['searchTerm']));
  }else{
    $page->displayOwnerData($objMapper->listAll());
  }
}else{
  $page->addVehicleForm();
  if(isset($_POST['searchTerm']) && empty($_POST['searchTerm'])) {
    echo '<DIV CLASS="alert alert-danger">Please enter a valid search term.<br/><br/>
    </DIV> ';
    returnForm();
  }elseif(isset($_POST['searchTerm'])){
      $page->displayVehicleData($objMapper->searchDisplay($_POST['searchTerm']));
  }else{
    $page->displayVehicleData($objMapper->listAll());
  }
}




//Footer
$page->footer();


?>
