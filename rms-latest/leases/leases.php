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
    $page_title = 'RMS | Leases';
    $leases = 'active';

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
        <h3 class="font-weight-bolder">LEASES</h3> 
      </div>
      <div class="add-tenant-container">
      <?php
                    if($_SESSION['user_type'] == 'admin'){ 
                ?>
      <a href="add_lease.php" class="btn btn-success btn-icon-text float-right">
          Add Lease</a>
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
                     <th>Unit</th>
                     <th>Type</th>
                     <th>Rent</th>
                     <th>Tenant Name</th>
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
        <?php
          $sql=" SELECT lease.*, property_units.unit_no, unit_type.type_name, property_units.monthly_rent, tenant.first_name, tenant.last_name
           FROM lease
           LEFT JOIN property_units ON lease.property_unit_id = property_units.id
           LEFT JOIN unit_type ON lease.property_unit_id = unit_type.id
           RIGHT JOIN tenant ON lease.tenant_id = tenant.id 
           WHERE tenant_id=tenant.id";
          $result = mysqli_query($conn, $sql);
          $i = 1;
          if (mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_assoc($result)){

              echo '
              <tr>
                <td>'.$i.'</td>
                <td>'.$row['unit_no'].'</td>
                <td>'.$row['type_name'].'</td>
                <td>'.$row['monthly_rent'].'</td>
                <td>'.$row['last_name'].','.$row['first_name'].'</td>
                <td>
                  <div class="action">
                    <a class="me-2 green" href="view_lease.php?id='.$row['id'].'"><i class="fas fa-eye"></i></a>
                    <a class="me-2 green" href="edit_lease.php?id='.$row['id'].'"><i class="fas fa-edit"></i></a>
                    <a class="green action-delete" href="delete_lease.php?id='.$row['id'].'"><i class="fas fa-trash"></i></a>
                  </div>
                </td>
              </tr>';
              $i++;
            }
            }
          ?>
        </tbody>
    </table>
    </div>
    </div>

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
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<div id="delete-dialog" class="dialog" title="Delete Lease">
    <p><span>Are you sure you want to delete the lease record?</span></p>
</div>

<script>
    $(document).ready(function() {
        $("#delete-dialog").dialog({
            resizable: false,
            draggable: false,
            height: "auto",
            width: 500,
            modal: true,
            autoOpen: false
        });

        // Change the background colors of the Yes and Cancel buttons using Bootstrap classes
        $("#delete-dialog").dialog('option', 'buttons', {
            "Yes" : {
                text: "Yes",
                class: "btn btn-danger",
                click: function() {
                    window.location.href = $(this).data("href");
                }
            },
            "Cancel" : {
                text: "Cancel",
                class: "btn btn-secondary",
                click: function() {
                    $(this).dialog("close");
                }
            }
        });

        $(".action-delete").on('click', function(e) {
            e.preventDefault();
            $("#delete-dialog").data("href", $(this).attr("href")).dialog("open");
        });
    });
</script>