<?php


class OwnerMapper    {

    private $lastInsertId = null;
    private $attributes = null;

    //We will use this to cvar_dump($_POST['Search']);onstruct our queries. Particularly the "FROM" part of queries


    function create($postdata)  {
        //Using passed data, add object to the database. We assume ID is automatically generated.
        //Insert a new customer based on the post data that was inserted
        $owner = new Owner($postdata['name'], $postdata['city'], $postdata['gender'], $postdata['familySize']);

        //new PDOAgent
        $p =new PDOAgent("mysql", DBUSER,DBPASSWD,"localhost", DBNAME);

        //Connect to the Database
        $p->connect();

        //Setup the Bind Parameters
        $bindParams = [
          'name' => $owner->name,
          'city' => $owner->city,
          'gender' => $owner->gender,
          'familySize' => $owner->familySize
        ];

        //Get the results of the insert query (rows inserted)
        $results = $p->query("INSERT INTO Owners(Name, City, Gender, FamilySize)
            VALUES ( :name, :city, :gender, :familySize);", $bindParams);
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
        $results = $p->query("SELECT * FROM Owners WHERE OwnerID = :id",$bindParams);

        $p->disconnect();
        
        return $results[0];

    }

    function update($owner)   {
        //Update the data of Object with passed ID
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost", DBNAME);
        $p->connect();

        $bindParams = ['OwnerID' =>$owner['ownerId'],
            'Name' =>$owner['name'],
            'City' =>$owner['city'],
            'Gender' =>$owner['gender'],
            'FamilySize' =>$owner['familySize']
        ];

        $p->query("UPDATE Owners SET Name= :Name, City= :City, Gender= :Gender,
           FamilySize= :FamilySize WHERE OwnerID = :OwnerID", $bindParams);
        echo $p->rowcount." Rows Affected<BR>";

        $p->disconnect();
        return $owner['ownerId'];
    }

    function delete($id)   {
        //Delete the data of the object with the passed ID
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost", DBNAME);
        $p->connect();
        $bindParams = ['ownerId'=>$id];
        $results = $p->query("DELETE FROM Owners WHERE OwnerID = :ownerId", $bindParams);
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
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost", DBNAME);
        $p->connect();
        $bindParams = [];
        $results = $p->query("SELECT *  FROM Owners;",$bindParams);

        $p->disconnect();
        return $results;
    }

}

?>
