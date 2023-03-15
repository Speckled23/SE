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

    $landlord_obj = new Landlord;
    //if the above code is false then html below will be displayed
    if(isset($_POST['save'])){
      
      //sanitize user inputs
      $landlord_obj->first_name = htmlentities($_POST['first_name']);
      $landlord_obj->middle_name = $_POST['middle_name'];
      $landlord_obj->last_name = htmlentities($_POST['last_name']);
      $landlord_obj->date_of_birth = htmlentities($_POST['date_of_birth']);
      $landlord_obj->email = htmlentities($_POST['email']);
      $landlord_obj->contact_no = $_POST['contact_no'];
      $landlord_obj->address = $_POST['address'];
      $landlord_obj->region= $_POST['region'];
      $landlord_obj->province = $_POST['provinces'];
      $landlord_obj->city = $_POST['city'];
      $landlord_obj->emergency_contact_person = htmlentities($_POST['emergency_contact_person']);
      $landlord_obj->emergency_contact_number = $_POST['emergency_contact_number'];
      if (isset($_FILES['identification_document'])) {
        $image = $_FILES['identification_document']['name'];
        $target = "../img/" . basename($image);

        if (move_uploaded_file($_FILES['identification_document']['tmp_name'], $target)) {
            $landlord_obj->identification_document = $_FILES['identification_document']['name'];
        } else {
            // handle file upload error
            $msg = "Error uploading file";
        }
      } else {
          // handle missing file error
          $msg = "Missing file upload";
      }
    // Add product to database
    if(validate_add_landlord($_POST)){
        if ($landlord_obj->landlord_edit()) {
            header('Location: landlords.php');
            exit; // always exit after redirecting
        } else {
            // handle product add error
            $msg = "Error adding landlord";
        }
    }
  }

    else{
        if ($landlord_obj->landlord_fetch($_GET['id'])){
            $data = $landlord_obj->landlord_fetch($_GET['id']);
            $landlord_obj->id = $data['id'];
            $landlord_obj->first_name = $data['first_name'];
            $landlord_obj->middle_name = $data['middle_name'];
            $landlord_obj->last_name = $data['last_name'];
            $landlord_obj->date_of_birth = $data['date_of_birth'];
            $landlord_obj->email = $data['email'];
            $landlord_obj->contact_no = $data['contact_no'];
            $landlord_obj->address = $data['address'];
            $landlord_obj->region= $data['region'];
            $landlord_obj->provinces = $data['provinces'];
            $landlord_obj->city = $data['city'];
            $landlord_obj->identification_document = $data['identification_document'];
            $landlord_obj->emergency_contact_person = $data['emergency_contact_person'];
            $landlord_obj->emergency_contact_number = $data['emergency_contact_number'];
        }
    }


    require_once '../tools/variables.php';
    $page_title = 'RMS | Edit Landlord';
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
              <h3 class="font-weight-bolder">EDIT LANDLORD</h3> 
            </div>
            <div class="add-page-container">
              <div class="col-md-2 d-flex justify-align-between float-right">
                <a href="landlords.php" class='bx bx-caret-left'>Back</a>
              </div>
            </div>
            <form action="edit_landlord.php" method="post">
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

                            <input type="text" hidden name="landlord-id" value="<?php echo $landlord_obj->id; ?>">

                            <label for="first_name">First Name <?php if(isset($_POST['save']) && !validate_first_name($_POST)){?> <label class="text-danger">*</label> <?php }?></label>
                            <input  class="form-control form-control-sm " placeholder="First name" type="text" id="first_name" name="first_name" value="<?php if(isset($_POST['first_name'])) { echo $_POST['first_name']; } else { echo $landlord_obj->first_name; }?>">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group-row">
                          <div class="col">
                            <label for="middle_name">Middle Name <?php if(isset($_POST['save']) && !validate_middle_name($_POST)){?> <label class="text-danger">*</label> <?php }?></label>
                            <input  class="form-control form-control-sm " placeholder="Middle name" type="text" id="middle_name" name="middle_name" value="<?php if(isset($_POST['middle_name'])) { echo $_POST['middle_name']; } else { echo $landlord_obj->last_name; }?>">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group-row">
                          <div class="col">
                            <label for="last_name">Last Name <?php if(isset($_POST['save']) && !validate_last_name($_POST)){?> <label class="text-danger">*</label> <?php }?></label>
                            <input class="form-control form-control-sm" placeholder="Last name" type="text" id="last_name" name="last_name" value="<?php if(isset($_POST['last_name'])) { echo $_POST['last_name']; } else { echo $landlord_obj->last_name; }?>">
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
                            <input class="form-control form-control-sm" type="date" id="date_of_birth" name="date_of_birth" value="<?php if(isset($_POST['date_of_birth'])) { echo $_POST['date_of_birth']; } else { echo $landlord_obj->date_of_birth; }?>">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group-row">
                          <div class="col">
                            <label for="email">Email <?php if(isset($_POST['save']) && !validate_email($_POST)){?> <label class="text-danger">*</label> <?php }?></label>
                            <input  class="form-control form-control-sm" placeholder="Email" type="text" id="email" name="email" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } else { echo $landlord_obj->email; }?>">
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
                            <input class="form-control form-control-sm"  placeholder="11-digit mobile number" type="text" id="contact_no" name="contact_no" value="<?php if(isset($_POST['contact_no'])) { echo $_POST['contact_no']; } else { echo $landlord_obj->contact_no; }?>">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group-row">
                          <div class="col">
                          <label for="address">Address <?php if(isset($_POST['save']) && !validate_address($_POST)){?> <label class="text-danger">*</label> <?php }?></label>
                            <input class="form-control form-control-sm" placeholder="House No., Building No."  type="text" id="address" name="address" value="<?php if(isset($_POST['address'])) { echo $_POST['address']; } else { echo $landlord_obj->address; }?>">
                          </div>
                        </div>
                      </div>
                      <div class="col d-flex">
                        <div class="col-sm-3 ">
                            <label for="region">Region<?php if(isset($_POST['save']) && !validate_region($_POST)){?> <label class="text-danger">*</label> <?php }?></label>
                            <select type="text" class="form-control form-control-sm" name="region" id="region" placeholder="" > 
                                <option value="None" <?php if(isset($_POST['region'])) { if ($_POST['region'] == 'None') echo ' selected="selected"'; } elseif ($landlord_obj->region == 'None') echo ' selected="selected"'; ?>>--Select--</option>
                              <?php
                                    require_once '../classes/reference.class.php';
                                    $ref_obj = new Reference();
                                    $ref = $ref_obj->get_region();
                                    foreach($ref as $row){
                                ?>
                                        <option value="<?=$row['regCode']?>" <?php if(isset($_POST['region'])) { if ($_POST['region'] == $row['regCode']) echo ' selected="selected"'; } elseif ($landlord_obj->region == $row['regCode']) echo ' selected="selected"'; ?>><?=$row['regDesc']?></option>
                                <?php
                                    }
                                ?>
                            </select>
                          </div>
                        <div class="col-sm-5 pl-0">
                          <label for="provinces">Province <?php if(isset($_POST['save']) && !validate_prov($_POST)){?> <label class="text-danger">*</label> <?php }?></label>
                          <select id="provinces" class="form-control form-control-sm" id="provinces" name="provinces">
                            <option value="None" <?php if(isset($_POST['region'])) { if ($_POST['region'] == 'None') echo ' selected="selected"'; } elseif ($landlord_obj->region == 'None') echo ' selected="selected"'; ?>>--select--</option>
                            <?php
                                require_once '../classes/reference.class.php';
                                $ref_obj = new Reference();
                                  $ref = $ref_obj->get_province($regCode);
                                  foreach($ref as $row){
                            ?>
                                   <option value="<?=$row['provCode']?>" <?php if(isset($_POST['provinces'])) { if ($_POST['provinces'] == $row['provCode']) echo ' selected="selected"'; } elseif ($landlord_obj->provinces == $row['provCode']) echo ' selected="selected"'; ?>><?=$row['provDesc']?></option>
                              <?php
                                  }
                              ?>
                          </select>
                        </div>
                        <div class="col-sm-4 pl-0">
                          <label for="city">City <?php if(isset($_POST['save']) && !validate_city($_POST)){?> <label class="text-danger">*</label> <?php }?></label>  
                          <select id="city" class="form-control form-control-sm" id="city" name="city" >
                          <option value="None" <?php if(isset($_POST['region'])) { if ($_POST['region'] == 'None') echo ' selected="selected"'; } elseif ($landlord_obj->region == 'None') echo ' selected="selected"'; ?>>--select--</option>
                          <?php
                                require_once '../classes/reference.class.php';
                                $ref_obj = new Reference();
                                $ref = $ref_obj->get_City($provCode);
                                foreach($ref as $row){
                            ?>
                                <option value="<?=$row['citymunCode']?>" <?php if(isset($_POST['city'])) { if ($_POST['city'] == $row['citymunCode']) echo ' selected="selected"'; } elseif ($landlord_obj->city == $row['citymunCode']) echo ' selected="selected"'; ?>><?=$row['citymunDesc']?></option>
                            <?php
                                }
                                ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group-row w-100">
                          <div class="col">
                            <?php if(isset($_POST['identification_document'])) { ?>
                            <label for="identification_document">Identification Document <?php if(isset($_POST['save']) && !validate_image($_POST)){?> <label class="text-danger">*</label> <?php }?></label>
                            <img src="../img/<?php if ($landlord_obj->identification_document) { echo basename($landlord_obj->identification_document); } ?>" height="100px" width="100px">
                            <?php } else { ?>
                            <label for="identification_document">Identification Document <?php if(isset($_POST['save']) && !validate_image($_POST)){?> <label class="text-danger">*</label> <?php }?></label>
                            <input class="form-control form-control-sm" type="file" id="identification_document" name="identification_document" value="<?php if(isset($_POST['identification_document'])) { echo $_POST['identification_document']; } else { echo $landlord_obj->identification_document; }?>">
                            <?php } ?>
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
                          <label for="emergency_contact_person">Full Name <?php if(isset($_POST['save']) && !validate_full_name($_POST)){?> <label class="text-danger">*</label> <?php }?></label>
                          <input class="form-control form-control-sm" type="text" id="emergency_contact_person" name="emergency_contact_person" value="<?php if(isset($_POST['emergency_contact_person'])) { echo $_POST['emergency_contact_person']; } else { echo $landlord_obj->emergency_contact_person; }?>">
                        </div>
                      </div>
                    </div>
                    <div class="form-group-row w-50">
                      <div class="col">
                        <label for="emergency_contact_number">Contact No. <?php if(isset($_POST['save']) && !validate_econtact_no($_POST)){?> <label class="text-danger">*</label> <?php }?></label>
                        <input class="form-control form-control-sm" type="text" id="emergency_contact_number" name="emergency_contact_number" value="<?php if(isset($_POST['emergency_contact_number'])) { echo $_POST['emergency_contact_number']; } else { echo $landlord_obj->emergency_contact_number; }?>">
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