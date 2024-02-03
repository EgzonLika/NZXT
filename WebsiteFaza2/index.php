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

$userID = $ur->getUserByUsername($username);
$cartID = $ur->getCartByUsername($username);
$Itemlist = $ir->getPCItems();
$fulllist = $ir->getItems();
$Specials = $ir->getSpecialOffer();
$Prd=$ir->PCProductsHTML($Itemlist);
$SpcPrd = $ir->SpecialOfferHTML($Specials);
if($_SERVER['REQUEST_METHOD'] === 'POST')
{

  for($i = 0; $i <= count($fulllist);$i++)
  {
    if(isset($_POST['add'.$i]))
    {
      $uir->InsertItemtoUser($cartID,$userID,$i);
    }
  }
}
if(isset($_POST['Special']))
{
  $uir->InsertItemtoUser($cartID,$userID,7);
}
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
    <div class="Main">
        <div class="Customize js-Customize">
            <img src="NZXTStyles\blitzmode.png" alt="Blitz" height="40px">
            <h1 class="Titull">Expedite Your Costum PC</h1>
            <p class="Description">Blitz Mode ensures your custom PC is built and ready to ship in one business day.</p>
            <button class="Customize-PC">Customize Your PC</a></button>
            <p class="text"><i>Select Blitz Mode service while configuring your custom PC.</i></p>
        </div>
    </div>
    <div class="Player-PC js-Player-PC"></div>
    </div>
    <div class="Short">
        <h1 class="Titull">NZXT Prebuilt Gaming PCs</h1>
        <p style="color:#737279; font-size:16px">We use the latest generation performance components and configurations to get you gaming, fast.</p>
    </div>
    <div class="Container js-Container">

    </div>
    <div class="Rent-PC">
        <div class="Rent-PC-Text">
            <p style="font-size: 14px; margin:10px">Player: Two</p>
            <h3 style="font-size:30px; margin:10px">Rent Our Most Popular PC for $99/mo</h3>
            <p style="font-size:16px; margin:10px">Get into PC gaming with no commitment supported by award-winning customer service and a lifetime warranty.</p>
            <button class="Customize-PC">Rent a PC</button>
        </div>
        <div class="Rent-PC-Img">
            <img src="NZXTStyles\pcafterdisplay-removebg-preview.png" alt="PC" style="height: 230px;">
        </div>
    </div>
    <div class="Footer"> 
        <div class="Socials">
          <div class="empty"></div>
          <ul>
            <li><a href="https://www.facebook.com/NZXT/" target="_blank"><img src="NZXTStyles\icons8-facebook-24 (1).png" alt="FB"></a></li>
            <li><a href="https://twitter.com/intent/follow?screen_name=nzxt" target="_blank"><img src="NZXTStyles\icons8-twitter-24.png" alt="Twitter"></a></li>
            <li><a href="https://www.instagram.com/nzxt/" target="_blank"><img src="NZXTStyles\icons8-instagram-24.png" alt="IG"></a></li>
            <li><a href="https://youtube.com/nzxtus" target="_blank"><img src="NZXTStyles\icons8-youtube-24.png" alt="YT"></a></li>
            <li><a href="https://www.twitch.tv/nzxt" target="_blank"><img src="NZXTStyles\icons8-twitch-24 (1).png" alt="Twitch"></a></li>
            <li><a href="https://www.reddit.com/r/nzxt" target="_blank"><img src="NZXTStyles\icons8-reddit-24.png" alt="Reddit"></a></li>
            <li><a href="https://www.tiktok.com/@nzxt" target="_blank"><img src="NZXTStyles\icons8-tiktok-24.png" alt="TikTok"></a></li>
            <li><a href="https://discord.gg/NZXT" target="_blank"><img src="NZXTStyles\icons8-discord-24.png" alt="Discord"></a></li>
          </ul>
          <div class="empty"></div>
        </div>
        <div class="Footer-categories">
          <div class="empty"></div>
          <div class="Footer-Contact">
            <p>CONTACT</p>
            <button class="Footer-buttons">Company</button>
            <button class="Footer-buttons">Customer Support</button>
            <button class="Footer-buttons">Submit a Request</button>
            <button class="Footer-buttons">Support Center</button>
          </div>
          <div class="Footer-Contact">
            <p>ABOUT NZXT</p>
            <button class="Footer-buttons">Founder Q & A</button>
            <button class="Footer-buttons">Careers</button>
            <button class="Footer-buttons">Customer Reviews</button>
          </div>
          <div class="Footer-Contact">
            <p>COMMUNITY</p>
            <button class="Footer-buttons">Our Discord</button>
            <button class="Footer-buttons">Newsroom & Blog</button>
          </div>
          <div class="Footer-Contact">
            <p>SOFTWARE</p>
            <button class="Footer-buttons">CAM</button>
            <button class="Footer-buttons">CAM Feedback</button>
          </div>
          <div class="Footer-Contact">
            <p>ACCOUNT</p>
            <button class="Footer-buttons">Manage Your Account</button>
          </div>
          <div class="Footer-Contact">
            <p>NZXT STORE</p>
            <button class="Footer-buttons">NZXT BLD PC</button>
            <button class="Footer-buttons">Refurbished Builds</button>
            <button class="Footer-buttons">FAQ</button>
            <button class="Footer-buttons">Find a Retailer</button>
          </div>
          <div class="empty"></div>
        </div>
        <div class="END">
          <div class="empty"></div>
          <div class="END-END">
            <p style="margin-bottom:5px;margin-left:10px"><b>NZXT</b></p>
            <p style="display: inline-block; margin:0px; color: #91919c;margin-left:10px">&#xa9;NZXT Inc. 2023 All Rights Reserved</p>
            <button class="END-buttons">Legal</button>
            <button class="END-buttons">Privacy Policy</button>
            <button class="END-buttons">Manage Cookie Preferences</button>
          </div>
          <div class="empty"></div>
        </div>
    </div>
    <script type="module">
    document.addEventListener('DOMContentLoaded',function() {
      document.querySelector('.js-Container').innerHTML= `<?php echo $Prd; ?>`;
      document.querySelector('.js-Player-PC').innerHTML= `<?php echo $SpcPrd; ?>`;
      if('<?php echo $Role?>' == 'Admin')
      {
        let dashboard = document.getElementById('Dashboard');

        dashboard.style.display = 'block';
      }
    });
    </script>
</body>
</html>