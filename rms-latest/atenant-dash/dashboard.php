<?php

    //resume session here to fetch session values
    session_start();
    /*
        if user is not login then redirect to login page,
        this is to prevent users from accessing pages that requires
        authentication such as the dashboard
    */

    //if the above code is false then html below will be displayed

  $current_month = date('F', strtotime('now'));
  $_SESSION['current_month'] = $current_month;


    require_once '../tools/variables.php';
    $page_title = 'RMS | Test Dashboard';
    $dashboard = 'active';

    require_once '../includes/header.php';
    
?>
<body>
  <div class="container-scroller">
      <?php
        require_once '../includes/navbar.php';
      ?>
    <div class="container-fluid page-body-wrapper">
      <?php
          require_once 'sidebar.php';
        ?>
      <div class="main-panel">
            <div class="content-wrapper">
              <div class="row">
                <div class="col-md-12 grid-margin">
                <div class="row">
                  <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">DASHBOARD</h3>
                    <h6 class="font-weight-normal mb-0"><?php echo "<div class='text-capitalize'> Welcome, {$_SESSION['username']}!</div>" ?></h6>
                  </div>
                </div>
              </div>       
              <div class="add-tenant-container">
                <div class="add-tenant-container">
                </div>
              </div>
            </div>         
              <div class="row">
                <div class="col-md-12 order-md-2 transparent d-flex">
                  <div class="row flex-row">
                    <div class="col-md-12 mb-4 stretch-card transparent">
                      <div class="card card-tale">
                        <div class="card-body white-text">
                          <span class="bx bx-user icons d-flex flex-row flex-wrap justify-content-between align-items-center"><p class="fs-30 mb-2 ff fs-35 pl-5 fw-bolder">0</p></span>
                          <p class="mb-1 pt-3 fw-bolder">Pending Tickets </p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 mb-4 stretch-card transparent">
                      <div class="card card-dark-blue">
                        <div class="card-body white-text">
                          <span class="bx bxs-user-rectangle icons d-flex flex-row flex-wrap justify-content-between align-items-center"><p class="fs-30 mb-2 ff fs-35 pl-5 fw-bolder">0</p></span>
                          <p class="mb-1 pt-3 fw-bolder">Closed Tickets</p>
                        </div>
                      </div>
                    </div>
                    </div>
                    <div class="col-md-6 stretch-card grid-margin grid-margin-md-1 mt-5">
                      <div class="card card-light-green">
                        <div class="card-body white-text mb-0 ">
                          <p class="mb-3 mt-2 fw-bolder">BALANCE</p>
                          <div class="row">
                            <h2 class="fw-bolder"> ₱ 0</h2>
                            <p class="text-white font-weight-500 mb-0">Balamce for the month of <?php echo $_SESSION['current_month']; ?> </p>
                          </div>
                          <div class="d-flex justify-content-end">
                            <button type="button" class="view-button">View</button>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
          <div class="col-md-6 order-md-1 grid-margin">
            <div class="card card-light-blue">
              <div class="card-body">
                  <p class="fw-bolder mb-0 fs-5">CALENDAR</p>
                  <div id='calendar'></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>

    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          events: 'events.php'
        });
        calendar.render();
      });

    </script>
    
</body>

