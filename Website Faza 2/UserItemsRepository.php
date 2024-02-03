<?php
    include_once 'Database.php';
    include_once 'UserItems.php';
    include_once 'UserRepository.php';

    class UserItemRepository{

        private $connection;

        function __construct()
        {
            $conn = new DatabaseConnection;
            $this->connection = $conn->startConnection();
        }
        function InsertItemtoUser($CartID,$UserID,$ItemID)
        {
            $conn = $this->connection;

            $count = $this->CountUserItems($UserID,$ItemID);   

            if($count === 0)
            {
                $sql = "INSERT INTO cart (USERID,ITEMID,Quantity,Cart) VALUES (?,?,?,?)";
                $statement = $conn->prepare($sql);
                $statement->execute([$UserID,$ItemID,1,$CartID]);
                return;
            }
            else
            {
                $sql = "UPDATE cart SET Quantity = Quantity+1 WHERE UserID = ? AND ItemID = ?";
                $statement = $conn->prepare($sql);
                $statement->execute([$UserID,$ItemID]);
                return;
            }
        }
        function CountUserItems($UserID,$ItemID)
        {
            $conn = $this->connection;

            $sql = "SELECT COUNT(*) FROM cart WHERE USERID = ? AND ITEMID = ?";

            try
            {
            $statement = $conn->prepare($sql);
            $statement->execute([$UserID,$ItemID]);
            $result = $statement->fetchColumn();
            return $result;
            }
            catch(PDOException $e)
            {
                return 0;
            }
        }
        function CartTotal($CartID)
        {
            $conn = $this->connection;

            $sql = "SELECT SUM(Quantity) FROM cart WHERE Cart = ?";

            $statement = $conn->prepare($sql);

            $statement->execute([$CartID]);

            $result = $statement->fetchColumn();

            return $result;
        }
        function getItemsTotal($Cart)
        {
            $conn =$this->connection;

            $sql ="SELECT SUM(i.Price * c.Quantity) FROM items i JOIN cart c ON i.ItemID = c.ITEMID WHERE Cart = ?";

            $statement = $conn->prepare($sql);

            $statement->execute([$Cart]);

            $result = $statement->fetchColumn();

            return $result;
        }
    }
?>