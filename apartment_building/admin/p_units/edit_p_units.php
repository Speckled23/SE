<?php

   // require_once '../tools/functions.php';
    require_once '../classes/p_units.classes.php';
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
    $p_units = new P_units;
    //if add tenants is submitted
    if(isset($_POST['save'])){

        //sanitize user inputs
        $p_units->$id = $_POST['id'];
        $p_units->unit_name = htmlentities($_POST['unit_name']);
        $p_units->main_property = htmlentities($_POST['main_property']);
        $p_units->type = $_POST['type'];
        $p_units->description_p = $_POST['description'];
        $p_units->rent = $_POST['rent'];
        $p_units->unit_condition = $_POST['unit_condition'];

        if(validate_add_p_units($_POST)){
            if($p_units->add()){
                //redirect user to program page after saving
                header('location: p_units.php');
            }
        }
    }else{
        if($p_units->fetch($_GET['id'])){

            $data = $p_units->fetch($_GET['id']);
            $p_units->unit_name = $data['unit_name'];
            $p_units->main_property = $data['main_property'];
            $p_units->type = $data['type'];
            $p_units->description_p = $data['description'];
            $p_units->rent = $data['rent'];
            $p_units->unit_condition = $data['unit_condition'];

        }
    }

    $page_title = 'Admin | Add Property Units';
    $landlord = 'active';

    require_once '../includes/header.php';
    require_once '../includes/sidebar.php';
    require_once '../includes/topnav.php';

?>
<div class="home-content">
    <div class = "table-heading">
        <h3 class="table-title">Property Details</h3>
        <a href="p_units.php" class ='bx bx-caret-left'>Back</a>
    </div>
    <div class ="add-tenant-container">
    <form class="add-form" action="addprogram.php" method="post"><!-- this is the start of the form -->
        <label for="unit_name">Property Unit unit_name</label>
        <input type="text" id="unit_name" name="unit_name"  value="<?php if(isset($_POST['unit_name'])) { echo $_POST['unit_name']; } ?>" required =""><br>

        <label for="main_property">Select Main Property</label>
        <input type="text" id="main_property" name="main_property"  value="<?php if(isset($_POST['main_property'])) { echo $_POST['main_property']; } ?>" required =""><br>

        <label for="type">Select Type of Unit</label>
        <input type="text" id="type" name="type"  value="<?php if(isset($_POST['type'])) { echo $_POST['type']; } ?>" required =""><br>

        <label for="description">Description</label>
        <input type="text" id="description" name="description"  value="<?php if(isset($_POST['description'])) { echo $_POST['description']; } ?>" ><br>

        <label for="rent">Monthly Rent Amount</label>
        <input type="number" id="rent" name="rent"  value="<?php if(isset($_POST['rent'])) { echo $_POST['rent']; } ?>" required =""><br>

        <label for="unit_condition">Select Unit Condition</label>
        <input type="text" id="unit_condition" name="unit_condition"  value="<?php if(isset($_POST['unit_condition'])) { echo $_POST['unit_condition']; } ?>" required =""><br>

        <input type="submit" class="button" value="Save Property" name="save" id="save">
        </div>
</div>

<?php
    //require_once '../includes/bottomnav.php';
    require_once '../includes/footer.php';
?>