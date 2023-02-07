<?php

    require_once '../tools/functions.php';
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
        $tenants->first_name = htmlentities($_POST['first_name']);
        $tenants->last_name = htmlentities($_POST['last_name']);
        $tenants->email = htmlentities($_POST['email']);
        $tenants->contact_no = $_POST['contact_no'];
        $tenants->relationship_status = $_POST['relationship_status'];
        $tenants->type_of_household = htmlentities($_POST['type_of_household']);
        $tenants->previous_address = htmlentities($_POST['previous_address']);
        $tenants->city = $_POST['city'];
        $tenants->provinces = $_POST['provinces'];
        $tenants->zip_code = $_POST['zip_code'];
        $tenants->sex = $_POST['sex'];
        $tenants->date_of_birth = $_POST['date_of_birth'];
        $tenants->has_pet = $_POST['has_pet'];
        $tenants->number_of_pets = $_POST['number_of_pets'];
        $tenants->type_of_pet = $_POST['type_of_pet'];
        $tenants->is_smoking = $_POST['is_smoking'];
        $tenants->has_vehicle= $_POST['has_vehicle'];
        $tenants->vehicle_specification= $_POST['vehicle_specification'];
        $tenants->occupants = $_POST['occupants'];
        $tenants->co_applicant_first_name = $_POST['co_applicant_first_name'];
        $tenants->co_applicant_last_name = $_POST['co_applicant_last_name'];
        $tenants->co_applicant_email = $_POST['co_applicant_email'];
        $tenants->co_applicant_contact_no = $_POST['co_applicant_contact_no'];
        $tenants->emergency_contact_person = $_POST['emergency_contact_person'];
        $tenants->emergency_contact_number = $_POST['emergency_contact_number'];
        $tenants->status = $_POST['status'];

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

?>
<div class="home-section">
    <div class = "table-heading">
        <h3 class="table-title">Tenant/Applicant Details</h3>
        <a href="tenants.php" class ='bx bx-caret-left'>Back</a>
    </div>
    <div class ="add-tenant-container">
    <form action="add_tenants.php" method="post">
  <div>
    <label for="first_name">First Name</label>
    <input type="text" id="first_name" name="first_name" value="<?php if(isset($_POST['first_name'])) { echo $_POST['first_name']; } ?>" required ="">
    <?php
                        if(isset($_POST['save']) && !validate_first_name($_POST)){
                    ?>
                                <p class="error">First name is invalid. Trailing spaces will be ignored.</p>
                    <?php
                        }
                    ?>
</div>
  <div>
    <label for="last_name">Last Name</label>
    <input type="text" id="last_name" name="last_name" value="<?php if(isset($_POST['last_name'])) { echo $_POST['last_name']; } ?>" required ="">
    <?php
                        if(isset($_POST['save']) && !validate_last_name($_POST)){
                    ?>
                                <p class="error">Last name is invalid. Trailing spaces will be ignored.</p>
                    <?php
                        }
                    ?>
</div>
  <div>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>" required ="">
    <?php
                        if(isset($_POST['save']) && !validate_email($_POST)){
                    ?>
                                <p class="error">Email is invalid. Use only @admin.ph</p>
                    <?php
                        }
                    ?>
