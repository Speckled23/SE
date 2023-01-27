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
        $tenants->code = htmlentities($_POST['code']);
        $tenants->description = htmlentities($_POST['description']);
        $tenants->years = $_POST['years'];
        $tenants->level = $_POST['level'];
        $tenants->cet = htmlentities($_POST['cet']);
        $tenants->status = 'Not Set';
        if(isset($_POST['status'])){
            $tenants->status = $_POST['status'];
        }
        if(validate_add_tenants($_POST)){
            if($tenants->f()){
                //redirect user to program page after saving
                header('location: tenants.php');
            }
        }
    }
    else{
        if ($tenants->fetch($_GET['id'])){
            $data = $tenants->fetch($_GET['id']);
            $tenants->id = $data['id'];
            $tenants->code = $data['code'];
            $tenants->description = $data['description'];
            $tenants->years = $data['years'];
            $tenants->level = $data['level'];
            $tenants->cet = $data['cet'];
            $tenants->status = $data['status'];
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

        <label for="zip">Gender</label><br>
        <input type="radio" id="gender" name="male" value="male">
        <label for="male">Male</label>
        <input type="radio" id="gender" name="female" value="female">
        <label for="female">Female</label><br>
     </form><!-- this is the end of the form -->

     <div class = "table-heading">
        <h3 class="table-title">Other Occupant </h3>
    </div>

    <label for="occupants">Zip</label>
    <input type="text" id="occupants" name="occupants"  value="<?php if(isset($_POST['occupants'])) { echo $_POST['occupants']; } ?>" ><br>


    <div class = "table-heading">
        <h3 class="table-title">Co applicant details </h3>
        <input type="button" onclick="alert('Primary selected')" value="+ Set as Primary">
    </div>

    <label for="co_fname">Zip</label>
    <input type="text" id="fname" name="co_fname"  value="<?php if(isset($_POST['co_fname'])) { echo $_POST['co_fname']; } ?>" ><br>

    <label for="co_lname">Zip</label>
    <input type="text" id="co_lname" name="co_lname"  value="<?php if(isset($_POST['co_lname'])) { echo $_POST['co_lname']; } ?>" ><br>

    <label for="co_email">Zip</label>
    <input type="email" id="co_email" name="co_email"  value="<?php if(isset($_POST['co_email'])) { echo $_POST['co_email']; } ?>" ><br>

    <label for="co_num">Zip</label>
    <input type="number" id="co_num" name="co_num"  value="<?php if(isset($_POST['co_num'])) { echo $_POST['co_num']; } ?>" ><br>

    <div class = "table-heading">
        <h3 class="table-title">Emergency Contact Details </h3>
    </div>

    <label for="emergency_fname">Zip</label>
    <input type="text" id="emergency_fname" name="emergency_fname"  value="<?php if(isset($_POST['emergency_fname'])) { echo $_POST['emergency_fname']; } ?>" ><br>

    <label for="emergency_num">Zip</label>
    <input type="number" id="emergency_num" name="emergency_num"  value="<?php if(isset($_POST['emergency_num'])) { echo $_POST['emergency_num']; } ?>" ><br>


    </div>
</div>

<?php
    //require_once '../includes/bottomnav.php';
    require_once '../includes/footer.php';
?>