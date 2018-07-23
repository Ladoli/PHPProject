<?php

class ownerMapper    {

    private $lastInsertId = null;
    private $attributes = null;
    public $tableName = "TransportationType";
    public $dbName = "temporary";

    //We will use this to construct our queries. Particularly the "FROM" part of queries


    function create($postdata)  {
        //Using passed data, add object to the database. We assume ID is automatically generated.
        //Insert a new customer based on the post data that was inserted
        $transportationType = new TransportationType($postdata['transId'], $postdata['typeId'], 
            $postdata['name'], $postdata['description'], $postdata['wheels'], $postdata['fuelType']);

        //new PDOAgent
        $p =new PDOAgent("mysql", DBUSER,DBPASSWD,"localhost", "TransportationType");

        //Connect to the Database
        $p->connect();

        //Setup the Bind Parameters
        $bindParams = ['transId' => $transportationType->transId,
        'typeId' => $transportationType->typeId,
        'name' => $transportationType->name,
        'description' => $transportationType->description,
        'wheels' => $transportationType->wheels,
        'fuelType' => $transportationType->fuelType];

        //Get the results of the insert query (rows inserted)
        $results = $p->query("INSERT INTO TransportationType (TransID, TypeID, Name, Description, Wheels, Fuel Type)
            VALUES ( :transId, :typeId, :name, :Description, :wheels, :fuelType);", $bindParams);
        //copy the last inserted id
        $this->lastInsertId = $p->lastInsertId;

        //Disconnect from the database
        $p->disconnect();
        
        if ($p->rowcount != 1)  {
            trigger_error("Something went horribly wrong!");
            die();
        }
        
        //Return the ID of the created entry
        return $this->lastInsertId;

    }

    function read($id) {
        //Get the data of Object with passed ID. Return object Object1 constructed with the data
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost", "TransportationType");
        $p->connect();
        $bindParams = ['id'=>$id];
        $results = $p->query("SELECT * FROM TransportationType WHERE TransID = :transId",$bindParams);
        
        $p->disconnect();
        return $results[0];

    }

    function update($objectToUpdate)   {
        //Update the data of Object with passed ID
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost","TransportationType");
        $p->connect();
        
        $bindParams = ['TransID' =>$objectToUpdate['transId'],
            'TypeID' =>$objectToUpdate['typeId'],
            'Name' =>$objectToUpdate['name'],
            'Description' =>$objectToUpdate['description'],
            'Wheels' =>$objectToUpdate['wheels'],
            'FuelType' =>$objectToUpdate['fuelType']
        ];

        $p->query("UPDATE TransportationType SET TypeID= :TypeID, Name= :Name, Description= :Description, 
            Wheels= :Wheels, FuelType= :FuelType WHERE TransID = :transId", $bindParams);
        echo $p->rowcount."Rows Affected<BR>";

        $p->disconnect();
        return $transportationType['id'];
    }

    function delete($id)   {
        //Delete the data of the object with the passed ID
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost","TransportationType");
        $p->connect();
        $bindParams = ['transId'=>$id];
        $results = $p->query("DELETE FROM TransportationType WHERE id = :transId", $bindParams);
        echo $p->rowcount."Rows Affected<BR>";
        
        $p->disconnect();
        if ($p->rowcount != 1){
            trigger_error("Something went horribly wrong!");
            die();
        }

        return $id;
    }

    function listAll() {
        //Return an array of the objects of the certain class
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost","TransportationType");
        $p->connect();
        $bindParams = [];
        $results = $p->query("SELECT *  FROM TransportationType;",$bindParams);

        $p->disconnect();
        return $results;
    }
    
}

?>