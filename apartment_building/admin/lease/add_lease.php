<?php

   // require_once '../tools/functions.php';
    require_once '../classes/lease.class.php';
    require_once '../classes/address.php';

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

    //if add tenants is submitted
    if(isset($_POST['save'])){

        $lease = new Lease;
        //sanitize user inputs
        $lease->p_unit_id = htmlentities($_POST['p_unit_id']);
        $lease->tenants_id = htmlentities($_POST['tenants_id']);
        $lease->type = $_POST['type'];
        $lease->description_p = $_POST['rent'];
        $lease->rent = $_POST['rent'];
        $lease->unit_condition = $_POST['unit_condition'];

        if(validate_add_p_units($_POST)){
            if($lease->add()){
                //redirect user to program page after saving
                header('location: lease.php');
            }
        }
    }

    $page_title = 'Admin | Add Lease';
    $landlord = 'active';

    require_once '../includes/header.php';
    require_once '../includes/sidebar.php';
    require_once '../includes/topnav.php';

?>
<div class='home-content'>
    <div class = 'table-heading'>
        <h3 class='table-title'>Create Lease</h3>
        <a href='lease.php' class ='bx bx-caret-left'>Back</a>
    </div>
    <div class ='add-lease-container'>

    <form class='add-form' action='addprogram.php' method='post'><!-- this is the start of the form -->

        <label for='p_unit_id'>Property Unit Name</label>
        <input type='text' id='p_unit_id' name='p_unit_id'  value='<?php if(isset($_POST['p_unit_id'])) { echo $_POST['p_unit_id']; } ?>' required =''><br>

        <label for='tenants_id'>Tenant Name</label>
        <input type='text' id='tenants_id' name='tenants_id'  value='<?php if(isset($_POST['tenants_id'])) { echo $_POST['tenants_id']; } ?>' required =''><br>

        <label for='startdate'>Start Date</label>
        <input type='date' id='startdate' name='startdate'  value='<?php if(isset($_POST['startdate'])) { echo $_POST['startdate']; } ?>' required =''><br>

        <label for='enddate'>End Date</label>
        <input type='date' id='enddate' name='enddate'  value='<?php if(isset($_POST['enddate'])) { echo $_POST['enddate']; } ?>' required =''><br>

        <label for='rent'>Monthly Rent</label>
        <input type='date' id='rent' name='rent'  value='<?php if(isset($_POST['rent'])) { echo $_POST['rent']; } ?>' ><br>

        <label for='deposit'>One Month Deposit</label>
        <input type='number' id='deposit' name='deposit'  value='<?php if(isset($_POST['deposit'])) { echo $_POST['deposit']; } ?>' required =''><br>

        <label for='advance'>One Month Advance</label>
        <input type='text' id='advance' name='advance'  value='<?php if(isset($_POST['advance'])) { echo $_POST['advance']; } ?>' required =''><br>

        <h3 class='table-title'>Bills</h3>

        <label for='electricity'>Electricity</label>
        <input type='number' id='electricity' name='electricity'  value='<?php if(isset($_POST['electricity'])) { echo $_POST['electricity']; } ?>' required =''><br>

        <input type='date' id='electricity' name='electricity'  value='<?php if(isset($_POST['electricity'])) { echo $_POST['electricity']; } ?>' required =''><br>

        <input type='number' id='electricity' name='electricity'  value='<?php if(isset($_POST['electricity'])) { echo $_POST['electricity']; } ?>' required =''><br>

        <input type='date' id='electricity' name='electricity'  value='<?php if(isset($_POST['electricity'])) { echo $_POST['electricity']; } ?>' required =''><br>

        <label for='water'>water</label>
        <input type='number' id='water' name='water'  value='<?php if(isset($_POST['water'])) { echo $_POST['water']; } ?>' required =''><br>


        <input type='submit' class='button' value='Save Property' name='save' id='save'>
        </div>
</div>

<?php
    //require_once '../includes/bottomnav.php';
    require_once '../includes/footer.php';
?>