</div>
  <div>
    <label for="contact_no">Contact Number</label>
    <input type="text" id="contact_no" name="contact_no" value="<?php if(isset($_POST['contact_no'])) { echo $_POST['contact_no']; } ?>" required ="">
  </div>
  <div>
    <label for="relationship_status">Relationship Status</label>
    <select id="relationship_status" name="relationship_status" required>
      <option value="None" <?php if(isset($_POST['relationship_status'])) { if ($_POST['relationship_status'] == 'None') echo ' selected="selected"'; } ?>>--Select--</option>
      <option value="single" <?php if(isset($_POST['relationship_status'])) { if ($_POST['relationship_status'] == 'single') echo ' selected="selected"'; } ?>>Single</option>
      <option value="in a relationship" <?php if(isset($_POST['relationship_status'])) { if ($_POST['relationship_status'] == 'in a relationship') echo ' selected="selected"'; } ?>>In a relationship</option>
      <option value="married" <?php if(isset($_POST['relationship_status'])) { if ($_POST['relationship_status'] == 'married') echo ' selected="selected"'; } ?>>Married</option>
    </select>
  </div>
  <div>
    <label for="type_of_household">Type of Household</label>
    <select id="type_of_household" name="type_of_household" required>
    <option value="None" <?php if(isset($_POST['type_of_household'])) { if ($_POST['type_of_household'] == 'None') echo ' selected="selected"'; } ?>>--Select--</option>
      <option value="one person" <?php if(isset($_POST['type_of_household'])) { if ($_POST['type_of_household'] == 'one person') echo ' selected="selected"'; } ?>>One Person</option>
      <option value="couple" <?php if(isset($_POST['type_of_household'])) { if ($_POST['type_of_household'] == 'couple') echo ' selected="selected"'; } ?>>Couple</option>
      <option value="single parent" <?php if(isset($_POST['type_of_household'])) { if ($_POST['type_of_household'] == 'single parent') echo ' selected="selected"'; } ?>>Single Parent</option>
      <option value="family" <?php if(isset($_POST['type_of_household'])) { if ($_POST['type_of_household'] == 'family') echo ' selected="selected"'; } ?>>Family</option>
      <option value="extended family" <?php if(isset($_POST['type_of_household'])) { if ($_POST['type_of_household'] == 'extended family') echo ' selected="selected"'; } ?>>Extended Family</option>
    </select>
  </div>
  <div>
    <label for="previous_address">Previous Address</label>
    <input type="text" id="previous_address" name="previous_address" value="<?php if(isset($_POST['previous_address'])) { echo $_POST['previous_address']; } ?>" required ="">
  </div>
  <div>
    <label for="city">City</label>
    <input type="text" id="city" name="city" value="<?php if(isset($_POST['city'])) { echo $_POST['city']; } ?>" required ="">
  </div>
  <div>
    <label for="provinces">Province</label>
    <input type="text" id="provinces" name="provinces" value="<?php if(isset($_POST['provinces'])) { echo $_POST['provinces']; } ?>" required ="">
  </div>
  <div>
    <label for="zip_code">Zip Code</label>
    <input type="text" id="zip_code" name="zip_code" value="<?php if(isset($_POST['zip_code'])) { echo $_POST['zip_code']; } ?>" required ="">
  </div>
  <div>
    <label for="sex">Sex</label>
    <input type="radio" id="male" name="sex" value="Male" <?php if(isset($_POST['sex'])) { if ($_POST['sex'] == 'Male') echo ' checked'; } ?>>
    <label for="male">Male</label>
    <input type="radio" id="female" name="sex" value="Female" <?php if(isset($_POST['sex'])) { if ($_POST['sex'] == 'Female') echo ' checked'; } ?>>
    <label for="female">Female</label>
    <br>
  </div>
  <div>

  <div>
    <label for="date_of_birth">Date of Birth</label>
    <input type="date" id="date_of_birth" name="date_of_birth" value="<?php if(isset($_POST['date_of_birth'])) { echo $_POST['date_of_birth']; } ?>" required ="">
  </div>
  <div>
    <label for="has_pet">Do Tenant own a pet?</label>
    <input type="radio" id="has_pet" name="has_pet" value="yes"<?php if(isset($_POST['has_pet'])) { if ($_POST['has_pet'] == 'yes') echo ' checked'; } ?>>
    <label for="yes">Yes</label>
     <input type="radio" id="has_pet" name="has_pet" value="no" <?php if(isset($_POST['has_pet'])) { if ($_POST['has_pet'] == 'no') echo ' checked'; } ?>>
    <label for="no">No</label>
  <br>
  </div>
  <div>
    <label for="number_of_pets">No of Pets</label>
    <input type="number" name="number_of_pets" value="<?php if(isset($_POST['number_of_pets'])) { echo $_POST['number_of_pets']; } ?>" required ="">
  </div>

    <label for="type_of_pet">Pet Type:</label>
  <input type="text" id="type_of_pet" name="type_of_pet" value="<?php if(isset($_POST['type_of_pet'])) { echo $_POST['type_of_pet']; } ?>" required ="">
