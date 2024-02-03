<?php
include_once 'Database.php';
include_once 'ItemsRepository.php';
include_once 'UserItemsRepository.php';
include_once 'UserRepository.php';
include_once 'DashboardRepository.php';

session_start();
if(!isset($_SESSION['username']))
{
  header("location:LogIn.php");
}
if(isset($_POST['Log']))
{
  session_destroy();
  header("location:LogIn.php");
}

$Role =$_SESSION['Role'];
$username = $_SESSION['username'];
$ir = new ItemRepository();
$uir = new UserItemRepository();
$ur = new UserRepository();
$dr = new DashboardRepository();

$userID = $ur->getUserByUsername($username);
$cartID = $ur->getCartByUsername($username);
$ItemList = $ir->getItems();
$CartQuantity = $uir->CartTotal($cartID);
$users=$dr->ShowAllUsers();
$Purchase = $dr->GetAllPurchases();
$Contacts = $dr->getContacts();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Dashboard/DashboardStyle.css">
</head>
<body>
<div class="box1">
        <div class="empty"></div>
        <div class="Slider">
            <p>All PCs built in 10-15 Business Days. <a class="Nothing">See Terms. <span class="arrow-right">&#x276F;</span></a></p>
        </div>
        <div class="empty"></div>
    </div>
    <div class="navbar">
        <div class="empty"></div>
        <div class="Categories">
            <a href="index.php" class="Title">NZXT</a>
            <ul class="list">
            <button class="I"><a href="AboutUs.php"  style="text-decoration:none;color:white">About Us <span class="Symbol">&#x276E;</span></button>
            <button class="I"><a href="ContactUs.php"  style="text-decoration:none;color:white">Contact Us <span class="Symbol">&#x276E;</span></button>
            <button class="I" id="Dashboard"><a href="dashboard.php"  style="text-decoration:none;color:white">Dashboard <span class="Symbol">&#x276E;</span></a></button>
            <button class="I"><a href="Shop.php" style="text-decoration:none;color:white">Shop <span class="Symbol">&#x276E;</span></a></button>
            </ul>
        </div>
        <div class="Interact">
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
              <button class="I js-Register" name="Log" style="padding-bottom:10px;">Log Out</button>
             <a href="Checkout.php"><img width="24" height="24" src="https://img.icons8.com/ios/24/FFFFFF/shopping-cart--v1.png" alt="Shop"/><button>
              <span class="js-shopping-cart"><?php echo $CartQuantity; ?></span>
            </button></a>
            </form>
        </div>
        <div class="empty"></div>
    </div>
    <div style="justify-content:center;text-align:center;padding-top:110px">
        <h1>Welcome <?php echo $username ?></h1>
        <h2 style="margin-right:1350px;">Users</h2>
        <table class="Table" border = "1">
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>LASTNAME</th>
                    <th>EMAIL</th>
                    <th>USERNAME</th>
                    <th>PASSWORD</th>
                    <th>ROLE</th>
                    <th>CART</th>
                    <th>EDIT</th>
                    <th>DELETE</th>
                    <th>LAST EDITED BY USER</th>
                </tr>
                <?php
                
                foreach($users as $user)
                {
                    echo"
                    <tr>
                        <td>$user[UserID]</td>
                        <td>$user[Name]</td>
                        <td>$user[LastName]</td>
                        <td>$user[Email]</td>
                        <td>$user[Username]</td>
                        <td>$user[Password]</td>
                        <td>$user[Role]</td>
                        <td>$user[CartID]</td>
                        <td><a href='UserEdit.php?id=$user[UserID]'>Edit</a></td>
                        <td><a href='UserDelete.php?id=$user[UserID]'>Delete</td>
                        <td>$user[EditID]</td>
                    </tr>
                    ";
                }
                ?>
                <tr>
                    <td><a href="Register.php">Add User</a></td>
                </tr> 
            </table>
            <p style="color:gray; font-size:small;margin-right:1000px;">*Reminder:If user has purchases/pending items the user will not be deleted</p>
            <h2 style="margin-right:1350px;">Items</h2>
            <table border="1" class="Table">
                <tr>
                    <th>ID</th>
                    <th>IMAGE-FILE</th>
                    <th>NAME</th>
                    <th>FACTORYNAME</th>
                    <th>PROCESSOR</th>
                    <th>GRAPHICS</th>
                    <th>RAM</th>
                    <th>PRICE</th>
                    <th>CATEGORY</th>
                    <th>EDIT</th>
                    <th>DELETE</th>
                    <th>ADDED BY</th>
                    <th>LAST EDITED BY USER</th>
                </tr>
                <?php
                
                foreach($ItemList as $Items)
                {
                    echo"
                    <tr>
                        <td>$Items[ItemID]</td>
                        <td>$Items[Image]</td>
                        <td>$Items[Name]</td>
                        <td>$Items[FactoryName]</td>
                        <td>$Items[Processor]</td>
                        <td>$Items[Graphics]</td>
                        <td>$Items[RAM]</td>
                        <td>$Items[Price]</td>
                        <td>$Items[Category]</td>
                        <td><a href='ItemEdit.php?id=$Items[ItemID]'>Edit</a></td>
                        <td><a href='ItemDelete.php?id=$Items[ItemID]'>Delete</td>
                        <td>$Items[AdminID]</td>
                        <td>$Items[EditID]</td>
                    </tr>
                    ";
                }
                ?>
                <tr>
                    <td><a href="AddItem.php">Add Item</a></td>
                </tr>
            </table>
            <p style="color:gray; font-size:small;margin-right:1000px;">*Reminder:If item is being purchased/in cart the item will not be deleted</p>
            <h2 style="margin-right:1300px;">Purchases</h2>
            <table border="1" class="Table">
                <tr>
                    <th>PURCHASE-ID</th>
                    <th>USER-ID</th>
                    <th>ITEM-ID</th>
                    <th>CART-ID</th>
                    <th>QUANTITY</th>
                    <th>STATUS</th>
                    <th>EDIT-STATUS</th>
                    <th>DELETE</th>
                    <th>LAST EDITED BY USER</th>
                </tr>
                <?php
                
                foreach($Purchase as $Purchase)
                {
                    echo"
                    <tr>
                        <td>$Purchase[PurchaseID]</td>
                        <td>$Purchase[UserID]</td>
                        <td>$Purchase[ItemID]</td>
                        <td>$Purchase[Cart]</td>
                        <td>$Purchase[Quantity]</td>
                        <td>$Purchase[Status]</td>
                        <td><a href='PurchaseEdit.php?id=$Purchase[PurchaseID]'>Edit</a></td>
                        <td><a href='DeletePurchase.php?id=$Purchase[PurchaseID]'>Delete</td>
                        <td>$Purchase[EditID]</td>
                    </tr>
                    ";
                }
                ?>
            </table>
            <h2 style="margin-right:1300px;">Contacts</h2>
            <table border="1" class="Table" style="margin-bottom: 50px;">
                <tr>
                    <th>CONTACT-ID</th>
                    <th>USER-ID</th>
                    <th>EMAIL</th>
                    <th>MESSAGE</th>
                    <th>EDIT-STATUS</th>
                    <th>DELETE</th>
                    <th>LAST EDITED BY USER</th>
                </tr>
                <?php
                
                foreach($Contacts as $Contact)
                {
                    echo"
                    <tr>
                        <td>$Contact[ContactID]</td>
                        <td>$Contact[UserID]</td>
                        <td>$Contact[Email]</td>
                        <td>$Contact[Message]</td>
                        <td><a href='EditContact.php?id=$Contact[ContactID]'>Edit</a></td>
                        <td><a href='DeleteContact.php?id=$Contact[ContactID]'>Delete</td>
                        <td>$Contact[EditID]</td>
                    </tr>
                    ";
                }
                ?>
            </table>
    </div>
</body>
</html>