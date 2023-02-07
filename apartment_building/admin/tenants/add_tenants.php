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
        $tenants->firstname = htmlentities($_POST['firstname']);
        $tenants->lastname = htmlentities($_POST['lastname']);
        $tenants->email = htmlentities($_POST['email']);
        $tenants->contact_num = $_POST['contact_num'];
        $tenants->rel_status = $_POST['rel_status'];
        $tenants->household_type = ($_POST['household_type']);
        $tenants->prev_address = ($_POST['prev_address']);
        $tenants->city = $_POST['city'];
        $tenants->country = $_POST['country'];
        $tenants->zip = $_POST['zip'];
        $tenants->gender = $_POST['gender'];
        $tenants->birthdate = $_POST['birthdate'];
        $tenants->pet = $_POST['pet'];
        $tenants->pet_num = $_POST['pet_num'];
        $tenants->pet_type = $_POST['pet_type'];
        $tenants->smoking = $_POST['smoking'];
        $tenants->vehicles= $_POST['vehicles'];
        $tenants->pri = $_POST['pri'];
        $tenants->co_fname = $_POST['co_fname'];
        $tenants->co_lname = $_POST['co_lname'];
        $tenants->co_email = $_POST['co_email'];
        $tenants->co_num = $_POST['co_num'];
        $tenants->emergency_fname = $_POST['emergency_fname'];
        $tenants->emergency_num = $_POST['emergency_num'];

        if(validate_tenant($_POST)){
            if($tenants->add()){
                //redirect user to tenant page after saving
                header('location: tenants.php');
            }
        }else{
          header('location: tenants.php');
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
    <label for="firstname">First Name</label>
    <input type="text" id="firstname" name="firstname" value="<?php if(isset($_POST['firstname'])) { echo $_POST['firstname']; } ?>" required ="">
    <?php
                        if(isset($_POST['save']) && !validate_firstname($_POST)){
                    ?>
                                <p class="error">First name is invalid. Trailing spaces will be ignored.</p>
                    <?php
                        }
                    ?>
</div>
  <div>
    <label for="lastname">Last Name</label>
    <input type="text" id="lastname" name="lastname" value="<?php if(isset($_POST['lastname'])) { echo $_POST['lastname']; } ?>" required ="">
    <?php
                        if(isset($_POST['save']) && !validate_lastname($_POST)){
                    ?>
                                <p class="error">Last name is invalid. Trailing spaces will be ignored.</p>
                    <?php
                        }
                    ?>
</div>
  <div>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>" required ="">
   
</div>
  <div>
    <label for="contact_num">Contact Number</label>
    <input type="number" id="contact_num" name="contact_num" value="<?php if(isset($_POST['contact_num'])) { echo $_POST['contact_num']; } ?>" required ="">
    
  </div>

  <div>
    <label for="rel_status">Relationship Status</label>
    <select id="rel_status" name="rel_status" required>
      <option value="None" <?php if(isset($_POST['rel_status'])) { if ($_POST['rel_status'] == 'None') echo ' selected="selected"'; } ?>>--Select--</option>
      <option value="single" <?php if(isset($_POST['rel_status'])) { if ($_POST['rel_status'] == 'single') echo ' selected="selected"'; } ?>>Single</option>
      <option value="in a relationship" <?php if(isset($_POST['rel_status'])) { if ($_POST['rel_status'] == 'in a relationship') echo ' selected="selected"'; } ?>>In a relationship</option>
      <option value="married" <?php if(isset($_POST['rel_status'])) { if ($_POST['rel_status'] == 'married') echo ' selected="selected"'; } ?>>Married</option>
      <option value="separated" <?php if(isset($_POST['rel_status'])) { if ($_POST['rel_status'] == 'separated') echo ' selected="selected"'; } ?>>Separated</option>
      <option value="widowed" <?php if(isset($_POST['rel_status'])) { if ($_POST['rel_status'] == 'widowed') echo ' selected="selected"'; } ?>>Widowed</option>
    </select>
  </div>

  <div>
    <label for="household_type">Type of Household</label>
    <select id="household_type" name="household_type" required>
    <option value="None" <?php if(isset($_POST['household_type'])) { if ($_POST['household_type'] == 'None') echo ' selected="selected"'; } ?>>--Select--</option>
      <option value="one person" <?php if(isset($_POST['household_type'])) { if ($_POST['household_type'] == 'one person') echo ' selected="selected"'; } ?>>One Person</option>
      <option value="couple" <?php if(isset($_POST['household_type'])) { if ($_POST['household_type'] == 'couple') echo ' selected="selected"'; } ?>>Couple</option>
      <option value="single parent" <?php if(isset($_POST['household_type'])) { if ($_POST['household_type'] == 'single parent') echo ' selected="selected"'; } ?>>Single Parent</option>
      <option value="family" <?php if(isset($_POST['household_type'])) { if ($_POST['household_type'] == 'family') echo ' selected="selected"'; } ?>>Family</option>
      <option value="extended family" <?php if(isset($_POST['household_type'])) { if ($_POST['household_type'] == 'extended family') echo ' selected="selected"'; } ?>>Extended Family</option>
    </select>
  </div>

  <div>
    <label for="prev_address">Previous Address</label>
    <input type="text" id="prev_address" name="prev_address" value="<?php if(isset($_POST['prev_address'])) { echo $_POST['prev_address']; } ?>" >
   
  </div>

  <div>
    <label for="city">City</label>
    <input type="text" id="city" name="city" value="<?php if(isset($_POST['city'])) { echo $_POST['city']; } ?>" required ="">
   
  </div>

  <div>
    <label for="zip">Zip Code</label>
    <input type="text" id="zip" name="zip" value="<?php if(isset($_POST['zip'])) { echo $_POST['zip']; } ?>" required ="">
   
  </div>

  <div>
    <label for="country">Country</label>
    <input type="text" id="country" name="country" value="<?php if(isset($_POST['country'])) { echo $_POST['country']; } ?>" required ="">
   
  </div>

  <div>
    <label for="gender">Sex</label>
    <label for="male">Male</label>
    <input type="radio" id="male" name="gender" value="Male" <?php if(isset($_POST['gender'])) { if ($_POST['gender'] == 'Male') echo ' checked'; } ?>>
    <label for="female">Female</label>
    <input type="radio" id="female" name="gender" value="Female" <?php if(isset($_POST['gender'])) { if ($_POST['gender'] == 'Female') echo ' checked'; } ?>>

    <br>
  </div>
  <div>

  <div>
    <label for="birthdate">Date of Birth</label>
    <input type="date" id="birthdate" name="birthdate" value="<?php if(isset($_POST['birthdate'])) { echo $_POST['birthdate']; } ?>" required ="">
  </div>

  <div>
    <label for="pet">Do Tenant own a pet?</label>
    <label for="yes">Yes</label>
    <input type="radio" id="pet" name="pet" value="yes"<?php if(isset($_POST['pet'])) { if ($_POST['pet'] == 'yes') echo ' checked'; } ?>>
    <label for="no">No</label>
     <input type="radio" id="pet" name="pet" value="no" <?php if(isset($_POST['pet'])) { if ($_POST['pet'] == 'no') echo ' checked'; } ?>>
  <br>
  </div>

  <div>
    <label for="pet_num">No of Pets</label>
    <input type="number" name="pet_num" value="<?php if(isset($_POST['pet_num'])) { echo $_POST['pet_num']; } ?>">
  
  </div>

  <div>
  <label for="pet_type">Pet Type:</label>
  <input type="text" id="pet_type" name="pet_type" value="<?php if(isset($_POST['pet_type'])) { echo $_POST['pet_type']; } ?>">

  </div>

  <div>
    <label for="smoking">Do Tenant Smoke?</label>
    <label for="yes">YES</label>
    <input type="radio" id="yes" name="smoking" value="YES" <?php if(isset($_POST['smoking'])) { if ($_POST['smoking'] == 'YES') echo ' checked'; } ?>>
    <label for="no">NO</label>
    <input type="radio" id="no" name="smoking" value="NO" <?php if(isset($_POST['smoking'])) { if ($_POST['smoking'] == 'NO') echo ' checked'; } ?>>

    <br>
  </div>
  <div>

<div>
<label for="vehicles">Please check if tenant own any of the vehicles:</label><br>
        <input type="checkbox" name="vehicles" value="car">Car<br>
        <input type="checkbox" name="vehicles" value="motorcycle">Motorcycle<br>
        <input type="checkbox" name="vehicles" value="others">Others<br>
        <label for="vehicles">If other, please specify:</label>
        <input type="text" name="vehicles" placeholder="Enter other vehicle type" value="<?php if(isset($_POST['vehicles'])) { echo $_POST['vehicles']; } ?>"><br>
   
</div>

<div>
<h3 class="table-title">Co-Applicant Details</h3>
  <input type="hidden" id="pri" name="pri" value="Primary">
  <button type="button" id="pri">Set to Primary</button>
</div>


<div>
  <label for="co_fname">First Name</label>
  <input type="text" id="co_fname" name="co_fname" value="<?php if(isset($_POST['co_fname'])) { echo $_POST['co_fname']; } ?>">
 
</div>

<div>
  <label for="co_lname">Last Name</label>
  <input type="text" id="co_lname" name="co_lname" value="<?php if(isset($_POST['co_lname'])) { echo $_POST['co_lname']; } ?>">
 
</div>

<div>
  <label for="co_email">Email</label>
  <input type="email" id="co_email" name="co_email" value="<?php if(isset($_POST['co_email'])) { echo $_POST['co_email']; } ?>">
 
</div>

<div>
  <label for="co_num">Contact Number</label>
  <input type="number" id="co_num" name="co_num" value="<?php if(isset($_POST['co_num'])) { echo $_POST['co_num']; } ?>">
 
</div>

<div>
<h3 class="table-title">Emergency Contact Person Details</h3>
  <label for="emergency_fname">Full Name:</label>
  <input type="text" id="emergency_fname" name="emergency_fname" value="<?php if(isset($_POST['emergency_fname'])) { echo $_POST['emergency_fname']; } ?>">
  <?php
                        if(isset($_POST['save']) && !validate_emergency_fname($_POST)){
                    ?>
                                <p class="error">Name is invalid. Trailing spaces will be ignored.</p>
                    <?php
                        }
                    ?>
</div>

<div>
  <label for="emergency_num">Contact Number:</label>
  <input type="number" id="emergency_num" name="emergency_num" value="<?php if(isset($_POST['emergency_num'])) { echo $_POST['emergency_num']; } ?>">
  <?php
                        if(isset($_POST['save']) && !validate_emergency_num($_POST)){
                    ?>
                                <p class="error">Number is invalid. Trailing spaces will be ignored.</p>
                    <?php
                        }
                    ?>
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
  document.getElementById("pri").value = "Primary";
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