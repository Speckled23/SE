<?php
    //this is where the page starts

    //start session
    session_start();

    //check if user is login already otherwise send to login page
    if (isset($_SESSION['role_type']) == 'admin'){
        header('location: admin/admin/dashboard.php');
    }
    else if (isset($_SESSION['role_type']) == 'landlord'){
        header('location: landlord/landlord.php');
    }
    else if (isset($_SESSION['role_type']) == 'tenant'){
        header('location: tenant/tenant.php');
    }
    else{
        header('location: login/login.php');
    }

?>