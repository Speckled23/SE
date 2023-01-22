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
    <div class="login-container">
        <form class="login-form" action="login.php" method="post">

            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter username" required tabindex="1">
            <label for="password">Password</label>
            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required autocomplete="current-password" required tabindex="2">
            <input class="button" type="submit" value="Login" name="submit" tabindex="3">
            <?php
                //Display the error message if there is any.
                if(isset($error)){
                    echo '<div><p class="error">'.$error.'</p></div>';
                }
            ?>
        </form>
    </div>
<?php
    require_once '../includes/footer.php';
?>
