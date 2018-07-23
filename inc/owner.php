<?php

class Owner {

    //Attributes
    public $id = 0;
    public $name = "";
    public $city = "";
    public $gender = "";
    public $occupation = "";
    public $familySize = "";

    //Default constructor method
    function __construct($newName, $newCity, $newGender, $newOccupation, $newFamilySize)   {
        $this->name = $newName;
        $this->city = $newCity;
        $this->gender = $newGender;
        $this->occupation = $newOccupation;
        $this->familySize = $newFamilySize;
    }
}

?>
