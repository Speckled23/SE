<?php


// Check if "remember me" cookie is set
if(isset($_COOKIE["remember_me"])) {
    // Get the user data from the cookie
    $cookie_data = json_decode($_COOKIE["remember_me"], true);

    // Check if the user data is valid
    if(isset($cookie_data["account_id"]) && isset($cookie_data["username"]) && isset($cookie_data["password"])) {
        // Verify the user credentials
        require_once 'dbconfig.php';
        require_once 'classes/account.class.php';

        $user = new User($conn);
        $login_result = $user->login($cookie_data["username"], $cookie_data["password"]);

        if($login_result["success"]) {
            // User is authenticated, set the session variables
            $_SESSION["account_id"] = $cookie_data["account_id"];
            $_SESSION["username"] = $cookie_data["username"];
        } else {
            // Invalid login credentials, clear the "remember me" cookie
            setcookie("remember_me", "", time() - 3600);
        }
    }
}

?>
