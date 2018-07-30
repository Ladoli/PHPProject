<?php

class Page {

    private $title = "Emelie";

    function header() { ?>
        <!DOCTYPE HTML>
          <HTML LANG="en">
          <HEAD>
              <TITLE>
              <?php echo $this->title; ?>
              </TITLE>
              <link href="style.css" rel="stylesheet">
          </HEAD>
        <body style="background-color: black;" id="particles-js">
        <script src="js/particles.js"></script>

        <script>
          particlesJS.load("particles-js", "assets/particles.json", function() {
          console.log("callback - particles.js config loaded");
          });
        </script>
      <?php }

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

    function returnForm(){
        echo '<a href="finalproject.php">Click here to go back</a>';
    }

    function addOwnerForm(){
       ?>
       <FORM METHOD="POST" ACTION="">

        <LABEL FOR="name">Name</LABEL>
        <INPUT TYPE="text" NAME="name" ID="name" ARIA-DESCTIBEDBY="nameHelp" PLACEHOLDER="Full Name">
        <small id="nameHelp">Customer first and last name.</small>

        <LABEL FOR="city">City</LABEL>
            <INPUT TYPE="text" NAME="city" ID="city">

            <LABEL FOR="gender">Gender</LABEL>
            <SELECT NAME="gender" ID="gender">
                <OPTION VALUE="Female" SELECTED>Female</OPTION>
                <OPTION VALUE="Male">Male</OPTION>
                <OPTION VALUE="Other">Other</OPTION>
            </SELECT>

        <LABEL FOR="familySize">Family Size</LABEL>
            <INPUT TYPE="text" NAME="familySize" ID="familySize" ARIA-DESCTIBEDBY="sizeHelp">
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

        <LABEL FOR="ownerId">OwnerID</LABEL>
        <INPUT TYPE="text" NAME="ownerId" ID="ownerId">

        <LABEL FOR="typeId">TypeID</LABEL>
        <INPUT TYPE="text" NAME="typeId" ID="typeId">

        <INPUT TYPE="SUBMIT" VALUE="Add Vehicle">

    </FORM>
    <?php }

    function addTransTypeForm(){ ?>

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

        <INPUT TYPE="hidden" NAME="ownerId" VALUE="<?php echo $ownerData->OwnerID; ?>">

            <LABEL FOR="name">Name</LABEL>
            <INPUT TYPE="text" NAME="name" ID="name" ARIA-DESCTIBEDBY="nameHelp" VALUE="<?php echo $ownerData->Name; ?> ">
            <small id="nameHelp" >Customer first and last name.</small>

            <LABEL FOR="city">City</LABEL>
            <INPUT TYPE="text" NAME="city" ID="city" VALUE="<?php echo $ownerData->City; ?>">

            <LABEL FOR="gender">Gender</LABEL>
            <SELECT NAME="gender" ID="gender">

            <?php
            if(strcmp($ownerData->Gender,"female")) {
                echo '<OPTION ID="gender" VALUE="Female" SELECTED>Female</OPTION>
                <OPTION ID="gender" VALUE="Male">Male</OPTION>
                <OPTION ID="gender" VALUE="Other">Other</OPTION>';
            } elseif(strcmp($ownerData->Gender,"male")) {
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

            <LABEL FOR="familySize">Family Size</LABEL>
            <INPUT TYPE="text" NAME="familySize" ID="familySize" VALUE="<?php echo $ownerData->FamilySize; ?>">

            <INPUT TYPE="SUBMIT" VALUE="Edit Owner">
        </FORM>
        <?php }

    function editVehicleForm($vehicleData){ ?>

    <FORM METHOD="POST" ACTION="">

    <INPUT TYPE="hidden" NAME="id" VALUE="<?php echo $vehicleData->VehicleID; ?>">

        <LABEL FOR="makeModel">Make & Model</LABEL>
        <INPUT TYPE="text" NAME="makeModel" ID="makeModel" VALUE="<?php echo $vehicleData->MakeModel; ?> ">

        <LABEL FOR="color">Color</LABEL>
        <INPUT TYPE="text" NAME="color" ID="color" VALUE="<?php echo $vehicleData->Color; ?>">

        <LABEL FOR="ownerId">OwnerID</LABEL>
        <INPUT TYPE="text" NAME="ownerId" ID="ownerId" VALUE="<?php echo $vehicleData->OwnerID ?>">

        <LABEL FOR="typeId">TypeID</LABEL>
        <INPUT TYPE="text" NAME="typeId" ID="typeId" VALUE="<?php echo $vehicleData->TypeID ; ?>">

        <INPUT TYPE="SUBMIT" VALUE="Edit Vehicle">
    </FORM>
    <?php }

    function editTransTypeForm($transData){ ?>

        <FORM METHOD="POST" ACTION="">

        <INPUT TYPE="hidden" NAME="id" VALUE="<?php echo $transData->TransID; ?>">

            <LABEL FOR="name">Name</LABEL>
            <INPUT TYPE="text" NAME="name" ID="name" ARIA-DESCTIBEDBY="nameHelp" VALUE="<?php echo $transData->Name; ?> ">
            <small id="nameHelp">Bus, Plane, etc.</small>

            <LABEL FOR="description">Description</LABEL>
            <INPUT TYPE="text" NAME="description" ID="description" VALUE="<?php echo $transData->Description; ?>">

            <LABEL FOR="wheels">Wheels</LABEL>
            <INPUT TYPE="text" NAME="wheels" ID="wheels" VALUE="<?php echo $transData->Wheels; ?>">

            <LABEL FOR="fuel">Fuel Type</LABEL>
            <INPUT TYPE="text" NAME="fuel" ID="fuel" VALUE="<?php echo $transData->FuelType; ?>">

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
            <TD>'.$owner->OwnerID.'</TD>
            <TD>'.$owner->Name.'</TD>
            <TD>'.$owner->City.'</TD>
            <TD>'.$owner->Gender.'</TD>
            <TD>'.$owner->FamilySize.'</TD>
            <TD><A HREF="finalproject-edit.php?tables=Owner&id='.$owner->OwnerID.'">Update</A></TD>
            <TD><A HREF="?tables=Owner&action=delete&id='.$owner->OwnerID.'">Delete</A></TD>
            </TR>';
         }
       }?>

