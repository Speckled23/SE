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
    $page_title = 'RMS | Add Property';
    $properties = 'active';
    require_once '../includes/header.php';
?>
<head>
  <link rel="stylesheet" href="../css/form-wizard.css">
</head>
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
              <h3 class="font-weight-bolder">ADD PROPERTY</h3> 
            </div>
            <div class="add-page-container">
              <div class="col-md-2 d-flex justify-align-between float-right">
                <a href="properties.php" class='bx bx-caret-left'>Back</a>
              </div>
            </div>
            <div class="d-flex">
              <span class="step rounded pt-3 pb-2 text-center">Basic Details</span>
              <span class="step rounded pt-3 pb-2 text-center">Location</span>
              <span class="step rounded pt-3 pb-2 text-center">Features</span>
              <span class="step rounded pt-3 pb-2 text-center">Images</span>
            </div>
            <form action="properties.php" id="regForm" method="post" enctype="multipart/form-data">
              <div class="col-12">
                <div class="tab">
                  <div class="row g-3">
                    <h4 class="card-title fw-bolder">Property Details</h4>
                    <div class="col-md-6">
                      <div class="form-group-row">
                        <div class="col">
                        <label for="property_name">Property Name</label>
                        <input class="form-control form-control-sm req" type="text" id="property_name" name="property_name">                              
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group-row">
                        <div class="col">
                          <div class="col-lg-12">
                            <label for="property_description">Description of the Property</label>
                            <textarea class="form-control form-control-lg" id="property_description" name="property_description"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group-row">
                        <div class="col">
                            <label for="landlord">Select Landlord</label>
                            <select class="form-control form-control-sm mb-3 req" id="landlord" name="landlord">
                              <option class="col-md-6" value="" disabled selected>Select Landlord</option>
                                <?php
                                  // Connect to the database and retrieve the list of landlords
                                  $result = mysqli_query($conn, "SELECT id, last_name, first_name FROM landlord");
                                  while ($row = mysqli_fetch_assoc($result)) {
                                  
                                    echo "<option value='" . $row['id'] . "'>" . $row['last_name'] . "," .$row['first_name']."</option>";
                                  }
                                ?>
                            </select>
                          </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group-row">
                          <div class="col">
                            <label for="num_of_floors">Number of Floors</label>
                            <input class="form-control form-control-sm req" type="number" id="num_of_floors" name="num_of_floors" min="1" max="100">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 grid-margin">
                <div class="tab">
                  <div class="row g-3">
                    <h4 class="card-title fw-bolder">Property Details</h4>
                    <div class="w-100">
                      <div class="mar d-flex">
                        <div class="col-sm-3">
                          <label for="region">Region</label>
                          <select type="text" class="form-control form-control-sm req" name="region" id="region" placeholder="" > 
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
                        <div class="col-sm-3">
                          <label for="provinces">Provinces</label>
                          <select id="provinces" class="form-control form-control-sm req" id="provinces" name="provinces">
                            <option value="none">--Select--</option>
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
                        <div class="col-sm-3">
                          <label for="city">City</label>
                          <select id="city" class="form-control form-control-sm req" id="city" name="city" >
                            <option value="none">--Select--</option>
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
                      <div class="mar d-flex pt-3">
                        <div class="col-sm-5">
                          <label for="barangay">Barangay</label>
                          <select class="form-control form-control-sm req" name="barangay" id="barangay"> 
                            <option value="none">--Select--</option>
                            <?php
                                  require_once '../classes/reference.class.php';
                                  $ref_obj = new Reference();
                                  $ref = $ref_obj->get_brgy($citymunCode);
                                  foreach($ref as $row){
                              ?>
                                      <option value="<?=$row['brgyCode']?>"><?=$row['brgyDesc']?></option>
                              <?php
                                  }
                              ?>
                          </select>
                        </div>
                        <div class="col-sm-5">
                          <div class="form-group-row">
                            <label for="street">Street</label>
                            <input class="form-control form-control-sm req" type="text" id="street" name="street" value="">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 grid-margin">
                <div class="tab">
                  <div class="row g-3">
                    <h4 class="card-title fw-bolder">Property Details</h4>
                    <div class="w-100">
                      <div class="form-group">
                        <div class="col d-flex">
                          <div class="col-lg-12">
                              <label for="features_description">Description of the Features</label>
                              <textarea class="form-control form-control-lg" id="features_description" name="features_description"></textarea>
                          </div>
                      </div>
                    </div>
                    <div class="w-100">
                      <div class="form-group-row">
                        <div class="col d-flex">
                          <div class="col-lg-12">
                            <p>Check box if features are allowed:</p>
                              <?php
                                // Connect to the database and retrieve the list of features
                                $result = mysqli_query($conn, "SELECT id, feature_name FROM features");
                                echo "<div class='row p-3'>";
                                while ($row = mysqli_fetch_assoc($result)) {
                                  echo "
                                    <div class='col-sm-3 text-dark fs-6 h-25'>
                                      <input type='checkbox' class='checkmark req' id='feature" . $row['id'] . "' name='features[]' value='" . $row['id'] . "'>" .
                                      "<label class='feature'  for='feature" . $row['id'] . "'>" . $row['feature_name'] . "</label><br>
                                    </div>
                                    ";
                                }
                                echo"</div>";
                              ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 grid-margin">
                <div class="tab">
                  <div class="row g-3">
                    <h4 class="card-title fw-bolder">Property Details</h4>
                      <div class="pt-4">
                        <label for="image_path">Upload a picture of the property:</label>
                        <input class="form-control form-control-lg" type="file" id="image_path" name="image_path">
                      </div>
                  </div>
                </div>
              </div>
              <div style="overflow:auto;">
                <div style="float:right;">
                  <button type="button" class="btn btn-secondary" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                  <button type="" class="btn btn-primary" id="nextBtn" name="property_save" onclick="nextPrev(1)">Next</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

    <script>
    // Initialize the form wizard
    var currentStep = 0;
    showStep(currentStep);

    // Function to show the current step of the form wizard
    function showStep(stepIndex) {
    var steps = document.getElementsByClassName("tab");
    steps[stepIndex].style.display = "block";
    if (stepIndex == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (stepIndex == (steps.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Save";
        document.getElementById("nextBtn").type = "submit";
    } else {
        document.getElementById("nextBtn").innerHTML = "Next";
        document.getElementById("nextBtn").type = "button";
    }
    }
    // Function to move to the next or previous step of the form wizard
    function nextPrev(step) {
    var steps = document.getElementsByClassName("tab");
    if (step > 0 && !validateStep(currentStep)) {
        return false;
    }
    steps[currentStep].style.display = "none";
    currentStep += step;
    if (currentStep >= steps.length) {
        saveData();
        return false;
    }
    showStep(currentStep);
}

    
    // Function to validate the current step of the form wizard
    function validateStep(stepIndex) {
    var isValid = true;
    var form = document.getElementById("regForm");
    var formData = new FormData(form);
    switch (stepIndex) {
        case 0:
        var propertyName = formData.get('property_name');
        if (propertyName === '') {
            alert('Please enter a property name.');
            isValid = false;
        }
        break;
        case 1:
        var region = formData.get('region');
        if (region === 'none') {
            alert('Please select a region.');
            isValid = false;
        }
        var provinces = formData.get('provinces');
        if (provinces === 'none') {
            alert('Please select a province.');
            isValid = false;
        }
        var city = formData.get('city');
        if (city === 'none') {
            alert('Please select a city.');
            isValid = false;
        }
        var barangay = formData.get('barangay');
        if (barangay === 'none') {
            alert('Please select a barangay.');
            isValid = false;
        }
        var street = formData.get('street');
        if (street === '') {
            alert('Please enter a street name.');
            isValid = false;
            }
            break;
            case 2:
            var features = formData.getAll('features[]');
            if (features.length === 0) {
            alert('Please select at least one feature.');
            isValid = false;
            }
            break;
            }
            return isValid;
            }

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
    $('#city').on('change', function(){
            var formData = {
                filter: $("#city").val(),
                action: 'barangay',
            };
            $.ajax({
                type: "POST",
                url: '../includes/address.php',
                data: formData,
                success: function(result)
                {
                    console.log(formData);
                    console.log(result);
                    $('#barangay').html(result);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }  
            });
    });
    </script>

</body>

