
<?php

require_once '../classes/landlords.class.php';

//resume session here to fetch session values
session_start();
/*
    if user is not login then redirect to login page,
    this is to prevent users from accessing pages that requires
    authentication such as the dashboard
*/
if (!isset($_SESSION['logged-in'])){
    header('location: ../login/login.php');
}
//if the above code is false then code and html below will be executed
$landlord = new Landlord;
if(isset($_GET['id'])){
    if($landlord->landlord_delete($_GET['id'])){
        //redirect user to tenant page after saving
        header('location: landlords.php');
    }
}
?>