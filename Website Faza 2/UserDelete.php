<?php
    include_once 'DashboardRepository.php';
    include_once 'Database.php';

    $user = $_GET['id'];

    $dr = new DashboardRepository;
    try{
    $dr->deleteUser($user);
    }
    catch(PDOException)
    {
        header("location:dashboard.php");
    }
    header("location:dashboard.php");

?>