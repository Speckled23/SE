<?php

    require_once '../tools/functions.php';
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

    //if add lease is submitted
    if(isset($_POST['save'])){

        $lease = new Lease;
        //sanitize user inputs
        $lease->p_unit_id = ($_POST['p_unit_id']);
        $lease->tenants_id = ($_POST['last_name']);
        $lease->startdate = ($_POST['startdate']);
        $lease->enddate = ($_POST['enddate']);
        $lease->rent = ($_POST['rent']);
        $lease->deposit = ($_POST['deposit']);
        $lease->advance = ($_POST['advance']);
        $lease->electricity = ($_POST['electricity']);
        $lease->water = ($_POST['water']);
        $lease->leasedoc = ($_POST['leasedoc']);


            if($lease->add()){
                //redirect user to program page after saving
                header('location: lease.php');
            }
    }

    $page_title = 'Admin | Add Lease';
    $lease = 'active';

    require_once '../includes/header.php';
    require_once '../includes/sidebar.php';
    require_once '../includes/topnav.php';

?>
<div class="home-section">
    <div class = "table-heading">
        <h3 class="table-title">Tenant/Applicant Details</h3>
        <a href="lease.php" class ='bx bx-caret-left'>Back</a>
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
    <label for="p_unit_id">Property Unit Name</label>
    <input type="text" id="p_unit_id" name="p_unit_id" value="<?php if(isset($_POST['p_unit_id'])) { echo $_POST['p_unit_id']; } ?>" required ="">
</div>
  <div>
    <label for="tenants_id">Tenant Name</label>
    <input type="text" id="tenants_id" name="tenants_id" value="<?php if(isset($_POST['tenants_id'])) { echo $_POST['tenants_id']; } ?>" required ="">
  </div>

  <div>
    <label for="statdate">Start Date</label>
    <input type="date" id="statdate" name="statdate" value="<?php if(isset($_POST['statdate'])) { echo $_POST['statdate']; } ?>" required ="">
  </div>

  <div>
    <label for="enddate">End Date</label>
    <input type="date" id="enddate" name="enddate" value="<?php if(isset($_POST['enddate'])) { echo $_POST['enddate']; } ?>" required ="">
  </div>

  <div>
    <label for="rent">Monthly Rate</label>
    <input type="number" id="rent" name="rent" value="<?php if(isset($_POST['rent'])) { echo $_POST['rent']; } ?>" required ="">
  </div>

  <div>
    <label for="deposit">One Month Deposit</label>
    <input type="number" id="deposit" name="deposit" value="<?php if(isset($_POST['deposit'])) { echo $_POST['deposit']; } ?>" required ="">
  </div>

  <div>
    <label for="advance">One Month Advance</label>
    <input type="number" id="advance" name="advance" value="<?php if(isset($_POST['advance'])) { echo $_POST['advance']; } ?>" required ="">
  </div>

  <div class = "table-heading">
        <h3 class="table-title">Bills</h3>
        <h5>Include/Exclude Bill when generating invoice</h5>
  </div>

  <div>
    <label for="electricity">Electricity</label>
    <input type="number" id="electricity" name="electricity" value="<?php if(isset($_POST['electricity'])) { echo $_POST['electricity']; } ?>" required ="">
    <input type="number" id="electricity2" name="electricity2" value="<?php if(isset($_POST['electricity2'])) { echo $_POST['electricity2']; } ?>" required ="">
    
    <input type="date" id="billdate" name="billdate" value="<?php if(isset($_POST['billdate'])) { echo $_POST['billdate']; } ?>" required ="">
    <input type="date" id="billdate" name="billdate" value="<?php if(isset($_POST['billdate'])) { echo $_POST['billdate']; } ?>" required ="">
   
  
  </div>

  <div>
    <label for="water">Water</label>
    <input type="number" id="water" name="water" value="<?php if(isset($_POST['water'])) { echo $_POST['water']; } ?>" required ="">
  </div>

  <div>
    <label for="leasedoc">Upload Lease Document</label>
    <input type="file" id="leasedoc" name="leasedoc" required ="">
  </div>
  
</div>
  <input type="submit" class="button" value="Save" name="save" id="save">

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