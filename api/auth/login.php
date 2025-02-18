<?php sleep(1) ?>
<?php require("../../app/init.php") ?>
<?php require("jwt.php") ?>

<?php

CSRF('verify');

// Check if the request is POST
if (isset($_POST['username']) AND isset($_POST['password'])) {
    
    $username = $DB->ESCAPE(VALID_STRING($_POST['username']));
    $password = VALID_PASS($_POST['password']);

    if (empty($username) || empty($password)) {
        die(Toast("error", "Email or password empty"));
    }

    // Fetch user from the database
    $user = $DB->SELECT_ONE("users", "*", "WHERE username = '$username' OR email = '$username'");

    if (empty($user)) die(Toast("error", "Oops! email or username is invalid"));
    
    // Verify password
    if (!VERIFY_PASSWORD($password, $user['password'])) {
        die(Toast("error", "Incorrect password"));
    }

    // Generate JWT
    $jwt = new JWT("this-is-not-a-secure-secret-key-token");
    $user_token = $jwt->createToken([
        "user_id"  => $user['user_id'],
        "username" => $user['username'],
        "email"    => $user['email']
    ]);

    // Set cookie
    $expiry = strtotime('+1 month');
    if (!setcookie("_xsrf-token", $user_token, $expiry, "/"))
        die(Toast("error", "Failed to set cookie"));

    $DB->UPDATE("users", ["last_login" => DATE_TIME], ["user_id" => $user['user_id']]);

    // Login successful
    Toast("success", "Successfully logged in");
    Redirect("/dashboard", 1000);

}else{
    die(Toast("error", "Invalid server request"));
}
