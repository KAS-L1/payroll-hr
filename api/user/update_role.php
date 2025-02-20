<?php require("../../app/init.php") ?>
<?php require("../auth/auth.php") ?>
<?php

CSRF('verify');

if(isset($_POST['user_id'], $_POST['role'])){
    
    // Ensure required fields are present
    if (!isset($_POST['user_id']) || !isset($_POST['role'])) {
        die(toast("error", "Missing user ID or role."));
    }

    $user_id = $_POST['user_id'];
    $new_role = $_POST['role'];

    // Validate user existence
    $user = $DB->SELECT_ONE_WHERE('users', 'user_id, role', ['user_id' => $user_id]);
    if (!$user) {
        die(toast("error", "User not found."));
    }

    // Define allowed roles (to prevent unauthorized role assignments)
    $allowed_roles = ['Admin', 'Hr', 'Finance'];

    if (!in_array($new_role, $allowed_roles)) {
        die(toast("error", "Invalid role selection."));
    }

    if ($new_role == $user['role']) die(toast("error", "No changes made to role."));
    
    $data = ["role" => $new_role, "updated_at" => DATE_TIME];

    $update_role = $DB->UPDATE("users", $data,["user_id" => $user_id]);
    if (!$update_role) die(toast("error", "Failed to update role."));
    
    toast("success", "User role updated to ".$new_role." successfully.");
    die(refresh(2000));

}