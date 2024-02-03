<?php
include_once 'DashboardRepository.php';
include_once 'Database.php';
include_once 'UserRepository.php';
include_once 'ItemsRepository.php';
include_once 'Items.php';
session_start();
$username = $_SESSION['username'];

$dr = new DashboardRepository;
$ur = new UserRepository;
$ir = new ItemRepository;

$userID = $ur->getUserByUsername($username);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <style>
        body{
            background-color: rgba(122, 0, 236, 0.956);
            justify-content: center;
            margin-top:150px;
            display:flex;
        }
        .Input{
            margin:10px;
            margin-left:0px;
            padding:5px;
        }
        .Update
        {
            margin:10px;
            margin-left:0px;
            padding:5px;
            background-color: blue;
            color: white;
        }
        .UpdateLog
        {
            border-radius: 10px;
            background-color: white;
            display: flex;
            flex-direction:column;
            padding: 50px;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <div class="UpdateLog">
            <input id="Image" class="Input" name="Image" type="text" placeholder="Image-File">
            <input id="Name" class="Input" name="Name" type="text" placeholder="Name">
            <input id="FactoryName" class="Input" name="FactoryName" type="text" placeholder="FactoryName">
            <input id="Processor" class="Input" name="Processor" type="text" placeholder="Processor">
            <input id="Graphics" class="Input" name="Graphics" type="text" placeholder="Graphics Card">
            <input id="RAM" class="Input" name="RAM" type="text" placeholder="RAM">
            <input id="PRICE" class="Input" name="PRICE" type="number" placeholder="Price">
            <input id="CATEGORY" class="Input" name="CATEGORY" type="text" placeholder="Category">
            <input type="submit" name="Update-Btn" class="Update" value="Update"></button>
            <div class="error"></div>
        </div>
    </form>
</body>
</html>
<?php
if(isset($_POST['Update-Btn']))
{
    $Image =$_POST['Image'];
    $Name = $_POST['Name'];
    $FactoryName = $_POST['FactoryName'];
    $Processor = $_POST['Processor'];
    $Graphics = $_POST['Graphics'];
    $RAM = $_POST['RAM'];
    $PRICE = $_POST['PRICE'];
    $CATEGORY = $_POST['CATEGORY'];

    if(empty($Name) || empty($Image) || empty($FactoryName) || empty($PRICE) || empty($CATEGORY))
    {
        echo"<script>alert('If you wish to update user information you will need to fill in all the fields!');<script>";
    }
    else
    {
        try{
        $Item = new Items($Image,$Name,$FactoryName,$Processor,$Graphics,$RAM,$PRICE,$CATEGORY,$userID);
        $ir->insertItem($Item);
        header("location:dashboard.php");
        }
        catch(PDOException)
        {
            echo"Item already exists";
            header("location:dashboard.php");
        }
    }
}

?>