<?php
    include_once 'DashboardRepository.php';
    include_once 'Database.php';

    $Contact = $_GET['id'];

    $dr = new DashboardRepository;

    $dr->DeleteContact($Contact);

    header("location:dashboard.php");
?>