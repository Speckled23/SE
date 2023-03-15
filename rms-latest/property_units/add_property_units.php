<?php
  require_once '../tools/variables.php';
  require_once '../includes/dbconfig.php';
  require_once '../classes/property_units.class.php';

  //resume session here to fetch session values
  session_start();
  /*
      if user is not login then redirect to login page,
      this is to prevent users from accessing pages that requires
      authentication such as the dashboard
  */
  if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin'){
      header('location: ../login/login.php');
  }

  $property_units_obj = new Property_Units();

  if(isset($_POST['save'])){
    $property_units_obj->property_id = $_POST['main_property'];
    $property_units_obj->unit_type_id = $_POST['unit_type'];
    $property_units_obj->unit_no = $_POST['unit_no'];
    $property_units_obj->num_rooms = $_POST['num_rooms'];
    $property_units_obj->num_bathrooms = $_POST['num_bathrooms'];
    $property_units_obj->monthly_rent = $_POST['monthly_rent'];
    $property_units_obj->unit_condition_id = $_POST['unit_condition'];
    $property_units_obj->status = $_POST['status'];
    $property_units_obj->one_month_deposit = $_POST['one_month_deposit'];
    $property_units_obj->one_month_advance = $_POST['one_month_advance'];


    if ($property_units_obj->property_unit_add()) {
        header('Location: property_units.php');
        exit; // always exit after redirecting
    } else {
        // handle product add error
        $msg = "Error adding property unit";
    }
  }

  $page_title = 'RMS | Add Property Units';
  $p_units = 'active';
  require_once '../includes/header.php';
?>
<body>
<div class="container-scroller">
    <?php
      require_once '../includes/navbar.php';
    ?>
  <div class="container-fluid page-body-wrapper">
  <?php
      require_once '../includes/sidebar.php';
    ?>
  <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">ADD PROPERTY UNITS</h3>
                </div>
                <div class="add-page-container">
                  <div class="col-md-2 d-flex justify-align-between float-right">
                    <a href="property_units.php" class='bx bx-caret-left'>Back</a>
                </div>
                </div>
              </div>
            </div>
          </div>
      <div class="card">
        <div class="card-body">
        <div class="row g-3">
                <div class="col-md-12">
                <div class="form-group-row">
                   <div class="col">
                     <h4 class="table-title pt-3">PROPERTY UNIT DETAILS</h4>
                     <p class="table-title pb-3">Please fill all the required fields before saving the data</p>
                 </div>
             </div>
            <form action="add_property_units.php" method="post" class="form-sample">
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="form-group-row">
                    <div class="col">
                      <label for="main_property">Main Property</label><span class="req"> *</span>
                      <select class="form-control form-control-sm" placeholder="" id="main_property" name="main_property" required>
                      <option value="none">--Select--</option>
                      <?php
                                  require_once '../classes/reference.class.php';
                                  $ref_obj = new Reference();
                                  $ref = $ref_obj->get_main_pro($_POST['filter']);
                                  foreach($ref as $row){
                              ?>
                                      <option value="<?=$row['id']?>"><?=$row['property_name']?></option>
                              <?php
                                  }
                                  ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group-row">
                    <div class="col">
                      <label for="unit_type">Type of Unit</label><span class="req"> *</span>
                      <select class="form-control form-control-sm" placeholder="" id="unit_type" name="unit_type" required>
                      <option value="none">--Select--</option>
                      <?php
                                  require_once '../classes/reference.class.php';
                                  $ref_obj = new Reference();
                                  $ref = $ref_obj->get_unit_type($_POST['filter']);
                                  foreach($ref as $row){
                              ?>
                                      <option value="<?=$row['id']?>"><?=$row['type_name']?></option>
                              <?php
                                  }
                                  ?>
                      </select>
                    </div>
                  </div>
                </div> 

                <div class="col-md-6">
                  <div class="form-group-row">
                    <div class="col">
                      <label for="monthly_rent">Monthly Rent Amount</label><span class="req"> *</span>
                      <input class="form-control form-control-sm" placeholder=""  type="number" id="monthly_rent" name="monthly_rent" required>
                    </div>
                  </div>
                  <div class="row g-3">
                    <div class="form-group-row">
                      <div class="col-md-6">
                        <div class="form-group-row pt-2">
                          <div class="col">
                            <label for="unit_no">Unit No.</label><span class="req"> *</span>
                            <input  class="form-control form-control-sm " placeholder="Unit No." type="number" id="unit_no" name="unit_no" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group-row pt-2">
                          <div class="col">
                            <label for="status">Status</label><span class="req"> *</span>
                            <select class="form-control form-control-sm" id="status" name="status" >
                              <option name="status" value="Vacant" selected>Vacant</option>
                              <option name="status" value="Occupied">Occupied</option>
                              <option name="status" value="Unavailable">Unavailable</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-d stretch-card" id="card_d-noneR" style="display:none;">
                  <div id="room_fields" style="display:none;">
                    <div class="col-md-12">
                      <div class="form-group-row">
                        <div class="col p-2">
                          <label for="num_rooms">Number of Rooms</label>
                          <input type="number" class="form-control form-control-sm" id="num_rooms" name="num_rooms">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div id="bathroom_fields" style="display:none;">
                    <div class="col-md-12">
                      <div class="form-group-row">
                        <div class="col p-2">
                          <label for="num_bathrooms">Number of Bathrooms</label>
                          <input type="number" class="form-control form-control-sm" id="num_bathrooms" name="num_bathrooms">
                        </div>
                      </div>
                    </div>
                  </div>  
                </div> 
                <div class="card-d stretch-card" id="card_d-none1" style="display:none;">
                  <div class="col-md-12">
                    <div class="form-group-row">
                      <div class="col">
                        <label for="one_month_deposit">One Month Deposit Amount</label><span class="req"> *</span>
                        <input type="number" class="form-control" id="one_month_deposit" placeholder="enter amount" name="one_month_deposit">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group-row">
                      <div class="col">
                        <label for="one_month_advance">One Month Advance Amount</label><span class="req"> *</span>
                        <input type="number" class="form-control" id="one_month_advance" placeholder="enter amount" name="one_month_advance">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group-row">
                    <div class="col">
                      <label for="unit_condition">Unit Condition</label><span class="req"> *</span>
                      <select class="form-control form-control-sm" placeholder="" id="unit_condition" name="unit_condition" required>
                      <option value="none">--Select--</option>
                      <?php
                                  require_once '../classes/reference.class.php';
                                  $ref_obj = new Reference();
                                  $ref = $ref_obj->get_unit_con($_POST['filter']);
                                  foreach($ref as $row){
                              ?>
                                      <option value="<?=$row['id']?>"><?=$row['condition_name']?></option>
                              <?php
                                  }
                                  ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="pt-3">
                <input type="submit" class="btn btn-success btn-sm" value="Save Unit" name="save" id="save">
              </div>
            </form> 
          </div>
        </div>
    </div>
  </div>
