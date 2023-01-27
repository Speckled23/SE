<?php

   // require_once '../tools/functions.php';
    require_once '../classes/properties.classes.php';
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

        $property = new Property;
        //sanitize user inputs
        $property->firstname = htmlentities($_POST['firstname']);
        $property->lastname = htmlentities($_POST['lastname']);
        $property->email = htmlentities($_POST['email']);
        $property->contact_num = $_POST['contact_num'];
        $property->address = $_POST['address'];
        $property->city = $_POST['city'];
        $property->state = $_POST['state'];
        $property->zip = $_POST['zip'];
        $property->id_doc = $_POST['id_doc'];
        $property->fname = $_POST['fname'];
        $property->emergency_num = $_POST['emergency_num'];

        if(validate_add_landlord($_POST)){
            if($property->add()){
                //redirect user to program page after saving
                header('location: tenants.php');
            }
        }
    }

    $page_title = 'Admin | Add Property';
    $landlord = 'active';

    require_once '../includes/header.php';
    require_once '../includes/sidebar.php';
    require_once '../includes/topnav.php';

?>
<div class="home-content">
    <div class = "table-heading">
        <h3 class="table-title">Property Details</h3>
        <a href="properties.php" class ='bx bx-caret-left'>Back</a>
    </div>
    <div class ="add-tenant-container">
    <form class="add-form" action="addprogram.php" method="post"><!-- this is the start of the form -->
        <label for="name">Property Name</label>
        <input type="text" id="name" name="name"  value="<?php if(isset($_POST['name'])) { echo $_POST['name']; } ?>" required =""><br>

        <label for="landlord_id">Landlord Name</label>
        <input type="text" id="landlord_id" name="landlord_id"  value="<?php if(isset($_POST['landlord_id'])) { echo $_POST['landlord_id']; } ?>" required =""><br>

        <label for="address">Address</label>
        <input type="email" id="address" name="address"  value="<?php if(isset($_POST['address'])) { echo $_POST['address']; } ?>" required =""><br>

        <label for="address">Address</label>
        <input type="text" id="address" name="address"  value="<?php if(isset($_POST['address'])) { echo $_POST['address']; } ?>" required =""><br>

        <label for="city">City</label>
        <?php 
		$obj = new MyClass();
		$row = $obj->getData("select city from city"); 
        ?>
        <select>
            <?php foreach($row as $row){ ?>
                <option><?php echo $row['city'] ?></option>

        <?php  }  ?>

        <label for="state">C</label>
        <input type="text" id="state" name="state" placeholder = "Country" value="<?php if(isset($_POST['state'])) { echo $_POST['state']; } ?>" required =""><br>

        <label for="zip">Zip</label>
        <input type="number" id="zip" name="zip"  value="<?php if(isset($_POST['zip'])) { echo $_POST['zip']; } ?>" required =""><br>

        <label for="description">Description</label>
        <input type="text" id="fname" name="fname"  value="<?php if(isset($_POST['fname'])) { echo $_POST['fname']; } ?>" ><br>

        <label for="emergency_num">Contact No.</label>
        <input type="number" id="emergency_num" name="emergency_num"  value="<?php if(isset($_POST['emergency_num'])) { echo $_POST['emergency_num']; } ?>" ><br>

        <input type="submit" class="button" value="Save Property" name="save" id="save">
        </div>
</div>

<?php
    //require_once '../includes/bottomnav.php';
    require_once '../includes/footer.php';
?>