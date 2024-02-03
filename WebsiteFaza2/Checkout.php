<?php
include_once 'ItemsRepository.php';
include_once 'UserItemsRepository.php';
include_once 'UserRepository.php';
include_once 'Cart.php';

session_start();
if(isset($_POST['Log']))
{
  session_destroy();
  header("location:LogIn.php");
}
if(!isset($_SESSION['username']))
{
  header("location:LogIn.php");
}
$Role =$_SESSION['Role'];
$username = $_SESSION['username'];
$uir = new UserItemRepository();
$ur = new UserRepository();
$ir = new ItemRepository();
$cart = new Cart();

$fulllist = $ir->getItems();
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    for($i = 0; $i <= count($fulllist);$i++)
    {
        if(isset($_POST['add'.$i]))
        {
            $cart->IncreaseItemQuantity($i);
        }
        if(isset($_POST['remove'.$i]))
        {
            $cart->DecreaseItemQuantity($i);
        }
        if(isset($_POST['delete'.$i]))
        {
            $cart->DeleteItemFromCart($i);
        }
    }
}
$ShippingPrice1=9.99;
$ShippingPrice2=4.99;
$ShippingPrice3=0;
$userID = $ur->getUserByUsername($username);
$cartID = $ur->getCartByUsername($username);
$AllItems =$cart->AllItemsInCart($cartID);
if(isset($_POST['RegisterPurchase']))
{
    if(count($AllItems) === 0)
    {
        echo"<script>alert('Please Insert An Item Before Making A Purchase!')</script>";
    }
    else
    {
        $cart->RegisterPurchase($AllItems); 
        $cart->DeleteCart($cartID);
    }
}
$CartQuantity = $uir->CartTotal($cartID);
$ItemsTotalPrice =$uir->getItemsTotal($cartID);
$CheckoutHTML = $cart->InsertItemsToCart($AllItems);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CheckoutStyles/CheckoutStyles.css"></head>
    <link rel="stylesheet" href="NZXTStyles/Style.css">
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
              <button class="I">About Us <span class="Symbol">&#x276E;</span></button>
              <button class="I">Contact Us <span class="Symbol">&#x276E;</span></button>
              <button class="I" id="Dashboard"><a href="dashboard.php"  style="text-decoration:none;color:white">Dashboard <span class="Symbol">&#x276E;</span></a></button>
              <button class="I"><a href="Shop.php" style="text-decoration:none;color:white">Shop <span class="Symbol">&#x276E;</span></a></button>
            </ul>
        </div>
        <div class="Interact">
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
              <button class="I js-Register" name="Log" style="padding-bottom:10px;">Log Out</button>
             <a href="Checkout.php"><img width="24" height="24" src="https://img.icons8.com/ios/24/FFFFFF/shopping-cart--v1.png" alt="Shop"/><button>
              <span class="js-shopping-cart">0</span>
            </button></a>
            </form>
        </div>
        <div class="empty"></div>
    </div>
    <h1 class="Checkout-title">Checkout (<span style="color: rgba(122, 0, 236, 0.956);"><?= $CartQuantity?> Items</span>)</h1>
    <h2 class="Review-Order">Review Your Order</h2>
    <div class="centered-div">
        <div class='Pending-Products js-Pending-Products'>
            <h3 class='idk js-date'style='color:rgba(122, 0, 236, 0.956)'></h3>
            <div class="Content js-content" style="display: flex; flex-direction:column;"></div>
        </div>
    <div class="Order-Summary" style="height:320px">
        <h3>Order Summary</h3>
        <hr>
        <div class="Order-Summary-Prices">
            <div style="flex:1">Items(<?= $CartQuantity?>):</div>
            <div style="margin-left:10px"><?=$ItemsTotalPrice?>$</div>
        </div>
        <div class="Order-Summary-Prices">
            <div style="flex:1">Shipping & Handling:</div>
            <div id="ShippingPrice" style="margin-left:10px">$</div>
        </div>
        <div class="Order-Summary-Prices">
            <div style="flex:1">Total Before Tax:</div>
            <div id="NoTaxTotal" style="margin-left:10px">$</div>
        </div>
        <div class="Order-Summary-Prices">
            <div style="flex:1">Estimated Tax(10%):</div>
            <div id="TaxTotal" style="margin-left:10px">$</div>
        </div>
        <div class="Order-Summary-Prices">
            <div style="flex:1; color:rgba(122, 0, 236, 0.956);"><h4>Order Total:</h4></div>
            <div id="OrderTotal"style="margin-left:10px; margin-top:20px; color:rgba(122, 0, 236, 0.956);">$</div>
        </div>
        <div style="margin-left:70px">
        <form action="Checkout.php" method="post">
        <button name="RegisterPurchase" class="Finish-Order">Finish Order</button>
        </form>
        </div>
    </div>
