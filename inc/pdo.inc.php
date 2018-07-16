<?php 



//Not even sure if we will need to touch this aside from modifying the config.inc file.


class PDOAgent {

    private $dsn = "";
    private $dbuser = "";
    private $dbpass = "";
    public $rowcount;
    public $pdo;
    public $lastInsertId = null;


    function __construct($dbtype, $user, $pass, $host, $db) {
        //Build the DSN for conenction
        $this->dsn = $dbtype.":host=".$host.";dbname=".$db;

        //Username and password credentials
        $this->dbuser = $user;
        $this->dbpass = $pass;
    }

    function __toString()   {
        return "DSN: ".$this->dsn." ";
    }

    function connect()  {
        try {
            $this->pdo = new PDO($this->dsn, $this->dbuser, $this->dbpass);
        } catch (Exception $ex) {
            echo "Error connecting to the database:".$ex->getMessage();
        }
    }

    function query($strQuery, $bindParams) {
        try {
            $stmt = $this->pdo->prepare($strQuery);
            $stmt->execute($bindParams);
        } catch (Exception $ex) {
            echo "Error Executing Query:".$ex->getMessage();
        }
        
        $resultset = null;

        while ($result =  $stmt->fetch(PDO::FETCH_OBJ)) {
            $resultset[] = $result;
        }
        
        $this->rowcount = $stmt->rowcount();
        $this->lastInsertId = $this->pdo->lastInsertId();
        //This whole lastInsertId only works on insert. Returns 0 otherwise. Go figure.
        return $resultset;
       
    }

    function disconnect()   {
        try {
            $this->db = null;
        } catch (Exception $ex) {
            echo "Error Disconnect: ".$ex->getMessage();
        }
    }
        
}

?>