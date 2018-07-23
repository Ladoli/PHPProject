<?php


class object1Mapper    {

    private $lastInsertId = null;
    private $attributes = null;
    public $tableName = "";

    function __construct($table){
        $this->tableName = $table;
        //We will use this to construct our queries. Particularly the "FROM" part of queries
    }

    function create($postdata)  {
        //Using passed data, add object to the database. We assume ID is automatically generated.
        //Return the ID of the created entry
    }

    function read($id) {
        //Get the data of Object with passed ID. Return object Object1 constructed with the data
    }

    function update($objectToUpdate)   {
        //Update the data of Object with passed ID
    }

    function delete($id)   {
        //Delete the data of the object with the passed ID
    }

    function listAll() {
        //Return an array of the objects of the certain class
    }
    
}

?>