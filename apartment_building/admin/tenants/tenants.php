<?php

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
    //if the above code is false then html below will be displayed

   // require_once '../tools/variables.php';
    $page_title = 'Admin | Tenant ';
    $dashboard = 'active';

    require_once '../includes/header.php';
    require_once '../includes/sidebar.php';
?>

    <div class="home-section">
            <h3 class="table-title">Tenants</h3>
                <?php
                    if($_SESSION['user_type'] == 'admin'){ 
                ?>
                    <a href="add_tenants.php" class="button float-right">Add Tenant</a>
                <?php
                    }
                ?>
                 <table id="tenant-table" class="display">
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Email</th>
      <th>Contact No.</th>
      <th>Leases</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
      require_once '../classes/tenants.class.php';
      $tenants = new Tenants();
      $i = 1;
      foreach ($tenants->show() as $value){
    ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $value['first_name'].''. $value['last_name']?></td>
      <td><?php echo $value['email'] ?></td>
      <td><?php echo $value['contact_no'] ?></td>
      <td><?php echo $value['lease'] ?></td>
      <?php if ($_SESSION['user_type'] == 'admin') { ?>
        <td>
          <div class="action">
             <a class="action-edit" href="view_tenant.php?id=<?php echo $value['id'] ?>">View</a>
            <a class="action-edit" href="edit_tenants.php?id=<?php echo $value['id'] ?>">Edit</a>
            <a class="action-delete" href="delete_tenants.php?id=<?php echo $value['id'] ?>">Delete</a>
          </div>
        </td>
      <?php } ?>
    </tr>
    <?php
      $i++;
      }
    ?>
  </tbody>
</table>

<script>
$(document).ready(function() {
  $('#tenant-table').DataTable();
});
</script>

<?php

    require_once '../includes/footer.php';
?>