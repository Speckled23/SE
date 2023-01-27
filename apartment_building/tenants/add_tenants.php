<?php

   // require_once '../tools/functions.php';
    require_once '../classes/tenants.class.php';
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

        $tenants = new Tenants;
        //sanitize user inputs
        $tenants->firstname = htmlentities($_POST['firstname']);
        $tenants->lastname = htmlentities($_POST['lastname']);
        $tenants->email = htmlentities($_POST['email']);
        $tenants->contact_num = $_POST['contact_num'];
        $tenants->relationship = $_POST['relationship'];
        $tenants->household_type = htmlentities($_POST['household_type']);
        $tenants->prev_address = htmlentities($_POST['prev_address']);
        $tenants->city = $_POST['city'];
        //$tenants->state = $_POST['level'];
        $tenants->zip = $_POST['zip'];
        $tenants->gender = 'Not Set';
        $tenants->birthdate = $_POST['birthdate'];
        $tenants->pet = $_POST['pet'];
        $tenants->pet_num = $_POST['pet_num'];
        $tenants->pet_type = $_POST['pet_type'];
        $tenants->smoking = $_POST['cesmokingt'];
        $tenants->vehicles = $_POST['vehicles'];
        $tenants->occupants = $_POST['occupants'];
        $tenants->pri = 'not p q';
        $tenants->co_fname = $_POST['co_fname'];
        $tenants->co_lname = $_POST['co_lname'];
        $tenants->co_email = $_POST['co_email'];
        $tenants->co_num = $_POST['co_num'];
        $tenants->vehicles = $_POST['vehicles'];
        $tenants->emergency_fname = $_POST['emergency_fname'];
        $tenants->emergency_num = $_POST['emergency_num'];

        if(isset($_POST['status'])){
            $tenants->status = $_POST['status'];
        }
        if(validate_add_tenants($_POST)){
            if($tenants->add()){
                //redirect user to program page after saving
                header('location: tenants.php');
            }
        }
    }

    $page_title = 'Admin | Add Tenant';
    $tenants = 'active';

    require_once '../includes/header.php';
    require_once '../includes/sidebar.php';
    require_once '../includes/topnav.php';

