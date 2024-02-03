<?php
$user = $_GET['id'];
include_once 'DashboardRepository.php';
include_once 'Database.php';
include_once 'UserRepository.php';

session_start();
$username = $_SESSION['username'];

$dr = new DashboardRepository;
$ur = new UserRepository;

$userID = $ur->getUserByUsername($username);
$UserInfo = $dr->GetUserByID($user);

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
            <input id="Name" class="Input" name="Name" type="text" placeholder="Name">
            <input id="LastName" class="Input" name="LastName" type="text" placeholder="Last Name">
            <input id="Username" class="Input" name="username" type="text" placeholder="Username">
            <input id="Email" class="Input" name="email" type="email" placeholder="Email">
            <input id="Psw" class="Input" name="Psw" type="password" placeholder="Password">
            <input id="Role" class="Input" name="Role" type="text" placeholder="Role">
            <input type="submit" name="Update-Btn" class="Update" value="Update"></button>
            <div class="error"></div>
        </div>
    </form>
</body>
</html>
<?php
if(isset($_POST['Update-Btn']))
{
    $Name = $_POST['Name'];
    $LastName = $_POST['LastName'];
    $Username = $_POST['username'];
    $Password = password_hash($_POST['Psw'],PASSWORD_DEFAULT);
    $Email = $_POST['email'];
    $Role = $_POST['Role'];
    if(empty($Name) || empty($LastName) || empty($Username) || empty($Password) || empty($Email) || empty($Role))
    {
        echo"<script>alert('If you wish to update user information you will need to fill in all the fields!');<script>";
    }
    else
    {
        $dr->EditUser($Name,$LastName,$Email,$Username,$Password,$Role,$user,$userID);
        header("location:dashboard.php");
    }
}

?>