        </tbody>
        </table>
        <div>
        <h1>Stats for</h1>
    <?php
        $genderArray = [];
        foreach($owners as $owner) {
            if(key_exists($owner->Gender,$genderArray)){
                $genderArray[$owner->Gender] += 1;
            } else {
                $genderArray[$owner->Gender] = 1;
            }
        }

        foreach($genderArray as $item=>$count) {
            echo $item.': '.$count.'<BR>';
        }
        echo '<div>';
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
            if(!empty($vehicles)){
            foreach($vehicles as $vehicle)    {
                echo '<TR>
                <TD>'.$vehicle->VehicleID.'</TD>
                <TD>'.$vehicle->MakeModel.'</TD>
                <TD>'.$vehicle->Color.'</TD>
                <TD>'.$vehicle->OwnerID.'</TD>
                <TD>'.$vehicle->TypeID.'</TD>
                <TD><A HREF="finalproject-edit.php?tables=Vehicle&id='.$vehicle->VehicleID.'">Update</A></TD>
                <TD><A HREF="?tables=Vehicle&action=delete&id='.$vehicle->VehicleID.'">Delete</A></TD>
                </TR>';
             }
           }?>

            </tbody>
            </table>
            <div>

            <h1>Stats for</h1>
        <?php
            $colorArray = [];
            foreach($vehicles as $vehicle){
                if(key_exists($vehicle->Color,$colorArray)){
                    $colorArray[$vehicle->Color] += 1;
                } else {
                    $colorArray[$vehicle->Color] = 1;
                }
            }

            foreach($colorArray as $item=>$count) {
                echo $item.': '.$count.'<BR>'; 
            }
            echo '</div>';
        }

        function displayTransTypeData($type) { ?>
            <table>
                <thead>
                    <tr>
                    <th>Owner ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Wheels</th>
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
                    <TD><A HREF="finalproject-edit.php?tables=Transportation Type&id='.$col->TransID.'">Update</A></TD>
                    <TD><A HREF="?tables=Transportation Type&action=delete&id='.$col->TransID.'">Delete</A></TD>
                    </TR>';
                 }
               } ?>
                </tbody>
                </table>
                <div>
                <h1>Stats for</h1>
                <?php
                $fuelArray = [];
                foreach($type as $col){
                    if(key_exists($col->FuelType, $fuelArray)) {
                        $fuelArray[$col->FuelType] += 1;
                    } else {
                        $fuelArray[$col->FuelType] = 1;
                    }
                }
                foreach($fuelArray as $item=>$count) {
                    echo $item.': '.$count.'<BR>';
                }
                echo '</div>';
                
            }

        function searchForm() { ?>
            <FORM METHOD="POST" ACTION="">
            <INPUT TYPE = "TEXT" NAME="searchTerm"> 
            <INPUT TYPE = "SUBMIT" VALUE="Search"> 
            </FORM>
        <?php }

        function searchOwner($term, $owners) { 
            $term = strtolower($term);
            $searchList = [];

            foreach ($owners as $owner) {
                if(strpos(strtolower($owner->Name), $term) !== false){
                    $searchList[] = $owner;
                }elseif(strpos(strtolower($owner->City), $term) !== false){
                    $searchList[] = $owner;
                }elseif(strpos(strtolower($owner->Gender), $term) !== false){
                    $searchList[] = $owner;
                }elseif(strpos(strtolower($owner->FamilySize), $term) !== false){
                    $searchList[] = $owner;
                }   
            }
            return $searchList;
        }

        function searchVehicle($term, $vehicles) {
            $term = strtolower($term);
            $searchList = [];

            foreach($vehicles as $vehicle) {
                if(strpos(strtolower($vehicle->MakeModel), $term) !== false){
                    $filteredSearchList[] = $trans;
                }elseif(strpos(strtolower($trans->Color), $term) !== false){
                    $filteredSearchList[] = $trans;
                }
            }
            return $searchList;
        }

        function searchTransType($term, $transData){
            $term = strtolower($term);
            $searchList = [];

            foreach($transData as $trans) {
                if(strpos(strtolower($trans->Name), $term) !== false){
                    $filteredSearchList[] = $trans;
                }   elseif(strpos(strtolower($trans->Description), $term) !== false){
                    $filteredSearchList[] = $trans;
                }   elseif(strpos(strtolower($trans->Wheels),     $term) !== false){
                    $filteredSearchList[] = $trans;
                }   elseif(strpos(strtolower($trans->FuelType), $term) !== false){
                    $filteredSearchList[] = $trans;
                }
            }
            return $searchList;
        }
}
?>
