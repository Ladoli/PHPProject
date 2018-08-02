<?php

class Page {

    private $title = "Team MACaroni";

    //Load relevant javascript files.
    //Load external files such as Google fonts
    //Load style sheets
    //Run particlesJS
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
        <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,700" rel="stylesheet">
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
      //This technolgoy uses promises
      //Then triggers a function that happens only when the previous first action receives a response
      //Catch triggers if there is an error, this can do checked by simply disconnecting internet
      fetch('https://api.nasa.gov/planetary/apod?api_key=WmGwHfgi8DtKcLUFjLnucKSnOYTzhDstd8XQiwYV',{
          method: 'GET',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
          }}).then(function(response) {
            if (!response.ok) {
              throw Error(response.statusText);
            }
        return response.json();
      }).then(function(res){
        let imgFooter = document.getElementById("footerImage");
        imgFooter.src = res.url;
        imgFooter.alt = res.explaination;

        let imgText = document.getElementById("footerText");
        imgText.innerHTML = res.title;
      }).catch(function(error) {
         console.log(error);
         let imgText = document.getElementById("footerText");
         imgText.innerHTML = "Could not display APOD image due to error: " + error;
         let imgFooter = document.getElementById("footerImage");
         imgFooter.style.visibility = "hidden";
      });
      </script>
      <div id=footerText></div>
      <img id="footerImage">
    </BODY>
    </HTML>
    <?php }

    //Provide users ability to choose which table to access, probably using variable tables
    function tableChooser() {
        ?>
        <div id="tablePicker">
          <table>
            <tr>
              <td>
                <A CLASS="tableLinks" HREF="?tables=Owner">Owner</A>
              </td>
              <td>
                <A CLASS="tableLinks" HREF="?tables=Transportation Type">Transportation Type</A>
              </td>
              <td>
                <A CLASS="tableLinks" HREF="?tables=Vehicle">Vehicle</A>
              </td>
            </tr>
          </table>
        </div>
    <?php }

    //The three next functions are for creating the forms for adding entries into the various tables
    function addOwnerForm(){
       ?>
       <FORM class="entryForm" METHOD="POST" ACTION="">
         <div>
          <LABEL FOR="name">Name</LABEL><BR>
          <INPUT TYPE="text" NAME="name" ID="name" PLACEHOLDER="Full Name">
         </div>

        <div>
          <LABEL FOR="city">City</LABEL><BR>
          <INPUT TYPE="text" NAME="city" ID="city">
        </div>

        <div>
          <LABEL FOR="gender">Gender</LABEL><BR>
          <SELECT NAME="gender" ID="gender">
              <OPTION VALUE="Female" SELECTED>Female</OPTION>
              <OPTION VALUE="Male">Male</OPTION>
              <OPTION VALUE="Other">Other</OPTION>
          </SELECT>
        </div>

        <div>
          <LABEL FOR="familySize">Family Size</LABEL><BR>
          <INPUT TYPE="text" NAME="familySize" ID="familySize" PLACEHOLDER="Immediate Family">
        </div>
        <BR>
        <BR>
        <INPUT TYPE="SUBMIT" VALUE="Add Owner">

    </FORM>
    <?php }

    function addVehicleForm(){
       ?>
       <FORM class="entryForm" METHOD="POST" ACTION="">
        <div>
          <LABEL FOR="makeModel">Make & Model</LABEL><BR>
          <INPUT TYPE="text" NAME="makeModel" ID="makeModel">
        </div>

        <div>
          <LABEL FOR="color">Color</LABEL><BR>
          <INPUT TYPE="text" NAME="color" ID="color">
        </div>

        <div>
          <LABEL FOR="ownerId">OwnerID</LABEL><BR>
          <INPUT TYPE="text" NAME="ownerId" ID="ownerId">
        </div>

        <div>
          <LABEL FOR="typeId">TypeID</LABEL><BR>
          <INPUT TYPE="text" NAME="typeId" ID="typeId">
        </div>
          <BR>
          <BR>
        <INPUT TYPE="SUBMIT" VALUE="Add Vehicle">

    </FORM>
    <?php }

    function addTransTypeForm(){ ?>

       <FORM class="entryForm" METHOD="POST" ACTION="">
         <div>
          <LABEL FOR="name">Name</LABEL><BR>
          <INPUT TYPE="text" NAME="name" ID="name" PLACEHOLDER="Bus, Plane, etc.">
        </div>
        <div>
          <LABEL FOR="description">Description</LABEL><BR>
          <INPUT TYPE="text" NAME="description" ID="description">
        </div>
        <div>
          <LABEL FOR="wheels">Wheels</LABEL><BR>
          <INPUT TYPE="text" NAME="wheels" ID="wheels">
        </div>
        <div>
          <LABEL FOR="fuel">Fuel</LABEL><BR>
          <INPUT TYPE="text" NAME="fuel" ID="fuel" PLACEHOLDER="Gas, Diesel, etc.">
        </div>
        <BR>
        <BR>
        <INPUT TYPE="SUBMIT" VALUE="Add Transportation Type">

    </FORM>
    <?php }

    //The three next functions are for the forms to edit entries into the various tables
    function editOwnerForm($ownerData){
      ?>

        <FORM class="entryForm" METHOD="POST" ACTION="">

        <INPUT TYPE="hidden" NAME="ownerId" VALUE="<?php echo $ownerData->OwnerID; ?>">

            <div>
              <LABEL FOR="name">Name</LABEL><br>
              <INPUT TYPE="text" NAME="name" ID="name" ARIA-DESCTIBEDBY="nameHelp" VALUE="<?php echo $ownerData->Name; ?> ">
            </div>
            <div>
              <LABEL FOR="city">City</LABEL><br>
              <INPUT TYPE="text" NAME="city" ID="city" VALUE="<?php echo $ownerData->City; ?>">
            </div>
            <div>
              <LABEL FOR="gender">Gender</LABEL><br>
              <SELECT NAME="gender" ID="gender">
              <?php
              if(strcmp($ownerData->Gender,"Female") === 0) {
                  echo '<OPTION ID="gender" VALUE="Female" SELECTED>Female</OPTION>
                  <OPTION ID="gender" VALUE="Male">Male</OPTION>
                  <OPTION ID="gender" VALUE="Other">Other</OPTION>';
              } elseif(strcmp($ownerData->Gender,"Male") === 0) {
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
            </div>
            <div>
            <LABEL FOR="familySize">Family Size</LABEL>
            <INPUT TYPE="text" NAME="familySize" ID="familySize" VALUE="<?php echo $ownerData->FamilySize; ?>">
            </div>
            <br>
            <br>
            <INPUT TYPE="SUBMIT" VALUE="Edit Owner">
        </FORM><br>
        <?php }

    function editVehicleForm($vehicleData){ ?>

    <FORM class="entryForm" METHOD="POST" ACTION="">

    <INPUT TYPE="hidden" NAME="id" VALUE="<?php echo $vehicleData->VehicleID; ?>">

        <div>
          <LABEL FOR="makeModel">Make & Model</LABEL><br>
          <INPUT TYPE="text" NAME="makeModel" ID="makeModel" VALUE="<?php echo $vehicleData->MakeModel; ?> ">
        </div>
        <div>
          <LABEL FOR="color">Color</LABEL><br>
          <INPUT TYPE="text" NAME="color" ID="color" VALUE="<?php echo $vehicleData->Color; ?>">
        </div>
        <div>
          <LABEL FOR="ownerId">OwnerID</LABEL><br>
          <INPUT TYPE="text" NAME="ownerId" ID="ownerId" VALUE="<?php echo $vehicleData->OwnerID ?>">
        </div>
        <div>
          <LABEL FOR="typeId">TypeID</LABEL>
          <INPUT TYPE="text" NAME="typeId" ID="typeId" VALUE="<?php echo $vehicleData->TypeID ; ?>">
        </div>
        <br>
        <br>
        <INPUT TYPE="SUBMIT" VALUE="Edit Vehicle">
    </FORM><br>
    <?php }

    function editTransTypeForm($transData){ ?>

        <FORM class="entryForm" METHOD="POST" ACTION="">

        <INPUT TYPE="hidden" NAME="id" VALUE="<?php echo $transData->TransID; ?>">
          <div>
            <LABEL FOR="name">Name</LABEL><br>
            <INPUT TYPE="text" NAME="name" ID="name" ARIA-DESCTIBEDBY="nameHelp" VALUE="<?php echo $transData->Name; ?> ">
          </div><br>
          <div style="width:100%; padding: 10px 0px;">
            <LABEL FOR="description">Description</LABEL><br>
            <INPUT TYPE="text" NAME="description" ID="description" VALUE="<?php echo $transData->Description; ?>">
          </div><br>
          <div>
            <LABEL FOR="wheels">Wheels</LABEL><br>
            <INPUT TYPE="text" NAME="wheels" ID="wheels" VALUE="<?php echo $transData->Wheels; ?>">
          </div>
          <div>
            <LABEL FOR="fuel">Fuel Type</LABEL><br>
            <INPUT TYPE="text" NAME="fuel" ID="fuel" VALUE="<?php echo $transData->FuelType; ?>">
          </div>
          <br>
          <br>
            <INPUT TYPE="SUBMIT" VALUE="Edit Transportation Type">
        </FORM><br>
        <?php }

    //The three next functions are for displaying the entries of various tables.
    //The logic is similiar for each.
    //If passed data is not empty, display the data
    //For each entry in owners, display it in a table row. The $odd is to use alternating classes which will be used later for UI purposes
    //Otherwise display a messages saying no results were found
    //Declare an empty array to hold our statistics data
    //If there are entries, loop through them and check if the corresponding data exists. If not, create it. Otherwise, increase its value.
    //Display each entry in our array, key and value.
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
            <TD class="actionLinks"><A HREF="MACaroni-edit.php?tables=Owner&id='.$owner->OwnerID.'">Update</A></TD>
            <TD class="actionLinks"><A HREF="?tables=Owner&action=delete&id='.$owner->OwnerID.'">Delete</A></TD>
            </TR>';
         }
         echo '</tbody>
         </table>
         <div>';
       }else{
         echo
           '</tbody>
           </table>
           <div><BR>No results found for search term <p style="color: red; display: inline-block;">'.$_POST['searchTerm'].'</p>';
       }
        $genderArray = [];
        if(count($owners) !== 0){
          echo '<h1>Stats for Gender</h1>';
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
                <TD class="actionLinks"><A HREF="MACaroni-edit.php?tables=Vehicle&id='.$vehicle->VehicleID.'">Update</A></TD>
                <TD class="actionLinks"><A HREF="?tables=Vehicle&action=delete&id='.$vehicle->VehicleID.'">Delete</A></TD>
                </TR>';
             }
             echo '</tbody>
             </table>
             <div>';
           }else{
             echo
               '</tbody>
               </table>
               <div><BR>No results found for search term <p style="color: red; display: inline-block;">'.$_POST['searchTerm'].'</p>';
           }
            $colorArray = [];
            if(count($vehicles) !== 0){
              echo '<h1>Stats for Color</h1>';
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
                    <TD class="actionLinks"><A HREF="MACaroni-edit.php?tables=Transportation Type&id='.$col->TransID.'">Update</A></TD>
                    <TD class="actionLinks"><A HREF="?tables=Transportation Type&action=delete&id='.$col->TransID.'">Delete</A></TD>
                    </TR>';
                 }
                 echo '</tbody>
                 </table>
                 <div>';
               }else{
                 echo
                   '</tbody>
                   </table>
                   <div><BR>No results found for search term <p style="color: red; display: inline-block;">'.$_POST['searchTerm'].'</p>';
               }
                $fuelArray = [];
                if(count($type) !== 0){
                  echo '<h1>Stats for Fuel Type</h1>';
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
                }
                echo '</div>';
            }

        //Display the search form
        function searchForm() { ?>
            <FORM METHOD="POST" ACTION="">
            <INPUT TYPE = "TEXT" NAME="searchTerm">
            <INPUT TYPE = "SUBMIT" VALUE="Search">
            </FORM>
        <?php }
}
?>
