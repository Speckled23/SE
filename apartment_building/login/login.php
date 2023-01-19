<?php
    require_once '../classes/database.php';
    $page_title = 'Login';

    //we start session since we need to use session values
    session_start();
    //creating an array for list of users can login to the system
    $conn=mysqli_connect("localhost","root","","apartment");
     $error="";
    if (isset($_POST['submit'])) {
      //echo "<pre>";
      //print_r($_POST);
      $username=mysqli_real_escape_string($conn,$_POST['username']);
      $password=mysqli_real_escape_string($conn,$_POST['password']);
      $sql=mysqli_query($conn,"select * from user where username='$username' && password='$password'");
      $num=mysqli_num_rows($sql);
      if ($num>0) {
           //echo "found";
           $row=mysqli_fetch_assoc($sql);
           $_SESSION['logged-in'] = $username;
           $_SESSION['fullname']=$row['firstname'] . ' ' . $row['lastname'];
           $_SESSION['type'] = $row['type'];

            header('location: ../admin/dashboard.php');
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

<script>
    const togglePasswordEye = '<i class="fa fa-eye toggle-password-eye"></i>';
const togglePasswordEyeSlash = '<i class="fa fa-eye-slash toggle-password-eye"></i>';

$(togglePasswordEyeSlash).insertAfter('input[type=password]');
$('input[type=password]').addClass('hidden-pass-input')

$('body').on('click', '.toggle-password-eye', function (e) {
    let password = $(this).prev('.hidden-pass-input');

    if (password.attr('type') === 'password') {
        password.attr('type', 'text');
        $(this).addClass('fa-eye').removeClass('fa-eye-slash');
    } else {
        password.attr('type', 'password');
        $(this).addClass('fa-eye-slash').removeClass('fa-eye');
    }
})
</script>