</div>

<script>
  var unitTypeDropdown = document.getElementById("unit_type");
  var card_dNone = document.getElementById("card_d-noneR");
  var card_dNone1 = document.getElementById("card_d-none1");
  
  var roomFields = document.getElementById("room_fields");

  unitTypeDropdown.addEventListener("change", function() {
    if (this.value == "1") { // Change "1" to the ID of the option that should trigger the fields to appear "PAD"
      card_dNone.style.display = "block";
      roomFields.style.display = "block";
    } else {
      card_dNone.style.display = "none";
      roomFields.style.display = "none";
    }
  });
  
    //Added an if statement to check if the value input in the number of rooms field is greater than 1 and display the number of bathrooms field accordingly.
  var numRoomsInput = document.getElementById("num_rooms");
  var numBathroomsField = document.getElementById("bathroom_fields");
  numRoomsInput.addEventListener("change", function() {
    if (this.value > 1) {
      numBathroomsField.style.display = "block";
    } else {
      numBathroomsField.style.display = "none";
    }
  });


  var oneMonthDepositField = document.getElementById("one_month_deposit_field");
  var oneMonthAdvanceField = document.getElementById("one_month_advance_field");

  //Added an if statement to check if the value input in the monthly rent field is greater than 2500.00 or 5000.00 and display the one month deposit and one month advance fields accordingly.
  var monthlyRentInput = document.getElementById("monthly_rent");
  monthlyRentInput.addEventListener("input", function() {
    if (monthlyRentInput.value > 5000.0) {
      card_dNone1.style.display = "block";
      oneMonthDepositField.style.display = "block";
      oneMonthAdvanceField.style.display = "block";
    } else if (monthlyRentInput.value > 2500.0) {
      card_dNone1.style.display = "block";
      oneMonthDepositField.style.display = "block";
      oneMonthAdvanceField.style.display = "none";
    } else {
      card_dNone1.style.display = "none";
      oneMonthDepositField.style.display = "none";
      oneMonthAdvanceField.style.display = "none";
    }
  });

  
</script>

