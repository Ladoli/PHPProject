<?php
class TransportationType {

    //Attributes
    public $id = 0;
    public $typeId = "";
    public $name = "";
    public $description = "";
    public $fuel = "";

    //Default constructor method
    function __construct($newName, $newDescription, $newWheels, $newFuelType)   {
        $this->name = $newName;
        $this->description = $newDescription;
        $this->wheels = $newWheels;
        $this->fuel = $newFuelType;

    }
}
?>
