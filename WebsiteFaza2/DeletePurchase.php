<?php
    include_once 'DashboardRepository.php';
    include_once 'Database.php';

    $purchase = $_GET['id'];

    $dr = new DashboardRepository;

    $dr->deletePurchase($purchase);

    header("location:dashboard.php");
?>