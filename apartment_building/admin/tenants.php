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
    //require_once '../includes/topnav.php';
?>

    <div class="home-content">
    <table class="table">
                <thead>
                    <tr>
                       <th>#</th>
                       <th>Name</th>
                       <th>Email</th>
                       <th>Contact Number</th>
                       <th>Leases</th>
                       <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once '../classes/tenants.class.php';

                        $tenants = new Tenants();
                        //We will now fetch all the records in the array using loop
                        //use as a counter, not required but suggested for the table
                        $i = 1;
                        //loop for each record found in the array
                        foreach ($tenants->show() as $value){ //start of loop
                    ?>
                        <tr>
                            <!-- always use echo to output PHP values -->
                            <td><?php echo $i ?></td>
                            <td><?php echo $value['name']?></td>
                            <td><?php echo $value['email'] ?></td>
                            <td><?php echo $value['contact_num'] ?></td>
                            <td><?php echo $value['lease'] ?></td>
                            <td><?php echo $value['action'] ?></td>
                                <td>
                                    <div class="action">
                                        <a class="#">Edit</a>
                                        <a class="#">Delete</a>
                                    </div>
                                </td>
                            <?php
                                }
                            ?>
                        </tr>
                    <?php
                        $i++;
                    //end of loop
                    ?>
                </tbody>
            </table>
    </div>

<?php

    require_once '../includes/footer.php';
?>