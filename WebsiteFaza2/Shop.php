<?php
include_once 'Database.php';
include_once 'ItemsRepository.php';
include_once 'UserItemsRepository.php';
include_once 'UserRepository.php';;
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
$Itemlist = $ir->getEquipment();
$fulllist = $ir->getItems();
$Prd=$ir->ShopProductsHTML($Itemlist);
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
$CartQuantity = $uir->CartTotal($cartID);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="ShopStyles/ShopStyle.css">
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
    <div class="Slideshow">
      <button onclick="ImgDecrease()" style="height:auto;max-height: 130px;font-size:70px;background-color:white;color:black;">&#x2770;</button>
      <img id ="slide" height="500px" width="1300px">
      <button onclick="ImgIncrease()" style="height:auto;max-height: 130px;font-size:70px;background-color:white;color:black;">&#x2771;</button>
    </div>
    </div>
    <div class="Options">
        <div class="PCS">
            <img height="320" src="ShopStyles\ShoppingPC1.jpg" alt="">
            <h3>Shop Prebuilts</h3>
            <a href="">Shop Prebuilt PCs <span class="Symbol">&#x276E;</span></a>
        </div>
        <div class="PCS">
            <img height="320" src="ShopStyles\ShoppingPC2.jpg" alt="">
            <h3>Customize a PC</h3>
            <a href="">Start Your PC Build <span class="Symbol">&#x276E;</span></a>
        </div>
        <div class="PCS">
            <img height="320" src="ShopStyles\ShoppingPC3.jpg" alt="">
            <h3>Special Offers</h3>
            <a href="">Shop Special Offers <span class="Symbol">&#x276E;</span></a>
        </div>
    </div>
    <div class="Continue-Shopping">
        <div class="empty"></div>
        <div class="Middle">
            <p style="margin:auto;margin-top: 50px;">New</p>
            <h3 style="margin: 10px; margin-left:0;">Display it on Canvas</h3>
            <p style="margin: 10px; margin-left:0;">32" Curved QHD 165Hz Gaming Monitor</p>
            <button class="Shop-Player-PC">Shop QHD Monitors</button>
        </div>
        <div class="empty"></div>
    </div>
    <div style="display: flex;">
        <div class="empty"></div>
        <div style="justify-content:center;"><h3>Customers Also Bought</h3></div>
        <div class="empty"></div> 
    </div>
    <div class="Container js-Container"><?php echo $Prd; ?></div>
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
            <p style="display: inline-block; margin:0px; color: #91919c;margin-left:10px;">&#xa9;NZXT Inc. 2023 All Rights Reserved</p>
            <button class="END-buttons">Legal</button>
            <button class="END-buttons">Privacy Policy</button>
            <button class="END-buttons">Manage Cookie Preferences</button>
          </div>
          <div class="empty"></div>
        </div>
    </div>
    <script>
      let array = ["ShopStyles/Picture1.png",
      "ShopStyles/Picture9.jpg",
      "ShopStyles/Picture3.jpg",
      "ShopStyles/Picture7.jpg",
      "ShopStyles/Picture5.webp",
      "ShopStyles/Picture6.jpg"
    ];
    let i = 0
    function slideshow()
    {
      document.getElementById('slide').src = array[i];
      if(i < array.length-1)
      {
        i++;
      }
      else{
        i=0;
      }
    }
    function ImgIncrease()
    {
      if(i < array.length-1)
      {
        i++
      }
      else
      {
        i=0;
      }
      document.getElementById('slide').src = array[i];
    }
    function ImgDecrease()
    {
      if(i > 0)
      {
        i--
      }
      else
      {
        i=array.length-1;
      }
      document.getElementById('slide').src = array[i];
    }
    setInterval("slideshow()",3000);
    document.addEventListener('load',slideshow());
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