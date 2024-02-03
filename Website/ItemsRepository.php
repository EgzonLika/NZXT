<?php
    include_once 'Database.php';
    include_once 'Items.php';

    class ItemRepository{

        private $connection;

        function __construct()
        {
            $conn = new DatabaseConnection;
            $this->connection = $conn->startConnection();
        }

        function insertItem($Item)
        {
            $conn = $this->connection;

            $iImage = $Item->getImage();
            $iName = $Item->getName();
            $iFactoryName = $Item->getFactoryName();
            $iProcessor = $Item->getProcessor();
            $uGraphics = $Item->getGraphics();
            $iRAM = $Item->getRAM();
            $iPrice = $Item->getPrice();
            $iCategory = $Item->getCategory();
            $iAddedBy = $Item->getAddedBy();

            $sql = "INSERT INTO Items (Image,Name,FactoryName,Processor,Graphics,RAM,Price,Category,AdminID) VALUES (?,?,?,?,?,?,?,?,?)";
            
            $statement = $conn->prepare($sql);

            $statement->execute([$iImage,$iName,$iFactoryName,$iProcessor,$uGraphics,$iRAM,$iPrice,$iCategory,$iAddedBy]);

            echo"<script>alert('Item has been inserted successfully')</script>";
        }
        function getItems()
        {
            $conn = $this->connection;

            $sql = "SELECT * FROM Items";

            $statement = $conn->query($sql);

            $statement->execute();

            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }
        function getSpecialOffer()
        {
            $conn = $this->connection;

            $sql = "SELECT * FROM Items WHERE Category = 'Special PC'";

            $statement = $conn->prepare($sql);

            $statement->execute();

            $result = $statement->fetch(PDO::FETCH_ASSOC);
            
            return $result;


        }
        function getPCItems()
        {
            $conn = $this->connection;

            $sql = "SELECT * FROM Items WHERE Category = 'PC'";

            $statement = $conn->prepare($sql);

            $statement->execute();

            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }
        function getEquipment()
        {
            $conn = $this->connection;

            $sql = "SELECT * FROM Items WHERE Category = 'Equipment'";

            $statement = $conn->prepare($sql);

            $statement->execute();

            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }
        function ShopProductsHTML($ShopItems)
        {
            $conn = $this->connection;

            $PRODUCTS = [];

                for($i = 0; $i < sizeof($ShopItems);$i++)
                {
                        $iID = $ShopItems[$i]['ItemID'];
                        $iImage = $ShopItems[$i]['Image'];
                        $iName = $ShopItems[$i]['Name'];
                        $iFactoryName = $ShopItems[$i]['FactoryName'];
                        $iPrice = $ShopItems[$i]['Price'];

                        $info = "
                            <div class='box'>
                                <div class='img'>
                                    <img style='margin:15px' src='".$iImage."' alt='Item1' height='230px' width='230px'>
                                    <form action='Shop.php' method='post'>
                                    <button class='idk button-primary js-Buy' name='add".$iID."'>Add To Cart</button>
                                    </form>
                                </div>
                                <p style='color: black ; font-weight:600;font-size:18px; margin-bottom:5px;'>".$iName."</p>
                                <p>".$iFactoryName."</p>
                                <p style='font-size:14px; color: black;'>".$iPrice."</p>
                            </div>";
                        $PRODUCTS[$i] = $info;
                }
                $combinedString=implode("",$PRODUCTS);
                return $combinedString;
        }
        function PCProductsHTML($ShopItems)
        {
            $conn = $this->connection;

            $PRODUCTS = [];
            
                for($i = 0; $i < sizeof($ShopItems);$i++)
                {
                        $iID = $ShopItems[$i]['ItemID'];
                        $iImage = $ShopItems[$i]['Image'];
                        $iName = $ShopItems[$i]['Name'];
                        $iFactoryName = $ShopItems[$i]['FactoryName'];
                        $iProcessor = $ShopItems[$i]['Processor'];
                        $iGraphics = $ShopItems[$i]['Graphics'];
                        $iRAM = $ShopItems[$i]['RAM'];
                        $iPrice = $ShopItems[$i]['Price'];

                        $info = "
                            <div class='Prebuilt'>
                                <div class='img'>
                                    <img style='margin:15px' src='".$iImage."' alt='Item1' height='340px' width='340px'>
                                    <form action='index.php' method='post'>
                                    <button class='idk button-primary js-Buy' name='add".$iID."'>Add To Cart</button>
                                    </form>
                                </div>
                                <div class='PC-info'>
                                    <h2 style='margin: 20px 0px 6px 0px;'>".$iName."</h2>
                                    <p class='Rating'>".$iFactoryName."</p>                
                                    <hr>
                                    <p class='INFO' style='margin-top: 20px;'><b>Key Specs</b></p>
                                    <p class='INFO'>".$iProcessor."</p>
                                    <p class='INFO'>".$iGraphics."</p>
                                    <p class='INFO'>".$iRAM."</p>
                                    <hr>
                                    <p>".$iPrice."</p>
                                    </div>
                                    <a href='Shop.php'><button class='SHOP js-Shop'>Shop</button></a>
                                    </div>";
                        $PRODUCTS[$i] = $info;
                    }
                $combinedString=implode("",$PRODUCTS);
                return $combinedString;
        }
        function SpecialOfferHTML($ShopItems)
        {
                    $iName = $ShopItems['Name'];
                    $iProcessor = $ShopItems['Processor'];
                    $iGraphics = $ShopItems['Graphics'];
                    $iRAM = $ShopItems['RAM'];
                    $iPrice = $ShopItems['Price'];
                    $Offer = "<div class='Player-PC-content'>
                    <img src='NZXTStyles/NEW.jpg' alt='NEW' class='NEW' height='30px' width='50px'>
                    <p class='Player-PC-cost'>".$iPrice."</p>
                    <h1>Player ".$iName."</h1>
                    <p>Our brand-new Player PC powered by an ".$iProcessor." and ".$iGraphics.". An immensely powerful gaming PC with superb productivity with cutting-edge ".$iRAM." memory.</p>
                    <form action='index.php' method='post'>
                    <button class='Shop-Player-PC button-primary js-Player-PC' name='Special'>Shop ".$iName."</button>
                    </form>
                    </div>";
            return $Offer;
        }
        function getPCImages()
        {
            $array = [];

            $conn = $this->connection;

            $sql = "SELECT Image FROM items WHERE Category = 'PC'";

            $statement = $conn->prepare($sql);

            $statement->execute();

            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach($result as $result)
            {
                $string = "";
                $string = $result['Image'];
                $array[] = $string;
            }
            return $array;
        }
    }
?>