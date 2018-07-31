<?php
class Vehicle {

    //Attributes
    public $id = 0;
    public $makeModel = "";
    public $color = "";
    public $ownerId = "";
    public $typeId = "";

    //Default constructor method
    function __construct($newMakeModel, $newColor, $newOwnerId, $newTypeId)   {
        $this->makeModel = $newMakeModel;
        $this->color = $newColor;
        $this->ownerId = $newOwnerId;
        $this->typeId = $newTypeId;
    }
}

?>
