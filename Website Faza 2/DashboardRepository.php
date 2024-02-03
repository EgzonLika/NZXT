<?php

    class DashboardRepository
    {
        private $connection;

        function __construct()
        {
            $conn = new DatabaseConnection;
            $this->connection = $conn->startConnection();
        }
        function ShowAllUsers()
        {
            $conn = $this->connection;

            $sql = "SELECT * FROM users";

            $statement = $conn->prepare($sql);

            $statement->execute();
            
            $result = $statement->fetchAll();

            return $result;
        }
        function EditUser($Name,$LastName,$Email,$Username,$Password,$Role,$userID,$EditID)
        {
            $conn= $this->connection;

            $sql = "UPDATE users SET Name=?, LastName=?, Email=?, Username=?, Password=?, Role=?, EditID=? WHERE UserID=?";

            $statement = $conn->prepare($sql);

            $statement->execute([$Name,$LastName,$Email,$Username,$Password,$Role,$EditID,$userID]);

        }
        function GetUserByID($userID)
        {
            $conn= $this->connection;

            $sql = "SELECT * FROM users WHERE UserID = '$userID'";

            $statement = $conn->query($sql);

            $result=$statement->fetch();

            return $result;
        }
        function GetAllPurchases()
        {
            $conn=$this->connection;

            $sql ="SELECT * FROM purchases";

            $statement = $conn->query($sql);

            $result=$statement->fetchAll();

            return $result;
        }
        function EditItem($Image,$Name,$FactoryName,$Processor,$Graphics,$RAM,$Price,$Category,$adminId,$itemID)
        {
            $conn = $this->connection;

            $sql = "UPDATE items SET Image=?, Name=?, FactoryName=?, Processor=?, Graphics=?, RAM=?, Price=?, Category=?, EditID=?  WHERE ItemID=?";

            $statement = $conn->prepare($sql);

            $statement->execute([$Image,$Name,$FactoryName,$Processor,$Graphics,$RAM,$Price,$Category,$adminId,$itemID]);
        }
        function EditPurchase($Status,$EditID,$purchaseID)
        {
            $conn = $this->connection;

            $sql = "UPDATE purchases SET Status=?, EditID=? WHERE PurchaseID = ?";

            $statement = $conn->prepare($sql);

            $statement->execute([$Status,$EditID,$purchaseID]);
        }
        function deleteUser($userID)
        {
            $conn = $this->connection;

            $sql = "DELETE FROM users WHERE UserID = ?";

            $statement = $conn->prepare($sql);

            $result = $statement->execute([$userID]);
        }
        function deleteItem($ItemID)
        {
            $conn = $this->connection;

            $sql = "DELETE FROM items WHERE ItemID = ?";

            $statement = $conn->prepare($sql);

            $result = $statement->execute([$ItemID]);
        }
        function deletePurchase($purchaseID)
        {
            $conn = $this->connection;

            $sql = "DELETE FROM purchases WHERE PurchaseID = ?";

            $statement = $conn->prepare($sql);

            $result = $statement->execute([$purchaseID]);
        }
        function getContacts()
        {
            $conn = $this->connection;

            $sql = "SELECT * FROM contactus";

            $statement = $conn->query($sql);

            $result = $statement->fetchAll();

            return $result;
        }
        function EditContact($Status,$EditID,$ContactID)
        {
            $conn = $this->connection;

            $sql = "UPDATE contactus SET Status=?, EditID=? WHERE ContactID = ?";

            $statement = $conn->prepare($sql);

            $statement->execute([$Status,$EditID,$ContactID]);
        }
        function DeleteContact($ContactID)
        {
            $conn = $this->connection;

            $sql = "DELETE FROM contactus WHERE ContactID = ?";

            $statement = $conn->prepare($sql);

            $result = $statement->execute([$ContactID]);
        }
    }

?>