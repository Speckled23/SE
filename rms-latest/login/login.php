<?php
  session_start();

  $page_title = 'Login';
  require_once '../includes/dbconfig.php';


  if(isset($_POST['email']) && isset($_POST['password'])){
    //Sanitizing the inputs of the users. Mandatory to prevent injections!
    $email = htmlentities($_POST['email']);
    $password = htmlentities($_POST['password']);
    $sql ="SELECT * FROM account WHERE email ='$email' AND password ='$password'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
       
        while($row = mysqli_fetch_assoc($result)){  

            $_SESSION['logged_id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_type'] = $row['type'];
            //display the appropriate dashboard page for user
            if($_SESSION['user_type'] == 'admin'){
                header('location: ../admin/dashboard.php');
            }
            if($_SESSION['user_type'] == 'tenant'){
                header('location: ../atenant-dash/dashboard.php');
            }
        }
    }else{
        //set the error message if account is invalid
        $error = 'Invalid username/password. Try again.';
    }
  }
  require_once '../includes/header.php';
?>
<body id="sign-up">
    <main class="py-md-4">
        <div class="container-fluid d-flex align-items-md-center justify-content-md-center">
            <div class="container-fluid sign-in p-sm-5 align-items-md-center">
                <div class="row">
                    <div class="col">
                        <h2 class="fw-bold text-center green">Welcome!</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <form class="needs-validation mt-3" action="login.php" method="post">
                            <div class="row g-3">
                                <div class="col-12">
                                    <input type="text" class="log-control text-light" id="email" placeholder="Email" name="email" required>
                                    <div class="invalid-feedback">
                                        Please enter a valid email address.
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="password-container">
                                        <input type="password" class="log-control text-light" id="password" name="password" placeholder="Password" required>
                                        <span class="password-toggle-icon text-light fa fa-eye-slash"></span>
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter a valid password.
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check form-check-inline me-0">
                                        <input class="form-check-input" type="checkbox" id="remember-me" name="remember_me" value="1">
                                        <label class="form-check-label" for="remember-me">Remember me
                                            <?php
                                            require_once 'remember_me.php'; 
                                            ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 pt-2 mb-3">
                                    <input class="btn btn-lg btn-success background-color-green btn-continue btn-font" type="submit" value="Login" name="login"  id="login-button">
                                </div>
                                <div class="form-check form-check-inline me-0 mt-0">
                                        <a class="green text-decoration-none text-center" href="forgot_pass.php?reset=yes">Forgot password?</a>
                                    </div>
                                <?php
                                    //Display the error message if there is any.
                                    if(isset($error)){
                                        echo '<div><p class="error">'.$error.'</p></div>';
                                    }
                                    
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
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
        document.getElementById('login-button').addEventListener('keypress', function(e){
            if (e.keyCode === 13) { //13 is the Enter key code
            e.preventDefault();
            this.form.submit();
            }
        });
        </script>

</body>


