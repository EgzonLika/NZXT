<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="LogInStyles\LogInStyle.css">
</head>
<body>
        <div class="Text">
            <img src="LogInStyles\NZXT Logo.png" alt="LOGO">
            <h1>BECOME A MEMBER AND START UPGRADING YOUR PC!</h1>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <div class="Log-In">
            <img height="100" src="LogInStyles\LOGOS-removebg-preview.png" alt="LOGO" style="margin:35px;">
            <input id="Name" class="Input" name="Name" type="text" placeholder="Name">
            <div class=" js-NoName" style="color:red"></div>
            <input id="LastName" class="Input" name="LastName" type="text" placeholder="Last Name">
            <div class="js-NoLastName" style="color:red"></div>
            <input id="Username" class="Input" name="username" type="text" placeholder="Username">
            <div class="js-NoUsername" style="color:red"></div>
            <input id="Email" class="Input" name="email" type="email" placeholder="Email">
            <div class="js-NoEmail" style="color:red"></div>
            <input id="Psw" class="Input" name="Psw" type="password" placeholder="Password">
            <div class="js-NoPsw" style="color:red"></div>
            <input type="submit" class="Log-In-Button" name="Log-In-Btn" value="Register"></button>
            <p style="margin-top:0px;margin-bottom:30px">Already have an account? <a href="LogIn.php">Log In</a></p>
        </div>
        </form>
</body>
</html>
<?php
    include_once 'UserRepository.php';
    include_once 'Users.php';

    if(isset($_POST['Log-In-Btn']))
    {
        $emailRegex = '/^[A-Za-z0-9._%+-]+@[a-z-]+\.[a-z]{2,}$/';
        $name = $_POST['Name'];
        $LastName = $_POST['LastName'];
        $email = $_POST['email'];
        $Username = $_POST['username'];
        $psw =password_hash($_POST['Psw'],PASSWORD_DEFAULT);
        $id = rand(100,999);
        $cart = rand(100,999);
        $role = 'User';

        if (empty($name)) {
            echo "<script>document.querySelector('.js-NoName').innerHTML = 'Please Insert Name!';</script>";
        }
        else if (empty($LastName)) {
            echo "<script>document.querySelector('.js-NoLastName').innerHTML = 'Please Insert Surname!';</script>";
        }
        else if (empty($email) || !preg_match($emailRegex,$email)) {
            echo "<script>document.querySelector('.js-NoEmail').innerHTML = 'Please Insert Email!';</script>";
        }
        else if (empty($Username)) {
            echo "<script>document.querySelector('.js-NoUsername').innerHTML = 'Please Insert Username!';</script>";
        }
        else if (empty($psw)) {
            echo "<script>document.querySelector('.js-NoPsw').innerHTML = 'Please Insert Password!';</script>";
        }
        else
        {    
            try{
            $user = new User($id,$name,$LastName,$email,$Username,$psw,$role,$cart);
            $UserRepository = new UserRepository();
            $UserRepository->insertUser($user);
            if(isset($_SESSION['Role'])==='Admin')
            {
                header("location:dashboard.php");
            }
            header("location:LogIn.php");
            }
            catch(PDOException $e)
            {
                echo"<script>document.querySelector('.js-NoPsw').innerHTML = 'This Gmail/Username already exists!';</script>";
            }
        }
    }
?>