<div>
  <label for="is_smoking">Do Tenant Smoke?</label>
  <input type="radio" id="is_smoking" name="is_smoking" value="yes" <?php if(isset($_POST['is_smoking'])) { if ($_POST['is_smoking'] == 'yes') echo ' checked'; } ?>>
    <label for="yes">Yes</label>
     <input type="radio" id="is_smoking" name="is_smoking" value="no"  <?php if(isset($_POST['is_smoking'])) { if ($_POST['is_smoking'] == 'no') echo ' checked'; } ?>>
    <label for="no">No</label>
  <br>
</div>
<div>
<label for="has_vehicle">Please check if tenant own any of the vehicles:</label><br>
        <input type="checkbox" name="vehicle_type[]" value="car">Car<br>
        <input type="checkbox" name="vehicle_type[]" value="motorcycle">Motorcycle<br>
        <input type="checkbox" name="vehicle_type[]" value="others">Others<br>
        <input type="text" name="other_vehicle_type" placeholder="Enter other vehicle type" style="display:none;" value="<?php if(isset($_POST['vehicle_specification'])) { echo $_POST['vehicle_specification']; } ?>" required =""><br>
</div>

<div>
<h3 class="table-title">Co-Applicant Details</h3>
  <input type="hidden" id="status" name="status" value="Primary">
  <button type="button" id="set_to_primary">Set to Primary</button>
<div>
  <label for="co_fname">First Name</label>
  <input type="text" id="co_fname" name="co_fname" value="<?php if(isset($_POST['co_fname'])) { echo $_POST['co_fname']; } ?>" required ="">
  
  <label for="co_lname">Last Name</label>
  <input type="text" id="co_lname" name="co_lname" value="<?php if(isset($_POST['co_fname'])) { echo $_POST['co_fname']; } ?>" required ="">
</div>
<div>
  <label for="co_email">Email</label>
  <input type="email" id="co_email" name="co_email" value="<?php if(isset($_POST['co_lname'])) { echo $_POST['co_lname']; } ?>" required ="">
  
  <label for="co_num">Contact Number</label>
  <input type="text" id="co_num" name="co_num" value="<?php if(isset($_POST['co_num'])) { echo $_POST['co_num']; } ?>" required ="">
</div>
<div>
<h3 class="table-title">Emergency Contact Person Details</h3>
  <label for="emergency_fname">Full Name:</label>
  <input type="text" id="emergency_fname" name="emergency_fname" value="<?php if(isset($_POST['emergency_fname'])) { echo $_POST['emergency_fname']; } ?>" required ="">
  
  <label for="emergency_num">Contact Number:</label>
  <input type="text" id="emergency_num" name="emergency_num" value="<?php if(isset($_POST['emergency_num'])) { echo $_POST['emergency_num']; } ?>" required ="">
</div>
  <input type="submit" class="button" value="Save Tenant" name="save" id="save">

</form>
</div>

<?php
    //require_once '../includes/bottomnav.php';
    require_once '../includes/footer.php';
?>

<script>

document.getElementById("set_to_primary").addEventListener("click", function(){
  document.getElementById("status").value = "Primary";
});

  // Script to show/hide "other_vehicle_type" input field
  var vehicleTypeCheckboxes = document.querySelectorAll('input[name="vehicle_type[]"]');
  var otherVehicleTypeInput = document.querySelector('input[name="other_vehicle_type"]');

  vehicleTypeCheckboxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
      if (checkbox.value === 'others' && checkbox.checked) {
        otherVehicleTypeInput.style.display = 'block';
      } else {
        otherVehicleTypeInput.style.display = 'none';
      }
    });
  });
</script>