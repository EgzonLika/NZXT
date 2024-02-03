<?php
    include_once 'Database.php';
    include_once 'Users.php';

    class UserRepository{

        private $connection;

        function __construct()
        {
            $conn = new DatabaseConnection;
            $this->connection = $conn->startConnection();
        }

        function insertUser($user)
        {
            $conn = $this->connection;

            $uEmail = $user->getEmail();
            $uName = $user->getName();
            $uLastName = $user->getLastName();
            $uUsername = $user->getUsername();
            $uPassword = $user->getPassword();
            $uID = $user->getId();
            $role = $user->getRole();
            $cart = $user->getCartID();

            $sql = "INSERT INTO users (UserID,Name,LastName,Email,Username,Password,Role,CartID) VALUES (?,?,?,?,?,?,?,?)";
            
            $statement = $conn->prepare($sql);

            $statement->execute([$uID,$uName,$uLastName,$uEmail,$uUsername,$uPassword,$role,$cart]);

        }
        function validateUser($inputUsername)
        {
            $conn = $this->connection;

            $sql = "SELECT * FROM users WHERE username = '$inputUsername'";

            $statement = $conn->prepare($sql);

            $statement->execute();

            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if($user != null)
            {
                return $user;
            }
        }

        function getUserByUsername($username)
        {
            $conn = $this->connection;

            $sql = "SELECT UserID FROM users WHERE Username = '$username'";

            $statement = $conn->query($sql);

            $user = $statement->fetchColumn();

            return $user;
        }
        function getNrOfUsers()
        {
            $conn = $this->connection;

            $sql = "SELECT COUNT(UserID) as UserCount FROM users";

            $statement = $conn->query($sql);

            $user =$statement->fetch(PDO::FETCH_ASSOC);

            return $user['UserCount'];
        }
        function getCartByUsername($username)
        {
            $conn = $this->connection;

            $sql = "SELECT CartID FROM users WHERE Username = '$username'";

            $statement = $conn->query($sql);

            $user = $statement->fetchColumn();

            return $user;
        }
        function ContactUs($username,$email,$Message)
        {
            $conn = $this->connection;

            $sql = "INSERT INTO contactus (Name,Email,Message,Status) VALUES (?,?,?,?)";

            $statement = $conn->prepare($sql);

            $statement->execute([$username,$email,$Message,'Delivered']);
        }
        function getEmailByUsername($username)
        {
            $conn = $this->connection;

            $sql = "SELECT Email FROM users WHERE Username = '$username'";

            $statement = $conn->query($sql);

            $user = $statement->fetchColumn();

            return $user;
        }
    }
?>