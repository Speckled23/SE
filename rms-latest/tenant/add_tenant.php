<?php
  require_once '../tools/functions.php';
  //require_once '../tools/functions.php';
  require_once '../classes/tenants.class.php';
  //require_once '../includes/dbconfig.php';

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

    if(isset($_POST['save'])){
      $tenant_obj = new Tenant();
      //sanitize user inputs
      $tenant_obj->first_name = htmlentities($_POST['first_name']);
      $tenant_obj->middle_name = htmlentities($_POST['middle_name']);
      $tenant_obj->last_name = htmlentities($_POST['last_name']);
      $tenant_obj->email = htmlentities($_POST['email']);
      $tenant_obj->contact_no = htmlentities($_POST['contact_no']);
      $tenant_obj->relationship_status = htmlentities($_POST['relationship_status']);
      $tenant_obj->type_of_household = htmlentities($_POST['type_of_household']);
      $tenant_obj->previous_address = htmlentities($_POST['previous_address']);
      $tenant_obj->region = htmlentities($_POST['region']);
      $tenant_obj->provinces = htmlentities($_POST['provinces']);
      $tenant_obj->city = htmlentities($_POST['city']);
      $tenant_obj->sex = $_POST['sex'];
      $tenant_obj->date_of_birth = htmlentities($_POST['date_of_birth']);
      if (isset($_POST['has_pet'])) {
        $has_pet = $_POST['has_pet'];
        if ($has_pet === 'No') {
          // If the user selects "No" for owning a pet, set the values of number_of_pets and type_of_pet to "0" and "None" respectively
          $tenant_obj->has_pet = 'No';
          $tenant_obj->number_of_pets = 0;
          $tenant_obj->type_of_pet = 'None';
        } else {
          $tenant_obj->has_pet = 'Yes';
          $tenant_obj->number_of_pets = htmlentities($_POST['number_of_pets']);
          $tenant_obj->type_of_pet = htmlentities($_POST['type_of_pet']);
        }
      }
      if (isset($_POST['is_smoking'])) {
        $tenant_obj->is_smoking = $_POST['is_smoking'];
      }
      if (isset($_POST['has_vehicle'])) {
        $tenant_obj->has_vehicle = is_array($_POST['has_vehicle']) ? $_POST['has_vehicle'] : array($_POST['has_vehicle']);
      }
      $tenant_obj->vehicle_specification = htmlentities($_POST['vehicle_specification']);
      $tenant_obj->spouse_first_name = htmlentities($_POST['spouse_first_name']);
      $tenant_obj->spouse_last_name = htmlentities($_POST['spouse_last_name']);
      $tenant_obj->spouse_email = htmlentities($_POST['spouse_email']);
      $tenant_obj->spouse_num = htmlentities($_POST['spouse_num']);
/*       $tenant_obj->occupants = htmlentities($_POST['occupants[]']);
      $tenant_obj->occupants_relations = htmlentities($_POST['occupants_relations[]']);
 */   if (isset($_POST['occupants[]']) && ($_POST['occupants_relations[]'])) {
        // Decode the occupants and occupants_relations arrays from JSON
        $tenant_obj->occupants = json_decode($_POST['occupants[]'], true);
        $tenant_obj->occupants_relations = json_decode($_POST['occupants_relations[]'], true);

        // Iterate over the occupants array and print each occupant's name
        foreach ($_POST['occupants'] as $occupant) {
          echo $occupant . '<br>';
        }

        // Iterate over the occupants_relations array and print each occupant's relation
        foreach ($_POST['occupants_relations'] as $relation) {
          echo $relation . '<br>';
        }
      }

      $tenant_obj->emergency_contact_person = htmlentities($_POST['emergency_contact_person']);
      $tenant_obj->emergency_contact_number = htmlentities($_POST['emergency_contact_number']);
      if(validate_tenants($_POST)){
        if($tenant_obj->tenants_add()){  
            //redirect user to landing page after saving
            header('location: tenants.php');
        }
      }
  }
        require_once '../tools/variables.php';
      $page_title = 'RMS | Add Tenant';
      $tenant = 'active';
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
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
              <h3 class="font-weight-bolder">ADD TENANT</h3> 
            </div>
            <div class="add-page-container">
              <div class="col-md-2 d-flex justify-align-between float-right">
                <a href="tenants.php" class='bx bx-caret-left'>Back</a>
              </div>
            </div>
          </div>
          <form action="add_tenant.php" method="post">
            <div class="card">
              <div class="card-body">
                <h3 class="table-title fw-bolder pb-4">Tenant Details</h3>
                <div class="row g-3">
                  <div class="col-md-6">
                    <div class="form-group-row">
                      <div class="col">
                        <label for="first_name">First Name                                
                            <?php
                            if(isset($_POST['save']) && !validate_first_name($_POST)){
                            ?>
                              <span class="text-danger">*</span>
                            <?php
                                }
                            ?>
                        </label>
                        <input required class="form-control form-control-sm " placeholder="First name" type="text" id="first_name" name="first_name">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group-row">
                      <div class="col">
                      <label for="middle_name">Middle Name
                      <?php
                            if(isset($_POST['save']) && !validate_middle_name($_POST)){
                            ?>
                              <span class="text-danger">*</span>
                            <?php
                                }
                            ?>
                      </label>
                      <input class="form-control form-control-sm" type="text" id="middle_name" name="middle_name">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group-row">
                        <div class="col">
                            <label for="last_name">Last Name
                              <?php
                              if(isset($_POST['save']) && !validate_last_name($_POST)){
                              ?>
                                <span class="text-danger">*</span>
                              <?php
                                  }
                              ?>
                            </label>
                          <input required class="form-control form-control-sm" placeholder="Last name" type="text" id="last_name" name="last_name">
                        </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group-row">
                      <div class="col">
                        <label for="date_of_birth">Date of Birth
                        <?php
                            if(isset($_POST['save']) && !validate_date_birth($_POST)){
                            ?>
                              <span class="text-danger">* Age 18 above</span>
                            <?php
                                }
                            ?>
                        </label>
                        <input class="form-control form-control-sm" type="date" id="date_of_birth" name="date_of_birth">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group-row">
                        <div class="col">
                          <label for="email">Email</label>
                          <input required class="form-control form-control-sm" placeholder="Email" type="text" id="email" name="email">
                        </div>
                      </div>
                      <?php
                      if(isset($_POST['save']) && !validate_email($_POST)){
                      ?>
                        <span class="text-danger">*</span>
                      <?php
                          }
                      ?>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group-row">
                        <div class="col">
                          <label for="contact_no">Contact No.
                            <?php
                              if(isset($_POST['save']) && !validate_contact_num($_POST)){
                              ?>
                                <span class="text-danger">*</span>
                              <?php
                                  }
                              ?>
                          </label>
                          <input required class="form-control form-control-sm" type="text" id="contact_no" name="contact_no" maxlength="12">
                        </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group-row">
                      <div class="col">
                      <label for="previous_address">Previous Address
                      <?php
                            if(isset($_POST['save']) && !validate_prev_address($_POST)){
                            ?>
                              <span class="text-danger">*</span>
                            <?php
                                }
                            ?>
                      </label>
                        <input required class="form-control form-control-sm" placeholder="House No., Building No."  type="text" id="previous_address" name="previous_address">
                      </div>
                    </div>
                  </div>
                  <div class="col d-flex">
                    <div class="col-sm-4">
                      <label for="region">Region<span class="text-muted"></span>
                      <?php
                            if(isset($_POST['save']) && !validate_region($_POST)){
                            ?>
                              <span class="text-danger">*</span>
                            <?php
                                }
                            ?></label>
                      <select type="text" class="form-control form-control-sm" name="region" id="region" placeholder=""> 
                        <option value="None">--Select--</option>
                        <?php
                              require_once '../classes/reference.class.php';
                              $ref_obj = new Reference();
                              $ref = $ref_obj->get_region();
                              foreach($ref as $row){
                          ?>
                                  <option value="<?=$row['regCode']?>"><?=$row['regDesc']?></option>
                          <?php
                              }
                          ?>
                      </select>
                    </div>
                    <div class="col-sm-4 pl-0">
                      <label for="provinces">Provinces<span class="text-muted"></span>
                      <?php
                            if(isset($_POST['save']) && !validate_prov($_POST)){
                            ?>
                              <span class="text-danger">*</span>
                            <?php
                                }
                            ?></label>
                      <select type="text" id="provinces" class="form-control form-control-sm" name="provinces">
                      <option value="None">--Select--</option>
                      <?php
                              require_once '../classes/reference.class.php';
                              $ref_obj = new Reference();
                              $ref = $ref_obj->get_province($regCode);
                              foreach($ref as $row){
                          ?>
                                  <option value="<?=$row['provCode']?>"><?=$row['provDesc']?></option>
                          <?php
                              }
                          ?>
                      </select>
                    </div>
                    <div class="col-sm-4 pl-0">
                      <label for="city">City
                      <?php
                            if(isset($_POST['save']) && !validate_city($_POST)){
                            ?>
                              <span class="text-danger">*</span>
                            <?php
                                }
                            ?>
                      </label>
                      <select type="text" class="form-control form-control-sm" id="city" name="city">
                      <option value="None">--Select--</option>
                      <?php
                          require_once '../classes/reference.class.php';
                          $ref_obj = new Reference();
                          $ref = $ref_obj->get_City($provCode);
                          foreach($ref as $row){
                      ?>
                              <option value="<?=$row['citymunCode']?>"><?=$row['citymunDesc']?></option>
                      <?php
                          }
                          ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group-row">
                      <div class="col">
                          <label for="sex" class="form-label">Sex<span class="text-muted"></span>
                          <?php
                            if(isset($_POST['save']) && !validate_sex($_POST)){
                            ?>
                              <span class="text-danger">*</span>
                            <?php
                                }
                            ?></label>
                          <select class="form-control" id="sex" placeholder="" name="sex">
                              <option value="None">--Select--</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="col d-flex">
                    <div class="col-sm-4 pr-1 fs2">
                      <label for="has_pet">Do Tenant own a pet?
                      <?php
                            if(isset($_POST['save']) && !validate_has_pet($_POST)){
                            ?>
                              <span class="text-danger">*</span>
                            <?php
                                }
                            ?>
                      </label><br>
                      <input type="radio" id="has_pet_yes" name="has_pet" value="Yes">
                      <label for="has_pet_yes">Yes</label>
                      <input type="radio" id="has_pet_no" name="has_pet" value="No">
                      <label for="has_pet_no">No</label>
                    </div>
                    <div class="col px-1 fs1 fs2">
                      <label for="number_of_pets">No. of Pets</label>
                      <input class="form-control form-control-sm fs1" type="number" name="number_of_pets" min="0">
                    </div>
                    <div class="col-md-4 pl-1 fs1 fs2">
                      <label for="type_of_pet">Pet Type:
                        <?php
                            if(isset($_POST['save']) && !validate_pet_type($_POST)){
                            ?>
                              <span class="text-danger">*</span>
                            <?php
                                }
                            ?>
                      </label>
                      <input class="form-control form-control-sm fs1" type="text" id="type_of_pet" name="type_of_pet">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group-row">
                      <div class="col">
                        <label for="relationship_status">Civil Status
                        <?php
                            if(isset($_POST['save']) && !validate_civil_status($_POST)){
                            ?>
                              <span class="text-danger">*</span>
                            <?php
                                }
                            ?>
                        </label>
                        <select class="form-control form-control-sm" id="relationship_status" name="relationship_status" >
                          <option name="relationship_status" value="None">--Select--</option>
                          <option name="relationship_status" value="single">Single</option>
                          <option name="relationship_status" value="in a relationship">In a relationship</option>
                          <option name="relationship_status" value="married">Married</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group-row">
                      <div class="col">
                        <label for="is_smoking">Do Tenant Smoke?
                        <?php
                            if(isset($_POST['save']) && !validate_is_smoking($_POST)){
                            ?>
                              <span class="text-danger">*</span>
                            <?php
                                }
                            ?>
                        </label><br>
                        <input type="radio" id="is_smoking" name="is_smoking" value="Yes">
                        <label for="yes">Yes</label>
                        <input type="radio" id="is_smoking" name="is_smoking" value="No">
                        <label for="no">No</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group-row">
                      <div class="col">
                        <label for="type_of_household">Type of Household
                        <?php
                            if(isset($_POST['save']) && !validate_house($_POST)){
                            ?>
                              <span class="text-danger">*</span>
                            <?php
                                }
                            ?>
                        </label>
                        <select class="form-control form-control-sm" id="type_of_household" name="type_of_household" >
                        <option name="type_of_household" value="None">--Select--</option>
                          <option name="type_of_household" value="one person">One Person</option>
                          <option name="type_of_household" value="couple">Couple</option>
                          <option name="type_of_household" value="single parent">Single Parent</option>
                          <option name="type_of_household" value="family">Family</option>
                          <option name="type_of_household" value="extended family">Extended Family</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group-row">
                      <div class="col">
                        <label for="has_vehicle">Please check if tenant own any of the vehicles:</label><br>
                        <input type="checkbox" name="has_vehicle" value="car">Car<br>
                        <input type="checkbox" name="has_vehicle" value="motorcycle">Motorcycle<br>
                        <input type="checkbox" name="has_vehicle" value="others">Others<br>
                        <div class="d-flex col-sm-12">
                          <label for="vehicle_specification" hidden>If other, please specify:</label><br>
                          <input class="form-control form-control-sm" type="text" name="vehicle_specification" id="vehicle_specification" style="display:none;"><br>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="spouse_fields" style="display: none;">
                    <div class="row g-3">
                      <div class="col-md-12">
                        <div class="form-group-row">
                          <div class="col d-flex">
                            <h3 class="table-title pt-2">Spouse Details</h3>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group-row">
                          <div class="col">
                            <label for="spouse_first_name">First Name</label>
                            <input class="form-control form-control-sm" type="text" id="spouse_first_name" name="spouse_first_name">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group-row">
                          <div class="col">
                            <label for="spouse_first_name">Last Name</label>
                            <input class="form-control form-control-sm" type="text" id="spouse_last_name" name="spouse_last_name">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group-row">
                          <div class="col">
                            <label for="spouse_email">Email</label>
                            <input class="form-control form-control-sm" type="email" id="spouse_email" name="spouse_email">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group-row">
                          <div class="col"> 
                            <label for="spouse_num">Contact No.</label>
                            <input class="form-control form-control-sm" type="text" id="spouse_num" name="spouse_num">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12" id="other_occupants_fields" style="display: none;">
                    <hr>
                    <div class="form-group-row">
                      <div class="col d-flex">
                        <h3 class="table-title">Other Occupants</h3>
                        <button id="add_occupant" class="btn btn-success btn-rounded btn-icon ml-auto"  type="button"><i class="fas fa-plus"></i></button>
                      </div>
                    </div>
                    <div class="occupant-container">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group-row">
                            <div class="col">
                              <label for="occupants">Full Name/s</label>
                              <input class="form-control form-control-sm" id="occupants" name="occupants[]"></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group-row">
                            <div class="col">
                              <label for="occupants_relations">Relationship to Tenant</label><span class="req"> *</span>
                              <input class="form-control form-control-sm" type="text" id="occupants_relations" name="occupants_relations[]">
                            </div>
                          </div>
                        </div>  
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <hr>
                    <div class="form-group-row">
                      <div class="col">
                        <h3 class="table-title">Emergency Contact Person Details</h3>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 d-flex">
                    <div class="form-group-row w-50">
                      <div class="col">
                        <label for="emergency_contact_person">Full Name
                        <?php
                            if(isset($_POST['save']) && !validate_full_name($_POST)){
                            ?>
                              <span class="text-danger">*</span>
                            <?php
                                }
                            ?>
                        </label>
                        <input required class="form-control form-control-sm" type="text" id="emergency_contact_person" name="emergency_contact_person">
                      </div>
                    </div>
                    <div class="form-group-row w-50">
                      <div class="col">
                        <label for="emergency_contact_number">Contact No.
                        <?php
                            if(isset($_POST['save']) && !validate_econtact_no($_POST)){
                            ?>
                              <span class="text-danger">*</span>
                            <?php
                                }
                            ?>
                        </label>
                        <input required class="form-control form-control-sm" type="text" id="emergency_contact_number" name="emergency_contact_number">
                      </div>
                    </div>
                  </div>
                  <div class="pt-3">
                    <input type="submit" class="btn btn-success btn-sm" value="Save Tenant" name="save" id="save">
                  </div>
                </div>
              </div>
            </div>

            <script>

                      // Add an event listener to the "has_pet" radio buttons
                      const hasPetRadioButtons = document.getElementsByName("has_pet");
                        hasPetRadioButtons.forEach((radioButton) => {
                        radioButton.addEventListener("click", function() {
                        if (this.value === "No") {
                          // If the user selects "No" for owning a pet, set the values of number_of_pets and type_of_pet to "0" and "None" respectively
                            document.getElementById("number_of_pets").value = "0";
                            document.getElementById("type_of_pet").value = "None";
                          }
                        });
                      });

                      // Script to show/hide "other_vehicle_type" input field
                      var vehicleTypeCheckboxes = document.querySelectorAll('input[name="has_vehicle"]');
                      var otherVehicleTypeInput = document.querySelector('input[name="vehicle_specification"]');
                      var otherVehicleTypeLabel = document.querySelector('label[for="vehicle_specification"]');

                      vehicleTypeCheckboxes.forEach(function(checkbox) {
                        checkbox.addEventListener('change', function() {
                          if (checkbox.value === 'others' && checkbox.checked) {
                            otherVehicleTypeInput.style.display = 'block';
                            otherVehicleTypeLabel.hidden = false;
                          } else {
                            otherVehicleTypeInput.style.display = 'none';
                            otherVehicleTypeLabel.hidden = true;
                          }
                        });
                      });

                      var statusDropdown = document.getElementById("relationship_status");
                      var spouseFields = document.getElementById("spouse_fields");

                      statusDropdown.addEventListener("change", function() {
                        if (this.value == "married") {
                          spouseFields.style.display = "block";
                        } else {
                          spouseFields.style.display = "none";
                        }
                      });


                      $(document).ready(function() {
                        // hide Other Occupants section by default
                        $('#other_occupants_fields').hide();
                        
                        // show/hide Other Occupants section based on selected value of Type of Household dropdown
                        $('#type_of_household').on('change', function() {
                          var selectedValue = $(this).val();
                          if (selectedValue == 'one person') {
                            $('#other_occupants_fields').hide();
                          } else {
                            $('#other_occupants_fields').show();
                          }
                        });
                      });

                    // add new occupant input fields
                    $('#add_occupant').on('click', function() {
                      var newOccupant = `
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group-row">
                              <div class="col">
                                <label for="occupants">Full Name/s</label>
                                <input class="form-control form-control-sm" name="occupants[]"></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group-row">
                              <div class="col">
                                <label for="occupants_relations">Relationship to Tenant</label><span class="req"> *</span>
                                <input class="form-control form-control-sm" type="text" name="occupants_relations[]">
                              </div>
                            </div>
                          </div>  
                        </div>
                      `;
                      $('.occupant-container').append(newOccupant);
                    });





                    $('#region').on('change', function(){
                          var formData = {
                              filter: $("#region").val(),
                              action: 'provinces',
                          };
                          $.ajax({
                              type: "POST",
                              url: '../includes/address.php',
                              data: formData,
                              success: function(result)
                              {
                                  console.log(formData);
                                  console.log(result);
                                  $('#provinces').html(result);
                              },
                              error: function(XMLHttpRequest, textStatus, errorThrown) { 
                                  alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                              }  
                          });
                      });
                      $('#provinces').on('change', function(){
                          var formData = {
                              filter: $("#provinces").val(),
                              action: 'city',
                          };
                          $.ajax({
                              type: "POST",
                              url: '../includes/address.php',
                              data: formData,
                              success: function(result)
                              {
                                  console.log(formData);
                                  console.log(result);
                                  $('#city').html(result);
                              },
                              error: function(XMLHttpRequest, textStatus, errorThrown) { 
                                  alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                              }  
                          });
                      });
            </script>
          </form>
