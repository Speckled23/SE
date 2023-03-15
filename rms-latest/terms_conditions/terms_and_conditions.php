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
    $page_title = 'RMS | Terms and Conditions';
    $terms_conditions = 'active';

    require_once '../includes/header.php';
    require_once '../includes/dbconfig.php';


    // Define the rental regulations in an array
    $rental_regulations = array(
        'Payment and Deposit: You agree to pay the rental fee and any applicable deposit at the time of rental. We accept cash and credit card payments. The deposit will be refunded upon the return of the rental equipment in the same condition as it was rented.',
        'Rental Period: The rental period begins at the time of rental and ends at the agreed-upon return time. If you return the equipment late, you will be charged an additional fee.',
        'Use of Equipment: You agree to use the rental equipment only for its intended purpose and in a safe and responsible manner. You are responsible for any damage to the rental equipment during the rental period.',
        'Prohibited Uses: You may not use the rental equipment for any illegal or prohibited activities. You may not sublet or transfer the rental equipment to any other person or entity.',
        'Return of Equipment: You must return the rental equipment in the same condition as it was rented, except for normal wear and tear. If the rental equipment is not returned in a timely manner or is damaged, you may be charged additional fees.',
        'Insurance: You are responsible for insuring the rental equipment against loss, theft, or damage during the rental period.'
    );
    
    // Define the limitation of liability text
    $limitation_of_liability = 'In no event shall Sofiyyah Rentals be liable for any damages arising from the use of our rental equipment, including but not limited to direct, indirect, incidental, punitive, and consequential damages. We do not guarantee the performance of the rental equipment, and we reserve the right to make changes to our rental equipment at any time without notice.';
    
    // Define the lawsuits text
    $lawsuits = 'Any dispute arising from this rental agreement shall be resolved through arbitration in accordance with the laws of the Philippines. You agree to waive your right to a trial by jury and to participate in binding arbitration.';
    
    // Define the termination text
    $termination = 'We reserve the right to terminate your rental agreement at any time without notice, for any reason or no reason, including but not limited to your breach of these terms and conditions.';
    
    // Output the HTML

?>
<body>
    <div class="container-scroller">
        <?php require_once '../includes/navbar.php'; ?>
        <div class="container-fluid page-body-wrapper">
            <?php require_once '../includes/sidebar.php'; ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row mt-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-4 fw-bolder">
                                    RENTAL TERMS AND CONDITIONS
                                </h4>
                                <h5 class="mb-4 fw-bolder">
                                    Welcome to Sofiyyah Rentals!
                                </h5>
                                <p class="mt-4">
                                    These terms and conditions govern your use of our rental services. By using our rental services, you agree to be bound by these terms and conditions. If you do not agree to these terms and conditions, please do not use our rental services.
                                </p>
                                <h6 class="mt-4">
                                    Rental Agreement
                                </h6>
                                <p>
                                    By renting equipment from Sofiyyah Rentals, you agree to the following terms and conditions:
                                </p>

                                <ol class="list-group" type="i">
                                    <?php
                                    // Output the rental regulations as a numbered list
                                    foreach ($rental_regulations as $regulation) {
                                    echo "<li class='list-group-item-0'>$regulation</li>";
                                    }
                                    ?>
                                </ol>
                                <br>
                                <p><?php echo $limitation_of_liability; ?></p>

                                <p><?php echo $lawsuits; ?></p>

                                <p><?php echo $termination; ?></p>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="accept-terms">
                                    <label class="form-check-label" for="accept-terms">
                                        I accept the terms and conditions
                                    </label>
                                </div>

                                <button type="submit" class="btn btn-primary float-right" id="accept-button save" disabled>Submit</button>
                                <button type="button" class="btn btn-secondary float-right" id="decline-button save">I Do Not Accept</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#accept-terms').click(function() {
                if ($(this).is(':checked')) {
                $('#accept-button').prop('disabled', false);
                } else {
                $('#accept-button').prop('disabled', true);
                }
            });
        });

    </script>

