<?php
  require_once '../tools/functions.php';
  require_once '../classes/database.php';
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

    require_once '../tools/variables.php';
    $page_title = 'RMS | Settings';
    $settings = 'active';

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
        <h3 class="font-weight-bolder">SETTINGS</h3> 
      </div>
      <div class="add-page-container">
      </div>
    </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
              <div class="settings">
                  <h5>General</h5>
<ul class="no-bullets settings-content">
  <li><i class="fas fa-clock"></i><a href="#">Date and Time</a></li>
  <li><i class="fas fa-language"></i><a href="#">Language</a></li>
  <li><i class="fas fa-user"></i><a href="#">Profile</a></li>
  <li><i class="fas fa-paint-brush"></i><a href="#">Theme</a></li>
</ul>
  
   
<h5>Billing</h5>
<ul class="no-bullets settings-content">
  <li><i class="fas fa-dollar-sign"></i><a href="#">Adjust Amount</a></li>
  <li><i class="fas fa-file-invoice-dollar"></i><a href="#">Add Bill Type</a></li>
</ul>
    
   
      <h5>Property</h5>
      <ul class="no-bullets settings-content">
        <li><i class="fas fa-luggage-cart"></i><a href="#">Add Features and Amenities</a></li>
      </ul>
  
  <h5>Property Units</h5>
      <ul class="no-bullets settings-content">
        <li><i class="fas fa-building"></i><a href="#">Add Property Unit Condition</a></li>
        <li><i class="fas fa-home"></i><a href="#">Add Property Unit Type</a></li>
      </ul>
    <h5>Manage User</h5>
      <ul class="no-bullets settings-content">
        <li><i class="fas fa-user-plus"></i><a href="#">User Permission</a></li>
      </ul>
    
  </ul>

              </div>
            </div>
  </div>
  </div>
  </div>

</body>