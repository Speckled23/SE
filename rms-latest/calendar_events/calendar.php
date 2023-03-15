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
    $page_title = 'RMS | Calendar Events';
    $calendar_events = 'active';

    require_once '../includes/header.php';
    require_once '../includes/dbconfig.php';
/*     require_once 'add_event.php'; */
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
          <div class="row mt-4">
            <div class="card card-light-blue">
              <p class="fw-bolder mt-3 mb-0 fs-3">CALENDAR</p>
              <div class="card-body">
                <div class="fs-5 mb-2">
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
      jQuery(document).ready(function($) {
          const calendarEl = document.getElementById('calendar');
          const calendar = new FullCalendar.Calendar(calendarEl, {
              initialView: 'dayGridMonth',
              events: 'add_event.php'
          });
          calendar.render();

          $('#add-event-btn').click(function() {
              // Initialize the datepicker on the "start" and "end" inputs
              $('#start, #end').datepicker({
                  dateFormat: 'yy-mm-dd',
                  onSelect: function(dateText) {
                      $(this).val(`${dateText}T14:00:00`); // Assumes a default start time of 2:00 PM
                  }
              });

              // Open the event form when the "Add Event" button is clicked
              $('#event-modal').modal('show');

              // Handle form submission
              $('#event-form').submit(function(event) {
                  event.preventDefault();

                  // Get form values
                  const title = $('#title').val();
                  const start = $('#start').val();
                  const end = $('#end').val();

                  // Create the event object
                  const eventData = {
                      title: title,
                      start: start,
                      end: end
                  };

                  // Send the event to the server
                  $.post('add_event.php', eventData, function(response) {
                      // If the event was added successfully, render it on the calendar
                      if (response.status === 'success') {
                          calendar.addEvent(eventData);
                          $('#event-modal').modal('hide');
                      } else {
                          alert(response.message);
                      }
                  }, 'json');
              });
          });
      });
  </script>


</body>