<?php
class TransportationType {

    //Attributes
    public $id = 0;
    public $typeId = "";
    public $name = "";
    public $description = "";
    public $wheels = "";
    public $fuelType = "";

    //Default constructor method
    function __construct($newTypeId, $newName, $newDescription, $newWheels, $newFuelType)   {
        $this->typeId = $newTypeId;
        $this->name = $newName;
        $this->description = $newDescription;
        $this->wheels = $newWheels;
        $this->fuelType = $newFuelType;
    }
}
?>