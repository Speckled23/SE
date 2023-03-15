<?php
require_once '../includes/header.php';
require_once '../tools/variables.php';
$page_title = 'Reset Password';
$forgot_password = 'active';

require_once '../includes/dbconfig.php';
require_once '../classes/account.class.php';

$error_msg = '';
$success_msg = '';

    if (isset($_POST['respass'])) {
        $email = $_POST['email'];
        $account_obj = new Account();
        $data = $account_obj->get_account_info_by_email($email);
        if (!empty($data)) {
            // Email exists in the database, display the form to enter a new password
            $_SESSION['account_id'] = $data[0]['id'];
            $success_msg = "Please enter your current password and a new password to reset.";
        } else {
            $error_msg = "The email address you provided does not exist in our system.";
        }
    } elseif (isset($_POST['savepass']) && isset($_SESSION['account_id']) &&  isset($_POST['current_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
        $account_obj = new Account();
        $data = $account_obj->get_account_info($_SESSION['account_id']);
        $current_password = $data[0]['password'];
        if ($_POST['current_password'] && $_POST['new_password'] && $_POST['confirm_password']) {
            $current_password_input = $_POST['current_password'];
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];
            if ($current_password_input != $current_password) {
                $error_msg = "Your current password is incorrect.";
            } else if ($new_password != $confirm_password) {
                $error_msg = "The new passwords you entered do not match.";
            } else {
                $account_id = $_SESSION['account_id'];
                $account_obj->account_reset($account_id, $new_password);
                unset($_SESSION['account_id']);
                //redirect user to login page after resetting password
                header('location: login.php');
                exit;
            }
        }
    }
?>

<body id="fp">
    <main class="py-md-4">
        <div class="container-fluid d-flex align-items-md-center justify-content-md-center">
            <div class="container-fluid fp p-sm-5">
                <?php if (isset($_SESSION['account_id'])): ?>
                    <form action="forgot_pass.php" method="POST" class="needs-validation" id="new-password-form">
                        <div class="row pb-3">
                            <div class="col-12 text-center">
                                <h2 class="fw-bold text-center ff">Reset your password</h2>
                                <p class="lbl text-center ff">
                                    Please enter your current password and a new password.
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <div class="col-12">
                                        <div class="password-container">
                                            <div class="form-group">
                                                <label for="current_password" class="form-label">Current Password<span class="text-muted"></span></label>
                                                <input type="password" class="form-control" id="current_password" name="current_password" placeholder="" required>
                                                <span class="password-toggle-icon text-dark fa fa-eye-slash pt-4"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="password-container">
                                            <div class="form-group">
                                                <label for="new_password" class="form-label">New Password<span class="text-muted"></span></label>
                                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="" required>
                                                <span class="password-toggle-icon text-dark fa fa-eye-slash pt-4"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="password-container">
                                            <div class="form-group">
                                                <label for="confirm_password" class="form-label">Confirm New Password<span class="text-muted"></span></label>
                                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="" required>
                                                <span class="password-toggle-icon text-dark fa fa-eye-slash pt-4"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback ff">
                                        Please enter all required fields and make sure the new passwords match.
                                    </div>
                                    <?php if (!empty($error_msg)): ?>
                                    <div class="alert alert-danger text-center" role="alert">
                                        <?php echo $error_msg; ?>
                                    </div>
                                    <?php endif; ?>
                                    <?php if (!empty($success_msg)): ?>
                                    <div class="alert alert-success text-center" role="alert">
                                        <?php echo $success_msg; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <button class="btn btn-lg btn-success background-color-green btn-continue btn-font" type="submit" name="savepass">Save Password</button>
                            </div>
                        </div>
                    </form>
                    <?php else: ?>
                    <form action="forgot_pass.php" method="POST" class="needs-validation" id="email-form">
                        <div class="row g-3">
                            <div class="col-12 text-center">
                                <h2 class="fw-bold text-center ff">Reset your password</h2>
                                <p class="lbl text-center ff">
                                    Enter your email address and click <span class="fw-bold">Reset Password</span>.
                                </p>
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label">Email Address<span class="text-muted"></span></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="" required>
                                 <div class="invalid-feedback ff">
                                    Please enter a valid email address.
                                </div>
                            </div>
                            <div class="col-12 pt-2 mb-3">
                                <button class="btn btn-lg btn-success background-color-green btn-continue btn-font" type="submit" name="respass">Reset Password</button>
                            </div>
                            <div class="row mt-3">
                                <p class="text-center ff">
                                    Go back to <a class="ff fw-bold" href="login.php"> Login</a>
                                </p>
                            </div>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </main> 


    <script>
        $(function() {
            $('.password-toggle-icon').click(function() {
                var input = $(this).prev('input');
                if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                $(this).removeClass('fa-eye-slash').addClass('fa-eye');
                } else {
                input.attr('type', 'password');
                $(this).removeClass('fa-eye').addClass('fa-eye-slash');
                }
            });
        });
        $.validator.addMethod("currentPasswordMatch", function(value, element) {
            var currentPassword = value;
            var accountId = <?php echo isset($_SESSION['account_id']) ? $_SESSION['account_id'] : 0 ?>;
            var match = false;
            $.ajax({
                url: "forgot_pass.php",
                method: "POST",
                async: false,
                data: {
                    account_id: accountId,
                    password: currentPassword
                },
                success: function(data) {
                    if (data == "match") {
                        match = true;
                    }
                }
            });
            return match;
        }, "The current password you entered is incorrect.");
        
        $('#new-password-form').bootstrapValidator({
            excluded: [':disabled'],
            fields: {
                current_password: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your current password.'
                        },
                        currentPasswordMatch: {
                            message: 'The current password you entered is incorrect.'
                        }
                    }
                },
                new_password: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter a new password.'
                        },
                        identical: {
                            field: 'confirm_password',
                            message: 'The new passwords you entered do not match.'
                        }
                    }
                },
                confirm_password: {
                    validators: {
                        notEmpty: {
                            message: 'Please confirm your new password.'
                        },
                        identical: {
                            field: 'new_password',
                            message: 'The new passwords you entered do not match.'
                        }
                    }
                }
            }
        });


    </script>
</body>