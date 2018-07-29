<?php


class Page {

    private $title = "";

    function header() {
      echo
        '<!DOCTYPE HTML>
          <HTML LANG="en">
          <HEAD>
              <TITLE>
              <?php echo $this->title; ?>
              </TITLE>
          </HEAD>
        <body style="background-color: black;" id="particles-js">
        <script src="js/particles.js"></script>

        <script>
          particlesJS.load("particles-js", "assets/particles.json", function() {
          console.log("callback - particles.js config loaded");
          });
        </script>';
      }

    function footer() {?>
    </BODY>
    </HTML>
    <?php }

    function tableChooser() {
        //Provide users ability to choose which table to access, probably using GET variables
        ?>
        <A HREF="?tables=Owner">Owner</A>
        <A HREF="?tables=Transportation Type">Transportation Type</A>
        <A HREF="?tables=Vehicle">Vehicle</A>

    <?php }

    function addOwnerForm(){
       ?>
       <FORM METHOD="POST" ACTION="">

        <LABEL FOR="name">Name</LABEL>
        <INPUT TYPE="text" NAME="name" ID="name" ARIA-DESCTIBEDBY="nameHelp" PLACEHOLDER="Full Name">
        <small id="nameHelp">Customer first and last name.</small>

        <LABEL FOR="city">City</LABEL>
            <INPUT TYPE="text" NAME="city" ID="city">

            <LABEL FOR="gender">Gender</LABEL>
            <SELECT ID="gender">
                <OPTION VALUE="Female" SELECTED>Female</OPTION>
                <OPTION VALUE="Male">Male</OPTION>
                <OPTION VALUE="Other">Other</OPTION>
            </SELECT>

        <LABEL FOR="famSize">Family Size</LABEL>
            <INPUT TYPE="text" NAME="famSize" ID="famSize" ARIA-DESCTIBEDBY="sizeHelp">
            <small id="sizeHelp">The number of people in your immediate family.</small>

        <INPUT TYPE="SUBMIT" VALUE="Add Owner">

    </FORM>
    <?php }

    function addVehicleForm(){
       ?>
       <FORM METHOD="POST" ACTION="">

        <LABEL FOR="makeModel">Make & Model</LABEL>
        <INPUT TYPE="text" NAME="makeModel" ID="makeModel">

        <LABEL FOR="color">Color</LABEL>
        <INPUT TYPE="text" NAME="color" ID="color">

        <INPUT TYPE="SUBMIT" VALUE="Add Vehicle">

    </FORM>
    <?php }

    function addTransportationTypeForm(){ ?>

       <FORM METHOD="POST" ACTION="">

        <LABEL FOR="name">Name</LABEL>
        <INPUT TYPE="text" NAME="name" ID="name" ARIA-DESCTIBEDBY="nameHelp">
        <small id="nameHelp">Bus, Plane, etc.</small>

        <LABEL FOR="description">Description</LABEL>
        <INPUT TYPE="text" NAME="description" ID="description">

        <LABEL FOR="wheels">Wheels</LABEL>
        <INPUT TYPE="text" NAME="wheels" ID="wheels">

        <LABEL FOR="fuel">Fuel</LABEL>
        <INPUT TYPE="text" NAME="fuel" ID="fuel" ARIA-DESCTIBEDBY="fuelHelp">
        <small id="fuelHelp">Gas, Diesel, etc.</small>

        <INPUT TYPE="SUBMIT" VALUE="Add Transportation Type">

    </FORM>
    <?php }

    function editOwnerForm($ownerData){ ?>

        <FORM METHOD="POST" ACTION="">

        <INPUT TYPE="hidden" NAME="id" VALUE="<?php echo $ownerData->id; ?>">

            <LABEL FOR="name">Name</LABEL>
            <INPUT TYPE="text" NAME="name" ID="name" ARIA-DESCTIBEDBY="nameHelp" VALUE="<?php echo $ownerData->name; ?> ">
            <small id="nameHelp" >Customer first and last name.</small>

            <LABEL FOR="city">City</LABEL>
            <INPUT TYPE="text" NAME="city" ID="city" VALUE="<?php echo $ownerData->city; ?>">

            <LABEL FOR="gender">Gender</LABEL>
            <SELECT>

            <?php
            if($ownerData->gender == "female") {
                echo '<OPTION ID="gender" VALUE="Female" SELECTED>Female</OPTION>
                <OPTION ID="gender" VALUE="Male">Male</OPTION>
                <OPTION ID="gender" VALUE="Other">Other</OPTION>';
            } elseif($ownerData->gender == "male") {
                echo '<OPTION ID="gender" VALUE="Female">Female</OPTION>
                <OPTION ID="gender" VALUE="Male" SELECTED>Male</OPTION>
                <OPTION ID="gender" VALUE="Other">Other</OPTION>';
            } else {
                echo '<OPTION ID="gender" VALUE="Female">Female</OPTION>
                <OPTION ID="gender" VALUE="Male">Male</OPTION>
                <OPTION ID="gender" VALUE="Other" SELECTED>Other</OPTION>';
            }
            ?>
            </SELECT>

            <LABEL FOR="famSize">Family Size</LABEL>
            <INPUT TYPE="text" NAME="famSize" ID="famSize" VALUE="<?php echo $ownerData->famSize; ?>">

            <INPUT TYPE="SUBMIT" VALUE="Edit Customer">
        </FORM>
        <?php }

