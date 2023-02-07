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
        $property->name = htmlentities($_POST['name']);
        $property->landlord_id = htmlentities($_POST['landlord_id']);
        $property->address = $_POST['address'];
        $property->city = $_POST['city'];
        $property->country = $_POST['country'];
        $property->zip = $_POST['zip'];
        $property->description = $_POST['description'];
        $property->description_feature = $_POST['description_feature'];
        $property->feature = $_POST['feature'];
        $property->image = $_POST['image'];

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

        <label for="city">City</label>
        <?php
		$obj = new MyClass();
		$row = $obj->getData("Select city from city"); 
        ?>
        <select>
            <?php foreach($row as $row){ ?>
                <option><?php echo $row['city'] ?></option>

        <?php  }  ?>

        <label for="country">Country</label>
        <input type="text" id="country" name="country" placeholder = "Country" value="<?php if(isset($_POST['country'])) { echo $_POST['country']; } ?>" required =""><br>

        <label for="zip">Zip</label>
        <input type="number" id="zip" name="zip"  value="<?php if(isset($_POST['zip'])) { echo $_POST['zip']; } ?>" required =""><br>

        <label for="description">Description</label>
        <input type="text" id="fndescriptioname" name="description"  value="<?php if(isset($_POST['description'])) { echo $_POST['description']; } ?>" ><br>

        <h3 class="table-title">Property Features</h3>

        <label for="description_feature">Description Feature</label>
        <input type="text" id="description_feature" name="description_feature"  value="<?php if(isset($_POST['description_feature'])) { echo $_POST['description_feature']; } ?>" ><br>

        <label for='feature'>Check box if feature is allowed or present.</label>
        <input type='checkbox' id = 'feature' name = 'feature' value = 'Car parking'>Car parking<br>
        <input type='checkbox' id = 'feature' name = 'feature' value = 'Motorcycle parking'>Motorcycle parking<br>
        <input type='checkbox' id = 'feature' name = 'feature' value = 'Balcony'>Balcony<br>
        <input type='checkbox' id = 'feature' name = 'feature' value = 'Gym'>Gym<br>
        <input type='checkbox' id = 'feature' name = 'feature' value = 'Internet'>CarInternetparking<br>
        <input type='checkbox' id = 'feature' name = 'feature' value = 'Garden'>Garden<br>
        <input type='checkbox' id = 'feature' name = 'feature' value = 'Alarm'>Alarm<br>
        <input type='checkbox' id = 'feature' name = 'feature' value = 'Doorbell'>Doorbell<br>
        <input type='checkbox' id = 'feature' name = 'feature' value = 'Common Bathroom'>Bathroom<br>
        <input type='checkbox' id = 'feature' name = 'feature' value = 'Laundry'>Laundry<br>
        <input type='checkbox' id = 'feature' name = 'feature' value = 'Allow pets'>Allow pets<br>
        <input type='checkbox' id = 'feature' name = 'feature' value = 'Allow Smoking'>Allow Smoking<br>

        <h3 class="table-title">Property Features</h3>

        <label for="image">Property Image</label>
        <input type="file" name="image"><br>

        <input type="submit" class="button" value="Save Property" name="save" id="save">
        </div>
</div>

<?php
    //require_once '../includes/bottomnav.php';
    require_once '../includes/footer.php';
?>