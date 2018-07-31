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
          </HEAD>
        <body style="background-color: black;">
        <div id="particles-js"></div>
        <script src="js/particles.js"></script>
        <link rel="stylesheet" type="text/css" href="css/php_final.css">
        <link rel="stylesheet" type="text/css" href="sass/final_style.css">
        <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script>
          particlesJS.load("particles-js", "assets/particles.json", function() {
          console.log("callback - particles.js config loaded");
          });
        </script>
      <?php }

    function footer() {?>
      <script>
      // WmGwHfgi8DtKcLUFjLnucKSnOYTzhDstd8XQiwYV is my Nasa Developer Key
      // This technology calls on the apod API to display information about a Nasa Image of the day
      // This information is then used to display the image as a footer.
      //The image would change daily.
      fetch('https://api.nasa.gov/planetary/apod?api_key=WmGwHfgi8DtKcLUFjLnucKSnOYTzhDstd8XQiwYV',{
          method: 'GET',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
          }}).then(function(response) {
        return response.json();
      }).then(function(res){
        let imgFooter = document.getElementById("footerImage");
        imgFooter.src = res.url;
        imgFooter.alt = res.explaination;

        let imgText = document.getElementById("footerText");
        imgText.innerHTML = res.title;

      });
      </script>
      <div id=footerText></div>
      <img id="footerImage">
    </BODY>
    </HTML>
    <?php }

    function tableChooser() {
        //Provide users ability to choose which table to access, probably using GET variables
        ?>
        <div id="tablePicker">
        <A CLASS="tableLinks" HREF="?tables=Owner">Owner</A>
        <A CLASS="tableLinks" HREF="?tables=Transportation Type">Transportation Type</A>
        <A CLASS="tableLinks" HREF="?tables=Vehicle">Vehicle</A>
        </div>

    <?php }

    function addOwnerForm(){
       ?>
       <FORM class="addForm" METHOD="POST" ACTION="">

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
       <FORM class="addForm" METHOD="POST" ACTION="">

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

       <FORM class="addForm" METHOD="POST" ACTION="">

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
          $odd = true;
        foreach($owners as $owner)    {
            if($odd){
              echo '<TR class="rowColor1">';
              $odd = false;
            }else{
              echo '<TR class="rowColor2">';
              $odd = true;
            }
            echo '<TD>'.$owner->OwnerID.'</TD>
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
        <h1>Stats for Gender</h1>
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
            $odd = true;
            foreach($vehicles as $vehicle)    {
              if($odd){
                echo '<TR class="rowColor1">';
                $odd = false;
              }else{
                echo '<TR class="rowColor2">';
                $odd = true;
              }
              echo '<TD>'.$vehicle->VehicleID.'</TD>
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

            <h1>Stats for Color</h1>
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
                $odd = true;
                foreach($type as $col)    {
                  if($odd){
                    echo '<TR class="rowColor1">';
                    $odd = false;
                  }else{
                    echo '<TR class="rowColor2">';
                    $odd = true;
                  }
                    echo '
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
                <h1>Stats for Fuel Type</h1>
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
}
?>
