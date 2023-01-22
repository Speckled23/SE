<?php
    
    //this is where the page starts

    //start session
    session_start();

    //check if user is login already otherwise send to login page
    if (isset($_SESSION['role']) == 'admin'){
        header('location: admin/dashboard.php');
    }
    if (isset($_SESSION['role']) == 'landlord'){
        header('location: landlord/landlord.php');
    }
    if (isset($_SESSION['role']) == 'tenant'){
        header('location: tenant/tenant.php');
    }

    else{
        header('location: login/login.php');
    }

?>