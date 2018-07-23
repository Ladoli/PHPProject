<?php


class Page {

    private $title = "";

    function header() { ?>
        <!DOCTYPE HTML>
        <HTML LANG="en">
        <HEAD>
            <TITLE>
            <?php echo $this->title; ?>
            </TITLE>
        </HEAD>
        <BODY>
    <?php    
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

    function addForm($object){
        //Perhaps use http://php.net/manual/en/function.get-class.php to assess object name and use a switch statement based on that. Not needed if we make our objects have equal attributes
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

        <INPUT TYPE="SUBMIT" VALUE="Add Customer">
    
    </FORM>
    <?php }
    
    function editForm($ownerData){ ?>
    
        <FORM METHOD="POST" ACTION="">

        <INPUT TYPE="hidden" NAME="id" VALUE="<?php echo $ownerData->id; ?>">
    
            <LABEL FOR="name">Name</LABEL>
            <INPUT TYPE="text" NAME="name" ID="name" ARIA-DESCTIBEDBY="nameHelp" VALUE="<?php echo $customer->name; ?> ">
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

    function displayData($owners) { ?>
    <table>
        <thead>
            <tr>
            <th>OwnerID#</th>
            <th>Name</th>
            <th>City</th>
            <th>Gender</th>
            <th>Family Size</th>
            <th>Update</th>
            <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($owners as $owner)    {
            echo '<TR>
            <TD>'.$owner->id.'</TD>
            <TD>'.$owner->name.'</TD>
            <TD>'.$owner->city.'</TD>
            <TD>'.$owner->gender.'</TD>
            <TD>'.$owner->famSize.'</TD>
            <TD>Update</TD>
            <TD><A HREF="?action=delete&id='.$owner->id.'">Delete</A></TD>
            </TR>';
         } ?>

        </tbody>
        </table>
    <?php

    }

}
?>