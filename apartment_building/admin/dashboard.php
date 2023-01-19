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
    //require_once '../includes/topnav.php';
?>

    <div class="home-content">
            <header> Welcom Admin!!</header>

            <li>
                <ul>
                    <th>this part is for the pending ticket</th>
                    <th>this part is for the numbe of tickets</th>
                    <th>this part is for the tenants</th>
                </ul>
            </li>

            <div class = "calendar"> this part is for the calensar</div>
    </div>

<?php

    require_once '../includes/footer.php';
?>