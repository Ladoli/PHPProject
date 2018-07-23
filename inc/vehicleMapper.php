<?php


class vehicleMapper    {

    private $lastInsertId = null;
    private $attributes = null;
    public $tableName = "vehicle";
    public $dbName = "temporary";

    //We will use this to construct our queries. Particularly the "FROM" part of queries


    function create($postdata)  {
        //Using passed data, add object to the database. We assume ID is automatically generated.
        //Insert a new customer based on the post data that was inserted
        $vehicle = new vehicle($postdata['vehicleId'], $postdata['make'], $postdata['model'], $postdata['color'], $postdata['ownerID'], $postdata['typeId']);

        //new PDOAgent
        $p =new PDOAgent("mysql", DBUSER,DBPASSWD,"localhost", "vehicle");

        //Connect to the Database
        $p->connect();

        //Setup the Bind Parameters
        $bindParams = ['vehicleId' => $vehicle->vehicleId,
        'make' => $vehicle->make,
        'model' => $vehicle->model,
        'color' => $vehicle->color,
        'ownerId' => $vehicle->ownerId,
        'typeId' => $vehicle->typeId];

        //Get the results of the insert query (rows inserted)
        $results = $p->query("INSERT INTO vehicle (VehicleId, Make, Model, Color, OwnerID, TypeID)
            VALUES ( :vehicleId, :make, :model, :color, :ownerId, :typeId);", $bindParams);
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
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost", "vehicle");
        $p->connect();
        $bindParams = ['id'=>$id];
        $results = $p->query("SELECT * FROM vehicle WHERE VehicleID = :vehicleId",$bindParams);
        
        $p->disconnect();
        return $results[0];

    }

    function update($objectToUpdate)   {
        //Update the data of Object with passed ID
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost","vehicle");
        $p->connect();
        
        $bindParams = ['VehicleID' =>$objectToUpdate['vehicleId'],
            'Make' =>$objectToUpdate['make'],
            'Model' =>$objectToUpdate['model'],
            'Color' =>$objectToUpdate['color'],
            'OwnerID' =>$objectToUpdate['ownerId'],
            'TypeID' =>$objectToUpdate['typeId']
        ];

        $p->query("UPDATE vehicle SET Make= :Make, Model= :Model, Color= :Color, 
            OwnerID= :OwnerId, TypeID= :tTypeId WHERE VehicleID = :VehicleId", $bindParams);
        echo $p->rowcount."Rows Affected<BR>";

        $p->disconnect();
        return $vehicle['id'];
    }

    function delete($id)   {
        //Delete the data of the object with the passed ID
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost","vehicle");
        $p->connect();
        $bindParams = ['vehicleId'=>$id];
        $results = $p->query("DELETE FROM vehicle WHERE id = :vehicleId", $bindParams);
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
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost","vehicle");
        $p->connect();
        $bindParams = [];
        $results = $p->query("SELECT *  FROM vehicle;",$bindParams);

        $p->disconnect();
        return $results;
    }
    
}

?>