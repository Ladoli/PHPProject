<?php
class vehicle {

    //Attributes
    public $id = 0;
    public $make = "";
    public $model = "";
    public $color = "";
    public $ownerId = "";
    public $typeId = "";

    //Default constructor method
    function __construct($newMake, $newModel, $newColor, $newOwnerId, $newTypeId)   {
        $this->make = $newMake;
        $this->model = $newModel;
        $this->color = $newColor;
        $this->ownerId = $newOwnerId;
        $this->typeId = $newTypeId;
    }
}

?>