<?php
    include_once 'Database.php';
    include_once 'ItemsRepository.php';
    include_once 'UserItemsRepository.php';
    include_once 'UserRepository.php';

    class Cart
    {
        private $connection;

        function __construct()
        {
            $conn = new DatabaseConnection;
            $this->connection = $conn->startConnection();
        }
        function AllItemsInCart($cartID)
        {
            $conn =$this->connection;
            
            $sql = "SELECT c.UserID,i.ItemID,i.Image,i.Name,i.Price,c.Quantity,c.Cart FROM items i JOIN cart c ON i.ItemID = c.ITEMID WHERE cart = ?";

            $statement = $conn->prepare($sql);

            $statement->execute([$cartID]);

            $result = $statement->fetchAll();

            return $result;
        }
        function InsertItemsToCart($CartItems)
        {
            $conn = $this->connection;

            $PRODUCTS = [];
            
                for($i = 0; $i < sizeof($CartItems);$i++)
                {
                    $iItemID = $CartItems[$i]['ItemID'];
                    $iImage = $CartItems[$i]['Image'];
                    $iName = $CartItems[$i]['Name'];
                    $iPrice = $CartItems[$i]['Price'];
                    $iQuantity = $CartItems[$i]['Quantity'];
                        
                    if($i == 0)
                    {
                        $info = "
                        <div class='Pending-Products-Content' style='margin:20px'>
                            <div class='Product-pic'>
                                <img src='".$iImage."' height='200px' width='200px'>
                            </div>
                            <div class='Product-Info'>
                                <p style='margin-top:40px'>".$iName."</p>
                                <p>Price: $".$iPrice."</p>
                                <p>Quantity: ".$iQuantity."</p>
                                <form action='Checkout.php' method='post'>
                                <input type='submit' class='update' name='add".$iItemID."' value='Add 1'>
                                <input type='submit' class='update' name='remove".$iItemID."' value='Remove 1'>
                                <input type='submit' class='update' name='delete".$iItemID."' value='Delete'>
                                </form>
                            </div>
                            <div class='Product-Shipping'>
                                <p style='margin-top: 20px;'>Choose a delivery option</p>
                                <div>
                                    <input name='Date' id='radio1' type='radio'><span style='color: rgba(122, 0, 236, 0.956);'>Same Day Shipping</span><span class='shipping'>9,99$-Shipping</span>
                                </div>
                                <div>
                                    <input name='Date' id='radio2' type='radio'><span style='color: rgba(122, 0, 236, 0.956);'>2-3 Days</span><span class='shipping'>4,99$-Shipping</span>
                                </div>
                                <div>
                                    <input name='Date' id='radio3' type='radio'><span style='color: rgba(122, 0, 236, 0.956);'>Shipped Within Week</span><span class='shipping'>Free Shipping</span>
                                </div>
                            </div>
                        </div>";
                        $PRODUCTS[$i] = $info;
                    }
                    else{
                        $info = "
                        <div class='Pending-Products-Content' style='margin:20px'>
                            <div class='Product-pic'>
                                <img src='".$iImage."' height='200px' width='200px'>
                            </div>
                            <div class='Product-Info'>
                                <p style='margin-top:40px'>".$iName."</p>
                                <p>Price: $".$iPrice."</p>
                                <p>Quantity: ".$iQuantity."</p>
                                <form action='Checkout.php' method='post'>
                                <input type='submit' class='update' name='add".$iItemID."' value='Add 1'>
                                <input type='submit' class='update' name='remove".$iItemID."' value='Remove 1'>
                                <input type='submit' class='update' name='delete".$iItemID."' value='Delete'>
                                </form>
                            </div>
                        </div>";
                        $PRODUCTS[$i] = $info;
                    }
                }   
                $combinedString=implode("",$PRODUCTS);
                return $combinedString;
        }
        function getItemQuantity($ItemID)
        {
            $conn =$this->connection;
            
            $sql = "SELECT Quantity FROM cart WHERE ITEMID = ?";

            $statement = $conn->prepare($sql);

            $statement->execute([$ItemID]);

            $result = $statement->fetchColumn();

            return $result;
        } 
        function IncreaseItemQuantity($ItemID)
        {
            $conn =$this->connection;
            
            $sql = "UPDATE cart SET Quantity = Quantity+1 WHERE ITEMID = ?";

            $statement = $conn->prepare($sql);

            $statement->execute([$ItemID]);
        }
        function DecreaseItemQuantity($ItemID)
        {
            $conn =$this->connection;

            if($this->getItemQuantity($ItemID) > 0)
            {
            $sql = "UPDATE cart SET Quantity = Quantity-1 WHERE ITEMID = ?";

            $statement = $conn->prepare($sql);

            $statement->execute([$ItemID]);
                
            }
            else{
                $sql = "DELETE  FROM cart WHERE ITEMID = ?";

                $statement = $conn->prepare($sql);

                $statement->execute([$ItemID]);
                
            }
        }
        function DeleteItemFromCart($ItemID)
        {
            $conn =$this->connection;

            $sql = "DELETE  FROM cart WHERE ITEMID = ?";

            $statement = $conn->prepare($sql);

            $statement->execute([$ItemID]);
        
        }
        function RegisterPurchase($Cart)
        {
            for($i = 0; $i < count($Cart);$i++)
            {
                $cItemID = $Cart[$i]['ItemID'];
                $cUserID = $Cart[$i]['UserID'];
                $cCart = $Cart[$i]['Cart'];
                $iQuantity = $Cart[$i]['Quantity'];
            
            $conn=$this->connection;

            $sql ="INSERT INTO purchases (UserID,Cart,ItemID,Quantity,Status) VALUES (?,?,?,?,'Processing')";

            $statement = $conn->prepare($sql);

            $statement->execute([$cUserID,$cCart,$cItemID,$iQuantity]);
            }
            echo "<script>alert('You have successfully purchased your items');</script>";
        }
        function DeleteCart($cartID)
        {
            $conn= $this->connection;

            $sql = "DELETE FROM cart WHERE Cart = ?";

            $statement = $conn->prepare($sql);

            $statement->execute([$cartID]);

        }
    }

?>