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
            <input id="Username" class="Input" name="username" type="text" placeholder="Username">
            <div class="js-NoUsername" style="color:red"></div>
            <input id="Psw" class="Input" name="Psw" type="password" placeholder="Password">
            <div class="js-NoPsw" style="color:red"></div>
            <input type="submit" class="Log-In-Button" name="Log-In-Btn" value="Log In"></button>
            <p style="margin-top:0px;margin-bottom:30px">Don't have an account? <a href="Register.php">Sign Up</a></p>
        </div>
        </form>
</body>
</html>
<?php
    include_once 'UserRepository.php';
    include_once 'Users.php';

    if(isset($_POST['Log-In-Btn']))
    {
        $Username = $_POST['username'];
        $psw =  $_POST['Psw'];

        if (empty($Username)) {
            echo "<script>document.querySelector('.js-NoUsername').innerHTML = 'Please Insert Username!';</script>";
        }
        else if (empty($psw)) {
            echo "<script>document.querySelector('.js-NoPsw').innerHTML = 'Please Insert Password!';</script>";
        }
        else
        { 
            $userRepository = new UserRepository();
            $user = $userRepository->validateUser($Username);

            if($user && password_verify($psw,$user['Password']))
            {
                session_start();

                $_SESSION['username'] = $Username;
                $_SESSION['password'] = $psw;
                $_SESSION['Role'] = $user['Role'];
                $_SESSION['loginTime'] = date("H:i:s");
                if($_SESSION['Role'] === 'Admin')
                {
                    header("location:index.php");
                    exit();
                }
                else{
                    header("location:index.php");
                    exit();
                }
            }
            else
            {
                echo "<script>document.querySelector('.js-NoPsw').innerHTML = 'Incorrect Username or Password';</script>";
                exit();
            }
        }
    }
?>