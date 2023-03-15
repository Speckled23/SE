<?php
  require_once '../includes/dbconfig.php';
  require_once '../tools/functions.php';
  require_once '../classes/properties.class.php';

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

  if(isset($_POST['property_save'])){
      $property_obj = new Properties();
      //sanitize user inputs
      $property_obj->property_name = htmlentities($_POST['property_name']);
      $property_obj->property_description = htmlentities($_POST['property_description']);
      $property_obj->num_of_floors = htmlentities($_POST['num_of_floors']);
      $property_obj->landlord_id = htmlentities($_POST['landlord']);
      $property_obj->region = htmlentities($_POST['region']);
      $property_obj->provinces = htmlentities($_POST['provinces']);
      $property_obj->city = htmlentities($_POST['city']);
      $property_obj->barangay = htmlentities($_POST['barangay']);
      $property_obj->street = htmlentities($_POST['street']);
      $property_obj->features_description = htmlentities($_POST['features_description']);
      $property_obj->features = isset($_POST['features']) ? $_POST['features'] : array();
    
      if (isset($_FILES['image_path'])) {
        $image = $_FILES['image_path']['name'];
        $target = "../img/" . basename($image);
    
        if (move_uploaded_file($_FILES['image_path']['tmp_name'], $target)) {
            $property_obj->image_path = $_FILES['image_path']['name'];
        } else {
            // handle file upload error
            $msg = "Error uploading file";
        }
      }
    
      // Add property to database
        if ($property_obj->properties_add()) {
          header('Location: properties.php');
          exit; // always exit after redirecting
        } else {
          // handle property add error
          $msg = "Error uploading file";
        }
      }
  

    
    require_once '../tools/variables.php';
    $page_title = 'RMS | Add Leasd';
    $properties = 'active';
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
        <h3 class="font-weight-bolder">ADD LEASE</h3> 
      </div>
      <div class="add-page-container">
        <div class="col-md-2 d-flex justify-align-between float-right">
          <a href="leases.php" class='bx bx-caret-left'>Back</a>
        </div>
      </div>
    </div>
          <div class="row">
          <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Lease Contract</h4>
                                <div class="row">
                               <div class="form-group col-md-12">
                              <label for="property_picture">Upload Lease Document</label>
                              <input class="form-control form-control-lg" type="file" id="property_picture" name="property_picture">
                              </div>
                          </div>
                            </div>
                          </div>
                        </div>
                       
          <!--   <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Billing Inclusion</h4>
                            <div class="row">
                              <div class="form-group col-12 col-sm-6">
                                <label for="electricity" class="d-flex align-items-center">Electricity</label>
                                <input type="number" class="form-control" id="electricity" placeholder="enter amount">
                              </div>
                              <div class="form-group col-12 col-sm-6">
                                <label for="water" class="d-flex align-items-center">Water</label>
                                <input type="number" class="form-control" id="water" placeholder="enter amount">
                              </div> 
                            </div>
                          </div>
              </div>
            </div> -->
                     
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  
                  <h4 class="card-title">Create Lease</h4>
                  <form class="forms-sample">
                    <div class="form-group">
                      <label for="property_unit_name">Property Unit No.</label><span class="req"> *</span>
                      <select name="property_unit_name" id="property_unit_name" class="form-select">
                        <option value="">-- Select --</option>
                          <!-- Populate this select with the list of property units -->
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="monthly_rent">Monthly Rent</label>
                      <input type="number" class="form-control" id="monthly_rent" placeholder="Monthly Rent (default)"disabled>
                    </div>
                    <div class="form-group">
                    <label for="tenant_name">Tenant Name</label><span class="req"> *</span>
                      <select name="tenant_name" id="tenant_name" class="form-select">
                        <option value="">-- Select --</option>
                          <!-- Populate this select with the list of property units -->
                      </select>
                    </div>
                    <div class="form-group">
                    <label for="start_date">Start Date</label><span class="req"> *</span>
                    <div class="input-group">
                      <input type="date" class="form-control" placeholder="Start Date" aria-label="start_date">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="end_date">End Date</label><span class="req"> *</span>
                    <div class="input-group">
                      <input type="date" class="form-control" placeholder="End Date" aria-label="end_date">
                    </div>
                  </div>
                    <button type="submit" class="btn btn-primary float-right mr-2">Save Lease</button>
                </div>
              </div>
           

            
                       
                </form>
              </body>