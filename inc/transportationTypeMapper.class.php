
<?php

class TransportationTypeMapper    {

    private $lastInsertId = null;
    private $attributes = null;

    //We will use this to construct our queries. Particularly the "FROM" part of queries


    function create($postdata)  {
        //Using passed data, add object to the database. We assume ID is automatically generated.
        //Insert a new customer based on the post data that was inserted
        $transportationType = new TransportationType(
            $postdata['name'], $postdata['description'], $postdata['wheels'], $postdata['fuel']
          );

        //new PDOAgent
        $p =new PDOAgent("mysql", DBUSER,DBPASSWD,"localhost",DBNAME);

        //Connect to the Database
        $p->connect();

        //Setup the Bind Parameters
        $bindParams = [
          'name' => $transportationType->name,
          'description' => $transportationType->description,
          'wheels' => $transportationType->wheels,
          'fuelType' => $transportationType->fuel
        ];

        //Get the results of the insert query (rows inserted)
        $results = $p->query("INSERT INTO TransportationTypes (Name, Description, Wheels, FuelType)
            VALUES (:name, :description, :wheels, :fuelType);", $bindParams);
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
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost",DBNAME);
        $p->connect();
        $bindParams = ['id'=>$id];
        $results = $p->query("SELECT * FROM TransportationTypes WHERE TransID = :id",$bindParams);

        $p->disconnect();
        return $results[0];

    }

    function update($tansType)   {
        //Update the data of Object with passed ID
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost",DBNAME);
        $p->connect();

        $bindParams = ['TransID'=>$tansType['id'],
            'Name'=>$tansType['name'],
            'Description'=>$tansType['description'],
            'Wheels'=>$tansType['wheels'],
            'FuelType'=>$tansType['fuel']
        ];
        var_dump($bindParams);
        $p->query("UPDATE TransportationTypes SET Name= :Name, Description= :Description,
            Wheels= :Wheels, FuelType= :FuelType WHERE TransID = :TransID", $bindParams);
        echo $p->rowcount." Rows Affected<BR>";

        $p->disconnect();
        return $tansType['id'];
    }

    function delete($id)   {
        //Delete the data of the object with the passed ID
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost",DBNAME);
        $p->connect();
        $bindParams = ['transId'=>$id];
        $results = $p->query("DELETE FROM TransportationTypes WHERE TransID = :transId", $bindParams);
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
        $results = $p->query("SELECT *  FROM TransportationTypes;",$bindParams);

        $p->disconnect();

        return $results;
    }
    
    function searchDisplay($term){
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost",DBNAME);
        $p->connect();
        $bindParams = [];
        $results = $p->query("SELECT *  FROM TransportationTypes;",$bindParams);

        $p->disconnect();

        $term = strtolower($term);
        $searchList = [];

        foreach($results as $result) {
            if(strpos(strtolower($result->Name), $term) !== false){
                $searchList[] = $result;
            }elseif(strpos(strtolower($result->Description), $term) !== false){
                $searchList[] = $result;
            }elseif(strpos(strtolower($result->Wheels),     $term) !== false){
                $searchList[] = $result;
            }elseif(strpos(strtolower($result->FuelType), $term) !== false){
                $searchList[] = $result;
            }elseif(strpos(strtolower($result->TransID), $term) !== false){
                $searchList[] = $result;
            }
        }
        return $searchList;
    }

}

?>
