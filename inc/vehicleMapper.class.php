<?php


class VehicleMapper    {

    private $lastInsertId = null;
    private $attributes = null;


    //We will use this to construct our queries. Particularly the "FROM" part of queries


    function create($postdata)  {

        validateNumber($postdata['ownerId'],1,"Owner ID is invalid or is below 1.");
        validateNumber($postdata['typeId'],1,"Trans ID is invalid or is below 1.");
        //Using passed data, add object to the database. We assume ID is automatically generated.
        //Insert a new customer based on the post data that was inserted
        $vehicle = new Vehicle(cleanString($postdata['makeModel'],40), cleanString($postdata['color'],25), $postdata['ownerId'], $postdata['typeId']);

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

        if ($p->rowcount < 1)  {
          echo '<DIV CLASS="alert alert-danger">Something went horribly wrong!</DIV>';
            returnForm();
            die();
        }

        //Return the ID of the created entry
        return $this->lastInsertId;

    }

    function read($id) {
        //Get the data of Object with passed ID. Return object Object1 constructed with the data
        validateNumber($id,1,"Tried to read data of invalid entry");
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost", DBNAME);
        $p->connect();
        $bindParams = ['id'=>$id];
        $results = $p->query("SELECT * FROM Vehicles WHERE VehicleID = :id",$bindParams);

        $p->disconnect();
        return $results[0];

    }

    function update($vehicle)   {
        //Update the data of Object with passed ID
        validateNumber($vehicle['id'],1,"Vehicle ID is invalid or is below 1.");
        validateNumber($vehicle['ownerId'],1,"Owner ID is invalid or is below 1.");
        validateNumber($vehicle['typeId'],1,"Trans ID is invalid or is below 1.");

        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost",DBNAME);
        $p->connect();

        $bindParams = ['VehicleID' =>$vehicle['id'],
            'MakeModel' =>cleanString($vehicle['makeModel'],40),
            'Color' =>cleanString($vehicle['color'],25),
            'OwnerID' =>$vehicle['ownerId'],
            'TypeID' =>$vehicle['typeId']
        ];

        $p->query("UPDATE Vehicles SET MakeModel= :MakeModel, Color= :Color,
            OwnerID= :OwnerID, TypeID= :TypeID WHERE VehicleID = :VehicleID", $bindParams);
        echo $p->rowcount." Rows Affected<BR>";
        if($p->rowcount === 0){
          echo '<DIV CLASS="alert alert-success">Vehicle '.$vehicle['id'].' was not updated.<br>';
        }else{
          echo '<DIV CLASS="alert alert-success">Vechile '.$vehicle['id'].' has been updated.<br>';
        }

        $p->disconnect();

        return $vehicle['id'];
    }

    function delete($id)   {
        //Delete the data of the object with the passed ID
        validateNumber($id,1,"Vehicle ID is invalid or is below 1.");

        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost",DBNAME);
        $p->connect();
        $bindParams = ['vehicleId'=>$id];
        $results = $p->query("DELETE FROM Vehicles WHERE VehicleID = :vehicleId", $bindParams);
        echo $p->rowcount." Rows Affected<BR>";

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

    function searchDisplay($term) {
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost",DBNAME);
        $p->connect();
        $bindParams = [];
        $results = $p->query("SELECT *  FROM Vehicles;",$bindParams);

        $p->disconnect();

        $term = strtolower($term);
        $searchList = [];

        foreach($results as $result) {
            if(strpos(strtolower($result->MakeModel), $term) !== false){
                $searchList[] = $result;
            }elseif(strpos(strtolower($result->Color), $term) !== false){
                $searchList[] = $result;
            }elseif(strpos(strtolower($result->OwnerID), $term) !== false){
                $searchList[] = $result;
            }elseif(strpos(strtolower($result->TypeID), $term) !== false){
                $searchList[] = $result;
            }elseif(strpos(strtolower($result->VehicleID), $term) !== false){
                $searchList[] = $result;
            }
        }
        return $searchList;
    }
}

?>
