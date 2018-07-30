<?php


class VehicleMapper    {

    private $lastInsertId = null;
    private $attributes = null;


    //We will use this to construct our queries. Particularly the "FROM" part of queries


    function create($postdata)  {
        //Using passed data, add object to the database. We assume ID is automatically generated.
        //Insert a new customer based on the post data that was inserted
        $vehicle = new Vehicle($postdata['makeModel'], $postdata['color'], $postdata['ownerId'], $postdata['typeId']);

        //new PDOAgent
        $p =new PDOAgent("mysql", DBUSER,DBPASSWD,"localhost", DBNAME);

        //Connect to the Database
        $p->connect();

        //Setup the Bind Parameters
        $bindParams = [
        'makeModel' => $vehicle->makeModel,
        'color' => $vehicle->color,
        'ownerId' => $vehicle->ownerId,
        'typeId' => $vehicle->typeId];

        //Get the results of the insert query (rows inserted)
        $results = $p->query("INSERT INTO Vehicles (MakeModel, Color, OwnerID, TypeID)
            VALUES ( :makeModel, :color, :ownerId, :typeId);", $bindParams);
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
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost", DBNAME);
        $p->connect();
        $bindParams = ['id'=>$id];
        $results = $p->query("SELECT * FROM Vehicles WHERE VehicleID = :id",$bindParams);

        $p->disconnect();
        return $results[0];

    }

    function update($vehicle)   {
        //Update the data of Object with passed ID
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost",DBNAME);
        $p->connect();

        $bindParams = ['VehicleID' =>$vehicle['id'],
            'MakeModel' =>$vehicle['makeModel'],
            'Color' =>$vehicle['color'],
            'OwnerID' =>$vehicle['ownerId'],
            'TypeID' =>$vehicle['typeId']
        ];

        $p->query("UPDATE Vehicles SET MakeModel= :MakeModel, Color= :Color,
            OwnerID= :OwnerID, TypeID= :TypeID WHERE VehicleID = :VehicleID", $bindParams);
        echo $p->rowcount."Rows Affected<BR>";

        $p->disconnect();

        return $vehicle['id'];
    }

    function delete($id)   {
        //Delete the data of the object with the passed ID
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost",DBNAME);
        $p->connect();
        $bindParams = ['vehicleId'=>$id];
        $results = $p->query("DELETE FROM Vehicles WHERE VehicleID = :vehicleId", $bindParams);
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
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost",DBNAME);
        $p->connect();
        $bindParams = [];
        $results = $p->query("SELECT *  FROM Vehicles;",$bindParams);

        $p->disconnect();
        return $results;
    }

}

?>
