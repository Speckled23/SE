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
    $page_title = 'Admin | Leases ';
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
                       <th>Unit Name</th>
                       <th>Type</th>
                       <th>Rent</th>
                       <th>Tenant Name</th>
                       <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once '../classes/leases.class.php';

                        $lease = new Leases();
                        //We will now fetch all the records in the array using loop
                        //use as a counter, not required but suggested for the table
                        $i = 1;
                        //loop for each record found in the array
                        foreach ($lease->show() as $value){ //start of loop
                    ?>
                        <tr>
                            <!-- always use echo to output PHP values -->
                            <td><?php echo $i ?></td>
                            <td><?php echo $value['p_unit_id']?></td>
                            <td><?php echo $value['type'] ?></td>
                            <td><?php echo $value['rent'] ?></td>
                            <td><?php echo $value['tenant_name'] ?></td>
                           
            
                                <td>
                                    <div class="action">
                                        <a class="action-edit" href="editlease.php?id=<?php echo $value['id'] ?>">Edit</a>
                                        <a class="action-delete" href="deletelease.php?id=<?php echo $value['id'] ?>">Delete</a>
                                    </div>
                                </td>
                            <?php
                                }
                            ?>
                        </tr>
                    <?php
                        $i++;
                    //end of loop
                    }
                    ?>
                </tbody>
            </table>
    </div>

<?php

    require_once '../includes/footer.php';
?>