<?php

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

    require_once '../tools/variables.php';
    $page_title = 'RMS | Manage Users';
    $manage_users = 'active';

    require_once '../includes/header.php';
    require_once '../includes/dbconfig.php';
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
        <h3 class="font-weight-bolder">MANAGE USERS</h3> 
      </div>
      <div class="add-tenant-container">
      <?php
                    if($_SESSION['user_type'] == 'admin'){ 
                ?>
     <button type="button" class="btn btn-success btn-icon-text float-right" data-toggle="modal" data-target="#exampleModalCenter">
            Add New User
          </button>
          <?php
                    }
                ?>
      </div>
    </div>
    <div class="row mt-4">
    <div class="card">
                <div class="card-body">
                  <div class="table-responsive pt-3">
                  <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                     <th>#</th>
                     <th>Name</th>
                     <th>Username</th>
                     <th>Role</th>
                     <?php
                                if($_SESSION['user_type'] == 'admin'){ 
                            ?>
                            <th>Action</th>
                            <?php
                                }
                            ?>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
                      <div class="col">
                        <label for="user_name">Name</label>
                        <input  class="form-control form-control-sm " placeholder="Name" type="text" id="user_name" name="user_name" required>
                        <br>
                      </div>
                      <div class="col">
                        <label for="username">Username</label>
                        <input  class="form-control form-control-sm " placeholder="Username" type="text" id="username" name="username" required>
                        <br>
                      </div>
                      <div class="col">
                        <label for="password">Password</label>
                        <input  class="form-control form-control-sm " placeholder="Password" type="password" id="password" name="password" required>
                        <br>
                      </div>
                      <div class="col">
                        <label for="confirm_password">Confirm Password</label>
                        <input  class="form-control form-control-sm " placeholder="Confirm Password" type="password" id="confirm_password" name="confirm_password" required>
                        <br>
                      </div>
                      <div class="col">
                              <label for="role">Role</label>
                              <select id="role" class="form-control form-control-sm" id="role" name="role">
                                <option selected>--Select--</option>
                                <option>Landlord</option>
                                <option>Tenant</option>
                              </select>
                            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Create User</button>
      </div>
    </div>
  </div>
</div>
</form>

<script>
    $('#example').DataTable( {
  responsive: {
    breakpoints: [
      {name: 'bigdesktop', width: Infinity},
      {name: 'meddesktop', width: 1480},
      {name: 'smalldesktop', width: 1280},
      {name: 'medium', width: 1188},
      {name: 'tabletl', width: 1024},
      {name: 'btwtabllandp', width: 848},
      {name: 'tabletp', width: 768},
      {name: 'mobilel', width: 480},
      {name: 'mobilep', width: 320}
    ]
  }
} );
</script>