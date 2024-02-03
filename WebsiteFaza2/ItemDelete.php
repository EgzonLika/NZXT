<?php
    include_once 'DashboardRepository.php';
    include_once 'Database.php';

    $Item = $_GET['id'];

    $dr = new DashboardRepository;
    try{
        $dr->deleteItem($Item);
    }
    catch(PDOException)
    {
        header("location:dashboard.php");
    }
    header("location:dashboard.php");
?>