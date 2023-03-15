<?php
  require_once '../tools/functions.php';
  require_once '../classes/landlords.class.php';
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
    //if the above code is false then html below will be displayed
    if(isset($_POST['save'])){
      $landlord_obj = new Landlord();
      //sanitize user inputs
      $landlord_obj->first_name = htmlentities($_POST['first_name']);
      $landlord_obj->middle_name = htmlentities($_POST['middle_name']);
      $landlord_obj->last_name = htmlentities($_POST['last_name']);
      $landlord_obj->date_of_birth = htmlentities($_POST['date_of_birth']);
      $landlord_obj->email = htmlentities($_POST['email']);
      $landlord_obj->contact_no = htmlentities($_POST['contact_no']);
      $landlord_obj->address = htmlentities($_POST['address']);
      $landlord_obj->region= htmlentities($_POST['region']);
      $landlord_obj->provinces = htmlentities($_POST['provinces']);
      $landlord_obj->city = htmlentities($_POST['city']);
      $landlord_obj->emergency_contact_person = htmlentities($_POST['emergency_contact_person']);
      $landlord_obj->emergency_contact_number = htmlentities($_POST['emergency_contact_number']);
      if (isset($_FILES['identification_document'])) {
        $image = $_FILES['identification_document']['name'];
        $target = "../img/" . basename($image);

        if (move_uploaded_file($_FILES['identification_document']['tmp_name'], $target)) {
            $landlord_obj->identification_document = $_FILES['identification_document']['name'];
        } else {
            // handle file upload error
            $msg = "Error uploading file";
        }
      }
      // handle file upload error
      $msg = "Error uploading file";
      
        // Add product to database
        if(validate_add_landlord($_POST)){
          if ($landlord_obj->landlord_add()) {
            header('Location: landlords.php');
            exit; // always exit after redirecting
        } else {
            // handle product add error
            $msg = "Error adding landlord";
        }
      }
    }

    require_once '../tools/variables.php';
    $page_title = 'RMS | Add Landlord';
    $landlord = 'active';

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
              <h3 class="font-weight-bolder">ADD LANDLORD</h3> 
            </div>
            <div class="add-page-container">
              <div class="col-md-2 d-flex justify-align-between float-right">
                <a href="landlords.php" class='bx bx-caret-left'>Back</a>
              </div>
            </div>
            <form action="add_landlord.php" method="post">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="row g-3">
                      <div class="col-md-12">
                        <div class="form-group-row">
                          <div class="col">
                            <h3 class="table-title fw-bolder pb-3">Landlord Details</h3>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group-row">
                          <div class="col">
                            <label for="first_name">First Name <?php if(isset($_POST['save']) && !validate_first_name($_POST)){?> <label class="text-danger">*</label> <?php }?></label>
                            <input  class="form-control form-control-sm " placeholder="First name" type="text" id="first_name" name="first_name" >
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group-row">
                          <div class="col">
                            <label for="middle_name">Middle Name <?php if(isset($_POST['save']) && !validate_middle_name($_POST)){?> <label class="text-danger">*</label> <?php }?></label>
                            <input  class="form-control form-control-sm " placeholder="Middle name" type="text" id="middle_name" name="middle_name" >
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group-row">
                          <div class="col">
                            <label for="last_name">Last Name <?php if(isset($_POST['save']) && !validate_last_name($_POST)){?> <label class="text-danger">*</label> <?php }?></label>
                            <input class="form-control form-control-sm" placeholder="Last name" type="text" id="last_name" name="last_name" >
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
                            <label for="email">Email <?php if(isset($_POST['save']) && !validate_email($_POST)){?> <label class="text-danger">*</label> <?php }?></label>
                            <input  class="form-control form-control-sm" placeholder="Email" type="text" id="email" name="email">
                          </div>
                        </div>
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
                            <input class="form-control form-control-sm"  placeholder="11-digit mobile number" type="text" id="contact_no" name="contact_no" >
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group-row">
                          <div class="col">
                          <label for="address">Address <?php if(isset($_POST['save']) && !validate_address($_POST)){?> <label class="text-danger">*</label> <?php }?></label>
                            <input class="form-control form-control-sm" placeholder="House No., Building No."  type="text" id="address" name="address">
                          </div>
                        </div>
                      </div>
                      <div class="col d-flex">
                        <div class="col-sm-3 ">
                            <label for="region">Region<?php if(isset($_POST['save']) && !validate_region($_POST)){?> <label class="text-danger">*</label> <?php }?></label>
                            <select type="text" class="form-control form-control-sm" name="region" id="region" placeholder="" > 
                              <option value="none">--Select--</option>
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
                        <div class="col-sm-5 pl-0">
                          <label for="provinces">Province <?php if(isset($_POST['save']) && !validate_prov($_POST)){?> <label class="text-danger">*</label> <?php }?></label>
                          <select id="provinces" class="form-control form-control-sm" id="provinces" name="provinces">
                            <option value="none">--select--</option>
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
                          <label for="city">City <?php if(isset($_POST['save']) && !validate_city($_POST)){?> <label class="text-danger">*</label> <?php }?></label>
                          <select id="city" class="form-control form-control-sm" id="city" name="city" >
                          <option value="none">--select--</option>
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
                        <div class="form-group-row w-100">
                          <div class="col">
                            <label for="identification_document">Identification Document</label>
                            <input type="file" class="form-control form-control-sm" name="identification_document" id="identification_document" accept=".jpg,.jpeg,.png">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group-row">
                        <div class="col">
                          <h3 class="table-title pt-4">Emergency Contact Person Details</h3>
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
                      <input type="submit" class="btn btn-success btn-sm" value="Save" name="save" id="save">
                    </div>
                </div>
              </div>
       

              <script>
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
</body>