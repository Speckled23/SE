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
    $page_title = 'Admin | Landlord ';
    $landlord = 'active';

    require_once '../includes/header.php';
    require_once '../includes/sidebar.php';
   
?>

    <div class="home-content">
            <h3 class="table-title">Landlord</h3>
                <?php
                    if($_SESSION['user_type'] == 'admin'){ 
                ?>
                    <a href="add_landlord.php" class="button">Add Landlord</a>
                <?php
                    }
                ?>
                    <table class="table">
                                <thead>
                                    <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact No.</th>
                                    <th>Assigned</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        require_once '../classes/landlord.classes.php';

                                        $landlord = new Landlord();
                                        //We will now fetch all the records in the array using loop
                                        //use as a counter, not required but suggested for the table
                                        $i = 1;
                                        //loop for each record found in the array
                                        foreach ($landlord->show() as $value){ //start of loop
                                    ?>
                                        <tr>
                                            <!-- always use echo to output PHP values -->
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $value['firstname'].''. $value['lastname']?></td>
                                            <td><?php echo $value['email'] ?></td>
                                            <td><?php echo $value['contact_num'] ?></td>
                                            <td><?php echo $value['assigned'] ?></td>
                                            <?php
                                                if($_SESSION['user_type'] == 'admin'){ 
                                            ?>
                                                <td>
                                                    <div class="action">
                                                    <a class="action-edit" href="edit_landlord.php?id=<?php echo $value['id'] ?>">Edit</a>
                                                        <a class="action-delete" href="delete_landlord.php?id=<?php echo $value['id'] ?>">Delete</a>
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