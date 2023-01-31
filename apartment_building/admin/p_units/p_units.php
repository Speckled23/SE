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
    $page_title = 'Admin | Property Units ';
    $dashboard = 'active';

    require_once '../includes/header.php';
    require_once '../includes/sidebar.php';
    require_once '../includes/topnav.php';
?>

    <div class="home-content">
    <h3 class="table-title">Property Units</h3>
                <?php
                    if($_SESSION['user_type'] == 'admin'){ 
                ?>
                    <a href="add_p_units.php" class="button">Add Property Units</a>
                <?php
                    }
                ?>
    <table class="table">
                <thead>
                    <tr>
                       <th>#</th>
                       <th>Unit</th>
                       <th>Condition</th>
                       <th>Rent</th>
                       <th>Main Property</th>
                       <th>Status</th>
                       <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once '../classes/p_units.classes.php';

                        $p_units = new P_units();
                        //We will now fetch all the records in the array using loop
                        //use as a counter, not required but suggested for the table
                        $i = 1;
                        //loop for each record found in the array
                        foreach ($p_units->show() as $value){ //start of loop
                    ?>
                        <tr>
                            <!-- always use echo to output PHP values -->
                            <td><?php echo $i ?></td>
                            <td><?php echo $value['unit_name']?></td>
                            <td><?php echo $value['unit_condition'] ?></td>
                            <td><?php echo $value['rent'] ?></td>
                            <td><?php echo $value['main_property'] ?></td>
                            <td><?php echo $value['unit_condition'] ?></td>
                            <?php
                           if($_SESSION['user_type'] == 'admin'){ 
                            ?>
                                <td>
                                    <div class="action">
                                    <a class="action-edit" href="edit_p_units.php?id=<?php echo $value['id'] ?>">Edit</a>
                                        <a class="action-delete" href="delete_p_units.php?id=<?php echo $value['id'] ?>">Delete</a>
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



