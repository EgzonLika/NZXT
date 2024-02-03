<?php
$PurchaseID = $_GET['id'];
include_once 'DashboardRepository.php';
include_once 'Database.php';
include_once 'UserRepository.php';
session_start();
$username = $_SESSION['username'];

$dr = new DashboardRepository;
$ur = new UserRepository;

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
            <input id="Status" class="Input" name="Status" type="text" placeholder="Status">
            <input type="submit" name="Update-Btn" class="Update" value="Update"></button>
        </div>
    </form>
</body>
</html>
<?php
if(isset($_POST['Update-Btn']))
{
    $Status = $_POST['Status'];

    if(empty($Status))
    {
        echo"<script>alert('If you wish to update user information you will need to fill in all the fields!');<script>";
    }
    else
    {
        $dr->EditPurchase($Status,$userID,$PurchaseID);
        header("location:dashboard.php");
    }
}

?>