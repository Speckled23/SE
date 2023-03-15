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
    $page_title = 'RMS | Invoices';
    $invoices = 'active';

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
        <h3 class="font-weight-bolder">PAY INVOICE</h3> 
      </div>
      <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
                <div class="col-md-6">
                    <div class="row">
                      <div class="col">
                      <h4 class="font-weight-bolder">PAD 1</h4> 
                        <p>Tenant Name: Monica Geller</p>
                        <p>Email: monica@gmail.com</p>
                        <p>Contact No: 09123456789</p>
                      </div>
                    </div>
                  </div> 

</div>
</div>
</div>
<div class="col-6 grid-margin">
      <div class="card">
        <div class="card-body">
        <h4 class="card-title">Bills Payable</h4>
                    <div class="form-group">
                      <label for="rent_paid">Monthly Rent</label>
                      <input type="number" class="form-control" id="monthly_rent" placeholder="(default)"disabled>
                    </div>
                    <div class="form-group">
                      <label for="rent_paid">Electricity</label>
                      <input type="number" class="form-control" id="monthly_rent" placeholder="(default)"disabled>
                    </div>
                    <div class="form-group">
                      <label for="rent_paid">Water</label>
                      <input type="number" class="form-control" id="monthly_rent" placeholder="(default)"disabled>
                    </div>
                    <div class="form-group">
                      <label for="rent_paid">Penalty</label>
                      <input type="number" class="form-control" id="monthly_rent" placeholder="(default)"disabled>
                    </div>
                    <div class="form-group">
                      <label for="rent_paid">Balance</label>
                      <input type="number" class="form-control" id="monthly_rent" placeholder="(default)"disabled>
                    </div>
        </div>
</div>
</div>

<div class="col-6 grid-margin">
      <div class="card">
        <div class="card-body">
        <h4 class="card-title">Pay Here</h4>
                    <div class="form-group">
                      <label for="rent_paid">Total Amount to Pay</label>
                      <input type="number" class="form-control" id="monthly_rent" placeholder="(default)"disabled>
                    </div>
                    <div class="form-group">
                      <label for="rent_paid">Amount Paid</label>
                      <input type="number" class="form-control" id="monthly_rent" placeholder="">
                    </div>
                    <button type="submit" class="btn btn-primary float-right mr-2">Pay Now</button>
        </div>
</div>
</div>








</div>
</div>
</div>
</div>
</div>
      