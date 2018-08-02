<?php


class OwnerMapper    {

    private $lastInsertId = null;
    private $attributes = null;

    //We will use this to cvar_dump($_POST['Search']);onstruct our queries. Particularly the "FROM" part of queries


    function create($postdata)  {
        //Using passed data, add object to the database. We assume ID is automatically generated.
        //Insert a new customer based on the post data that was inserted

        validateNumber($postdata['familySize'],1,"Family Size input is invalid. Must a number greater than 1.");
        $owner = new Owner(cleanString($postdata['name'],30), cleanString($postdata['city'],58), cleanString($postdata['gender'],20), $postdata['familySize']);

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
        validateNumber($id,1,"Tried to read data of invalid entry");
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost", DBNAME);
        $p->connect();
        $bindParams = ['id'=>$id];
        $results = $p->query("SELECT * FROM Owners WHERE OwnerID = :id",$bindParams);

        $p->disconnect();

        return $results[0];

    }

    function update($owner)   {
        //Update the data of Object with passed ID
        validateNumber($owner['ownerId'],1,"Owner ID is invalid or is below 1.<br>");
        validateNumber($owner['ownerId'],1,"FamilySize input is invalid or is below 1.");

        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost", DBNAME);
        $p->connect();
        $bindParams = ['OwnerID' =>$owner['ownerId'],
            'Name' =>cleanString($owner['name'],30),
            'City' =>cleanString($owner['city'],58),
            'Gender' =>cleanString($owner['gender'],20),
            'FamilySize' =>$owner['familySize']
        ];

        $p->query("UPDATE Owners SET Name= :Name, City= :City, Gender= :Gender,
           FamilySize= :FamilySize WHERE OwnerID = :OwnerID", $bindParams);
        echo $p->rowcount." Rows Affected<BR>";
        if($p->rowcount === 0){
          echo '<DIV CLASS="alert alert-success">Owner '.$owner['ownerId'].' was not updated.<br>';
        }else{
          echo '<DIV CLASS="alert alert-success">Owner '.$owner['ownerId'].' has been updated.<br>';
        }

        $p->disconnect();
        return $owner['ownerId'];
    }

    function delete($id)   {
        //Delete the data of the object with the passed ID
        validateNumber($id,1,"Owner ID is invalid or is below 1.");

        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost", DBNAME);
        $p->connect();
        $bindParams = ['ownerId'=>$id];
        $results = $p->query("DELETE FROM Owners WHERE OwnerID = :ownerId", $bindParams);
        echo $p->rowcount." Rows Affected<BR>";

        $p->disconnect();
        if ($p->rowcount < 1){
          echo '<DIV CLASS="alert alert-danger">Something went horribly wrong!<br>
                This owner still has vehicles. Please remove all their owned vehicles first.</DIV>';
            returnForm();
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

    function searchDisplay($term) {
        $p = new PDOAgent("mysql",DBUSER,DBPASSWD,"localhost", DBNAME);
        $p->connect();
        $bindParams = [];
        $results = $p->query("SELECT *  FROM Owners;",$bindParams);

        $p->disconnect();

        $term = strtolower($term);
        $searchList = [];

        foreach($results as $result) {
            if(strpos(strtolower($result->Name), $term) !== false){
                $searchList[] = $result;
            }elseif(strpos(strtolower($result->City), $term) !== false){
                $searchList[] = $result;
            }elseif(strpos(strtolower($result->Gender), $term) !== false){
                $searchList[] = $result;
            }elseif(strpos(strtolower($result->FamilySize), $term) !== false){
                $searchList[] = $result;
            }elseif(strpos(strtolower($result->OwnerID), $term) !== false){
                $searchList[] = $result;
            }
        }
        return $searchList;
    }


}

?>
