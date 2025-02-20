<?php require("../../app/init.php") ?>
<?php require("../auth/auth.php") ?>
<?php

CSRF('verify');

if(isset($_POST['newPassword'])){

    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($newPassword !== $confirmPassword) {
        toast("error", "Passwords do not match.");
        die();
    }

    $hashedPassword = HASH_PASSWORD($newPassword);
    
    // Verify the new password if no changes made
    if (VERIFY_PASSWORD($newPassword, $user['password'])) die(toast("error", "No changes made to password."));

    $data = array(
        "password" => $hashedPassword, 
    );

    $update_password = $DB->UPDATE("users", $data,["user_id" => AUTH_USER_ID]);
    if (!$update_password === "success") die(toast("error", "Failed to update password"));

    toast("success", "Password updated successfully");
    die(Redirect("../api/auth/logout.php", 2000));  

}else{
    die(toast('error', 'Invalid server request'));
}