<?php require("../../app/init.php") ?>
<?php require("../auth/auth.php") ?>
<?php

CSRF('verify');

if(isset($_POST['user_id'], $_POST['newPassword'])){

    // Ensure required fields are present
    if (!isset($_POST['user_id']) || !isset($_POST['newPassword']) || !isset($_POST['confirmPassword'])) {
        die(toast("error", "Missing required fields."));
    }

    $user_id = $_POST['user_id'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validate that the user exists before proceeding
    $user = $DB->SELECT_ONE_WHERE('users', '*', ['user_id' => $user_id]);
    if (!$user) {
        die(toast("error", "User not found."));
    }

    // Ensure passwords match
    if ($newPassword !== $confirmPassword) {
        die(toast("error", "Passwords do not match."));
    }

    // Hash the new password
    $hashedPassword = HASH_PASSWORD($newPassword);

    // Verify the new password if no changes made
    if (VERIFY_PASSWORD($newPassword, $user['password'])) die(toast("error", "No changes made to password."));

    // Update password in the database
    $data = ["password" => $hashedPassword, "updated_at" => DATE_TIME];
   
    $update_password = $DB->UPDATE("users", $data,["user_id" => $user_id]);
    if (!$update_password) die(toast("error", "Failed to update the password."));

    toast("success", "Password updated successfully.");
    die(refresh(2000));

}else{
    die(toast("error", "Invalid server request."));
}