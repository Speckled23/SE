<?php
    require_once '../admin/classes/database.php';
    $page_title = "Log-in";

    //we start session since we need to use session values
    session_start();
    //creating an array for list of users can login to the system
    $conn=mysqli_connect("localhost","root","","apartment");  
     $error="";
    if (isset($_POST['submit'])) { 
      //echo "<pre>"
      //print_r($_POST);
      $username=mysqli_real_escape_string($conn,$_POST['username']);  
      $password=mysqli_real_escape_string($conn,$_POST['password']);  
      $sql=mysqli_query($conn,"select * from user where username='$username' && password='$password'");  
      $num=mysqli_num_rows($sql);
      if ($num>0) {
           //echo "found";

            $row=mysqli_fetch_assoc($sql);
            $_SESSION['logged-in'] = $username;
            $_SESSION['fullname']=$row['name'];
            $_SESSION['user_type'] = $row['role'];

           if($_SESSION['user_type']== 'admin'){
            header('location: ../admin/admin/dashboard.php');
           }if($_SESSION['user_type']== 'landlord'){
            header('location: ../landlord/landlord.php');
           }elseif($_SESSION['user_type']== 'tenant'){
            header('location: ../tenant/tenant.php');
           }

      }
        //set the error message if account is invalid
        $error = 'Invalid username/password. Try again.';
    }



    require_once '../admin/includes/header.php';

?>
<body class="vh-100 gradient-custom">
    <section>
        <div class="fs-4">
            <div class="cardd text-white">
                <div class="p-4 text-center">
                    <h3 class="fs-1 mb-5">Welcome!</h3>
                    <form action="login.php" class="text-white" method="post">
                        <div class="row justify-content-center align-items-center h-100">
                            <div class="text-white">
                            <div class="card-body">
                                <input type="text" name="username" id="tran" class="text-white " placeholder="Username" required tabindex="1" />
                            </div>
                            <div class=" mb-4 card-body">
                                <input type="password" name="password" id="tran" class="text-white " placeholder="Password" required autocomplete="current-password" required tabindex="2"/>
                                <i class="bi bi-eye-slash" id="togglePassword"></i>
                           </div>
                            <div class="fs-6 mb-4 mx-5 d-flex justify-content-start text-white">
                                <label>
                                    <input type="checkbox" name="remember" id="check"> Remember me
                                </label>
                            </div>
                            <button type="submit" class="px-6 mb-1 btncol text-white width" value="Login" name="submit" tabindex="3">Login</button><br>
                            <a href="" class="fs-6 text-dark no-underline text-white">Forgot Password?</a>
                            <?php
                                //Display the error message if there is any.
                                if(isset($error)){
                                    echo '<div><p class="error">'.$error.'</p></div>';
                                }
                            ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php
    require_once '../admin/includes/footer.php';
?>
    <script>
        const togglePassword = document
            .querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', () => {
            // Toggle the type attribute using
            // getAttribure() method
            const type = password
                .getAttribute('type') === 'password' ?
                'text' : 'password';

            password.setAttribute('type', type);
            // Toggle the eye and bi-eye icon
            this.classList.toggle('fa-eye');
        });
    </script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
