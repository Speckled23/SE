<?php
    //we start session since we need to use session values
    session_start();

    //require_once '../tools/variables.php';
    require_once '../classes/accounts.class.php';
    $page_title = 'Apartment - Login';
   // $faculty = 'active';

    if(isset($_POST['username']) && isset($_POST['password'])){
        $accounts = new Accounts;
        //Sanitizing the inputs of the users. Mandatory to prevent injections!
        $username = htmlentities($_POST['username']);
        $password = htmlentities($_POST['password']);
        //check if the username and password match in the database
        if ($accounts->check($username, $password)){
            $data = $accounts->check($username, $password);
            $accounts->id = $data['id'];
            $accounts->name = $data['name'];
            $accounts->role = $data['role'];
            $accounts->username = $data['username'];
            $accounts->password = $data['password'];
        }

        if($username == $accounts->username && $password == $accounts->password){
            //if match then save username, fullname and type as session to be reused somewhere else
            $_SESSION['logged-in'] = $accounts->username;
            $_SESSION['name'] = $accounts->name;
            $_SESSION['role'] = $accounts->role;
            //display the appropriate dashboard page for user
            if($value['role'] == 'admin'){
                header('location: ../admin/dashboard.php');
            }
            if($value['role'] == 'landlord'){
                header('location: ../landlord/landlord.php');
            }
            else{
                header('location: ../admin/dashboard.php');
            }
        }
        //set the error message if account is invalid
        $error = 'Invalid username/password. Try again.';
    }

    require_once '../includes/header.php';

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
    require_once '../includes/footer.php';
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
