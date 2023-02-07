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
    $page_title = 'Admin | Dashboard';
    $dashboard = 'active';

    require_once '../includes/header.php';
    require_once '../includes/sidebar.php';
?>

<div class="home-content">
    <div class="dash">
        <div class="greet">
        <div class="dashh">DASHBOARD</div>
        <div class="greetings">Welcome, <?php echo $_SESSION['fullname']?></div>
</div>

        <div class="overview-boxes">
            <div class="box">
                <div class="right-side">
                <div class="number">0</div>
                <i class='bx bx-user cart'></i>
                    <div class="box-topic">Total Tenants</div>
                </div>
            </div>

            <div class="box">
                <div class="right-side">
                <div class="number">0</div>
                <i class='bx bxs-user-rectangle cart two' ></i>
                    <div class="box-topic">Total Landlords</div>
                </div>
            </div>

            <div class="box">
                <div class="right-side">
                <div class="number">0</div>
                <i class='bx bx-building-house cart three'></i>
                    <div class="box-topic">Total Property</div>
                </div>
            </div>

            <div class="box">
                <div class="right-side">
                <div class="number">0</div>
                <i class='bx bx-home-alt-2 cart four'></i>
                    <div class="box-topic">Total Property</div>
                </div>
            </div>
        </div>

        <div class="overview-boxes">
            <div class="box1">
                <div class="right-side">
                    <div class="box-topic">Calendar</div>
                </div>
    </div>

<?php

require_once '../includes/footer.php';
?>