</div>
<script>
    if('<?php echo $Role?>' === 'Admin')
        {
            let dashboard = document.getElementById('Dashboard');

            dashboard.style.display = 'block';
        }
</script>
    <script type="text/javascript">
         document.addEventListener('DOMContentLoaded',function() {
        document.querySelector('.js-content').innerHTML = `<?php echo $CheckoutHTML?>`;
        document.getElementById('radio1').addEventListener('click', OptionOne);
        document.getElementById('radio2').addEventListener('click', OptionTwo);
        document.getElementById('radio3').addEventListener('click', OptionThree);
        let ShippingPrice=0;
        function OptionOne()
        {
            document.querySelector('.js-date').innerHTML = `Product will be shipped today`;
            document.getElementById('ShippingPrice').innerHTML = '<?=$ShippingPrice1?>$';
            ShippingPrice = 9.99;
            let ItemsPrice = <?php echo $ItemsTotalPrice; ?>;
            let Notax = ItemsPrice + ShippingPrice;
            document.getElementById('NoTaxTotal').innerHTML = `${Notax.toFixed(2)}$`;
            let TotalTax = Notax+(Notax*10)/100;
            document.getElementById('TaxTotal').innerHTML = `${TotalTax.toFixed(2)}$`;
            document.getElementById('OrderTotal').innerHTML = `${TotalTax.toFixed(2)}$`;
        }
        function OptionTwo()
        {

            document.querySelector('.js-date').innerHTML = `Product will arrive In 2-3 days `;
            document.getElementById('ShippingPrice').innerHTML = '<?=$ShippingPrice2?>$';
            ShippingPrice = 4.99;
            let ItemsPrice = <?php echo $ItemsTotalPrice; ?>;
            let Notax = ItemsPrice + ShippingPrice;
            document.getElementById('NoTaxTotal').innerHTML = `${Notax.toFixed(2)}$`;
            let TotalTax = Notax+(Notax*10)/100;
            document.getElementById('TaxTotal').innerHTML = `${TotalTax.toFixed(2)}$`;
            document.getElementById('OrderTotal').innerHTML = `${TotalTax.toFixed(2)}$`;
        }
        function OptionThree()
        {
            document.querySelector('.js-date').innerHTML = `Product will arrive within 7 days`;
            document.getElementById('ShippingPrice').innerHTML = '<?=$ShippingPrice3?>$';
            ShippingPrice = 0;
            let ItemsPrice = <?php echo $ItemsTotalPrice; ?>;
            let Notax = ItemsPrice + ShippingPrice;
            document.getElementById('NoTaxTotal').innerHTML = `${Notax.toFixed(2)}$`;
            let TotalTax = Notax+(Notax*10)/100;
            document.getElementById('TaxTotal').innerHTML = `${TotalTax.toFixed(2)}$`;
            document.getElementById('OrderTotal').innerHTML = `${TotalTax.toFixed(2)}$`;
        }
    })
    </script>
</body>
</html>