?>
<div class="home-content">
    <div class = "table-heading">
        <h3 class="table-title">Tenant/Applicant Details</h3>
        <a href="tenants.php" class ='bx bx-caret-left'>Back</a>
    </div>
    <div class ="add-tenant-container">
    <form class="add-form" action="addprogram.php" method="post"><!-- this is the start of the form -->
        <label for="firstname">First Name</label>
        <input type="text" id="firstname" name="firstname"  value="<?php if(isset($_POST['firstname'])) { echo $_POST['firstname']; } ?>" required =""><br>

        <label for="lastname">First Name</label>
        <input type="text" id="lastname" name="lastname"  value="<?php if(isset($_POST['lastname'])) { echo $_POST['lastname']; } ?>" required =""><br>

        <label for="email">Email</label>
        <input type="email" id="email" name="email"  value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>" required =""><br>

        <label for="contact_num">Contact No.</label>
        <input type="number" id="contact_num" name="contact_num"  value="<?php if(isset($_POST['contact_num'])) { echo $_POST['contact_num']; } ?>" required =""><br>

        <!--  -->
        <label for="rel_status">Relationship Status</label>
        <input type="text" id="rel_status" name="rel_status"  value="<?php if(isset($_POST['rel_status'])) { echo $_POST['rel_status']; } ?>" required =""><br>

        <label for="household_type">Type of Household</label>
        <input type="text" id="household_type" name="household_type"  value="<?php if(isset($_POST['household_type'])) { echo $_POST['household_type']; } ?>" required =""><br>

        <label for="prev_add">Previous Address</label>
        <input type="text" id="prev_add" name="prev_add"  value="<?php if(isset($_POST['prev_add'])) { echo $_POST['prev_add']; } ?>" required =""><br>

        <label for="contact_num">Contact No.</label>
        <input type="number" id="contact_num" name="contact_num"  value="<?php if(isset($_POST['contact_num'])) { echo $_POST['contact_num']; } ?>" required =""><br>

        <?php 
		$obj = new MyClass();
		$row = $obj->getData("select city from city"); 
        ?>
        <select>
            <?php foreach($row as $row){ ?>
                <option><?php echo $row['city'] ?></option>

        <?php  } ?>

        <label for="state">State</label>
        <input type="text" id="state" name="state" placeholder = "State" value="<?php if(isset($_POST['state'])) { echo $_POST['state']; } ?>" required =""><br>

        <label for="zip">Zip</label>
        <input type="number" id="zip" name="zip"  value="<?php if(isset($_POST['zip'])) { echo $_POST['zip']; } ?>" required =""><br>

        <label for="gender">Gender</label><br>
        <input type="radio" id="gender" name="male" value="male">
        <label for="male">Male</label>
        <input type="radio" id="gender" name="female" value="female">
        <label for="female">Female</label><br>

        <label for="pet">Do tenant own a pet?</label><br>
        <input type="radio" id="pet" name="yes" value="yes">
        <label for="yes">Yes</label>
        <input type="radio" id="pet" name="no" value="no">
        <label for="no">No</label><br>
        
        <label for="pet_num">No. of pet</label>
        <input type="number" id="pet_num" name="pet_num"  value="<?php if(isset($_POST['pet_num'])) { echo $_POST['pet_num']; } ?>"><br>
        
        <label for="pet_type">Type</label>
        <input type="text" id="pet_type" name="pet_type"  value="<?php if(isset($_POST['pet_type'])) { echo $_POST['pet_num']; } ?>"><br>

        <label for="smoking">Do tenant smoke?</label><br>
        <input type="radio" id="smoking" name="smoke" value="smoke">
        <label for="smoke">Yes</label>
        <input type="radio" id="smoking" name="not" value="not">
        <label for="not">No</label><br>
        
        
        <label for="vehicle">Please check if tenant own any of the vehicles:</label><br>

        <input type="checkbox" id = 'vehicle1' value ='car'>
        <label for='vehicle1'>Car</label><br>

        <input type="checkbox" id = 'vehicle2' value ='motorcyle'>
        <label for='vehicle2'>Motorcycle</label><br>

        <input type="checkbox" id = 'vehicle3' value ='other'>
        <label for='vehicle3'>Other</label><br>
        
        <label for='vehicle3'>If other, please specify:</label>
        <input type='text' id = 'vehicle3' >

     </form><!-- this is the end of the form -->

     <div class = "table-heading">
        <h3 class="table-title">Other Occupant </h3>
    </div>

    <label for="occupants"></label>
    <input type="text" id="occupants" name="occupants"  value="<?php if(isset($_POST['occupants'])) { echo $_POST['occupants']; } ?>" ><br>


    <div class = "table-heading">
        <h3 class="table-title">Co applicant details </h3>
        <input type="button" onclick="alert('Primary selected')" value="+ Set as Primary">
    </div>

    <label for="co_fname">First Name</label>
    <input type="text" id="fname" name="co_fname"  value="<?php if(isset($_POST['co_fname'])) { echo $_POST['co_fname']; } ?>" ><br>

    <label for="co_lname">Last Name</label>
    <input type="text" id="co_lname" name="co_lname"  value="<?php if(isset($_POST['co_lname'])) { echo $_POST['co_lname']; } ?>" ><br>

    <label for="co_email">Email</label>
    <input type="email" id="co_email" name="co_email"  value="<?php if(isset($_POST['co_email'])) { echo $_POST['co_email']; } ?>" ><br>

    <label for="co_num">Contact No.</label>
    <input type="number" id="co_num" name="co_num"  value="<?php if(isset($_POST['co_num'])) { echo $_POST['co_num']; } ?>" ><br>

    <div class = "table-heading">
        <h3 class="table-title">Emergency Contact Details </h3>
    </div>

    <label for="emergency_fname">Full Name</label>
    <input type="text" id="emergency_fname" name="emergency_fname"  value="<?php if(isset($_POST['emergency_fname'])) { echo $_POST['emergency_fname']; } ?>" ><br>

    <label for="emergency_num">Contact No.</label>
    <input type="number" id="emergency_num" name="emergency_num"  value="<?php if(isset($_POST['emergency_num'])) { echo $_POST['emergency_num']; } ?>" ><br>

    <input type="submit" class="button" value="Save Tenant" name="save" id="save">
    </div>
</div>

<?php
    //require_once '../includes/bottomnav.php';
    require_once '../includes/footer.php';
?>