    function editVehicleForm($vehicleData){ ?>

    <FORM METHOD="POST" ACTION="">

    <INPUT TYPE="hidden" NAME="id" VALUE="<?php echo $vehicleData->id; ?>">

        <LABEL FOR="makeModel">Make & Model</LABEL>
        <INPUT TYPE="text" NAME="makeModel" ID="makeModel" VALUE="<?php echo $vehicleData->makeModel; ?> ">

        <LABEL FOR="color">Color</LABEL>
        <INPUT TYPE="text" NAME="color" ID="color" VALUE="<?php echo $vehicleData->color; ?>">

        <INPUT TYPE="SUBMIT" VALUE="Edit Vehicle">
    </FORM>
    <?php }

    function editTransportationTypeForm($transData){ ?>

        <FORM METHOD="POST" ACTION="">

        <INPUT TYPE="hidden" NAME="id" VALUE="<?php echo $transData->id; ?>">

            <LABEL FOR="name">Name</LABEL>
            <INPUT TYPE="text" NAME="name" ID="name" ARIA-DESCTIBEDBY="nameHelp" VALUE="<?php echo $transData->name; ?> ">
            <small id="nameHelp">Bus, Plane, etc.</small>

            <LABEL FOR="description">Description</LABEL>
            <INPUT TYPE="text" NAME="description" ID="description" VALUE="<?php echo $transData->description; ?>">

            <LABEL FOR="wheels">Wheels</LABEL>
            <INPUT TYPE="text" NAME="wheels" ID="wheels" VALUE="<?php echo $transData->wheels; ?>">

            <LABEL FOR="fuel">Fuel Type</LABEL>
            <INPUT TYPE="text" NAME="fuel" ID="fuel" VALUE="<?php echo $transData->fuel; ?>">

            <INPUT TYPE="SUBMIT" VALUE="Edit Transportation Type">
        </FORM>
        <?php }

    function displayOwnerData($owners) { ?>
    <table>
        <thead>
            <tr>
            <th>Owner ID</th>
            <th>Name</th>
            <th>City</th>
            <th>Gender</th>
            <th>Family Size</th>
            <th>Update</th>
            <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($owners)){
        foreach($owners as $owner)    {
            echo '<TR>
            <TD>'.$owner->id.'</TD>
            <TD>'.$owner->name.'</TD>
            <TD>'.$owner->city.'</TD>
            <TD>'.$owner->gender.'</TD>
            <TD>'.$owner->famSize.'</TD>
            <TD>Update</TD>
            <TD><A HREF="?action=delete&id='.$owner->id.'">Delete</A></TD>
            </TR>';
         }
       }?>

        </tbody>
        </table>
    <?php

    }
    function displayVehicleData($vehicles) { ?>
        <table>
            <thead>
                <tr>
                <th>Vehicle ID</th>
                <th>Make & Model</th>
                <th>Color</th>
                <th>Owner ID</th>
                <th>Type ID</th>
                <th>Update</th>
                <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if(!empty($owners)){
            foreach($vehicles as $vehicle)    {
                echo '<TR>
                <TD>'.$vehicle->id.'</TD>
                <TD>'.$vehicle->makeModel.'</TD>
                <TD>'.$vehicle->color.'</TD>
                <TD>'.$vehicle->ownerId.'</TD>
                <TD>'.$vehicle->typeId.'</TD>
                <TD>Update</TD>
                <TD><A HREF="?action=delete&id='.$vehicle->id.'">Delete</A></TD>
                </TR>';
             }
           }?>

            </tbody>
            </table>
        <?php

        }

        function displaytransTypeData($type) { ?>
            <table>
                <thead>
                    <tr>
                    <th>Owner ID</th>
                    <th>Type ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Fuel</th>
                    <th>Update</th>
                    <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($type)){
                foreach($type as $col)    {
                    echo '<TR>
                    <TD>'.$col->TransID.'</TD>
                    <TD>'.$col->Name.'</TD>
                    <TD>'.$col->Description.'</TD>
                    <TD>'.$col->Wheels.'</TD>
                    <TD>'.$col->FuelType.'</TD>
                    <TD>Update</TD>
                    <TD><A HREF="?action=delete&id='.$col->TransID.'">Delete</A></TD>
                    </TR>';
                 }
               }?>
                </tbody>
                </table>
            <?php

            }
}
?>
