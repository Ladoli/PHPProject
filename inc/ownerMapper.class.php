<?php

class OwnerMapper    {

    //Attributes
    private $lastInsertId = null;

    function create($postdata)  {


        //Insert a new customer based on the post data that was inserted
        //Honestly though, probably didn't even need this as I could have just used the $postdata directly
        $owner = new Owner($postdata['name'], $postdata['gender'], $postdata['city'], $postdata['famSize']);

        //new PDOAgent
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost",DBNAME);

        //Connect to the Database
        $p->connect();


        //Setup the Bind Parameters
        $bindParams = [
        'Name' => $owner->name,
        'Gender' => $owner->gender,
        'City' => $owner->city,
        'FamSize' => $owner->famSize
        ];

        //Get the results of the insert query (rows inserted)
        $results = $p->query("INSERT INTO owners (Name, Gender, City, FamSize)
            VALUES (:Name, :Gender, :City, :FamSize);", $bindParams);

        echo $p->rowcount." Rows Affected<BR>";

        //copy the last inserted id
        $this->lastInsertId = $p->lastInsertId;

        //Disconnect from the database
        $p->disconnect();

        if ($p->rowcount != 1)  {
            trigger_error("Something when horribly wrong!");
            die();
        }

        //Return the last inserted ID from the PDO class (This is very important!)
        return $this->lastInsertId;

    }

    function read($ownID) {
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost",DBNAME);

        //Connect to the Database
        $p->connect();

        //Setup the Bind Parameters
        $bindParams = ['id'=>$ownID];

        //Get the results of the insert query (rows inserted)
        $results = $p->query("SELECT * FROM customers WHERE OwnerID = :id", $bindParams);
        //Disconnect from the database

        $p->disconnect();
        //Return the objects
        return $results[0];
    }

    function update($owner)   {
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost",DBNAME);

        //Connect to the Database
        $p->connect();

        //Setup the Bind Parameters
        $bindParams = [
            'Id'=>$owner['id'],
            'Name' => $owner['name'],
            'Gender' => $owner['gender'],
            'City' => $owner['city'],
            'FamSize' => $owner['famSize']
            ];

        $p->query("UPDATE owners SET Name = :Name, Gender= :Gender, City = :City,FamSize = :FamSize WHERE OwnerID = :Id", $bindParams);

        echo $p->rowcount." Rows Affected<BR>";


        $p->disconnect();
        //Return the ID of updated customer
        return $customer['id'];

    }

    function delete($OwnerID)   {

        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost",DBNAME);

        //Connect to the Database
        $p->connect();

        //Setup the Bind Parameters
        $bindParams = [
            'id'=>$OwnerID,
            ];

        //Get the results of the insert query (rows inserted)
        $results = $p->query("DELETE FROM owners WHERE OwnerID = :id", $bindParams);

        echo $p->rowcount." Rows Affected<BR>";

        //Disconnect from the database
        $p->disconnect();

        if ($p->rowcount != 1)  {
            trigger_error("Something when horribly wrong!");
            die();
        }

        //Return the ID of deleted customer
        return $CustomerID;

    }

    function listAll() {

        //new PDOAgent
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost",DBNAME);

        //Connect to the Database
        $p->connect();

        //Setup the Bind Parameters
        $bindParams = [];

        //Get the results of the insert query (rows inserted)
        $results = $p->query("SELECT * FROM owners;", $bindParams);
        //Disconnect from the database

        $p->disconnect();
        //Return the objects
        return $results;

    }

}

?>
