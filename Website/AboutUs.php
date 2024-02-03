<?php
include_once 'Database.php';
include_once 'ItemsRepository.php';
include_once 'UserItemsRepository.php';
include_once 'UserRepository.php';
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
$cartID = $ur->getCartByUsername($username);
$CartQuantity = $uir->CartTotal($cartID);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NZXT Home page</title>
    <link rel="stylesheet" href="NZXTStyles/Style.css">
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
    <script>
    document.addEventListener('DOMContentLoaded',function() {
      if('<?php echo $Role?>' == 'Admin')
      {
        let dashboard = document.getElementById('Dashboard');

        dashboard.style.display = 'block';
      }
    });
    </script>
</body>
</html>