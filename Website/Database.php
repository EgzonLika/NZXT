<?php
class DatabaseConnection{

    private $dbServer = "localhost";
    private $dbName = "NzxtDatabase";
    private $dbUsername = "root";
    private $dbPass = "";

    function startConnection()
    {

        try{
            $conn = new PDO("mysql:host=$this->dbServer;dbname=$this->dbName",$this->dbUsername,$this->dbPass);
            $conn ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch(PDOException $e)
        {
            echo"Could not connect to database!".$e->getMessage();
            return null;
        }
    }
}
?>