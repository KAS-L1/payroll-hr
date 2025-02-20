<?php require("../../app/init.php") ?>
<?php require("../auth/auth.php") ?>
<?php

CSRF('verify');

// Validate input fields
$first_name = $_POST['first_name'] ?? null;
$last_name = $_POST['last_name'] ?? null;
$username = $_POST['username'] ?? null;
$email = $_POST['email'] ?? null;
$address = $_POST['address'] ?? null;
$contact = $_POST['contact'] ?? null;
$role = $_POST['role'] ?? null;
$password = $_POST['password'] ?? null;
$confirmPassword = $_POST['confirmPassword'] ?? null;

if (!$first_name || !$last_name || !$username || !$email || !$contact || !$role || !$password || !$confirmPassword) {
    die(toast("error", "All fields are required."));
}

// Validate role
$allowed_roles = ['Admin', 'Hr', 'Finance'];
if (!in_array($role, $allowed_roles)) {
    die(toast("error", "Invalid role"));
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die(toast("error", "Invalid email format."));
}

if ($password !== $confirmPassword) {
    die(toast("error", "Passwords do not match."));
}

// Hash the password
$hashedPassword = HASH_PASSWORD($password);

try {

    // Check if email or username already exists
    $existing_user = $DB->SELECT_ONE_WHERE("users", "*", ["email" => $email]);
    if ($existing_user) {
        die(toast("error", "Email already exists."));
    }

    $existing_username = $DB->SELECT_ONE_WHERE("users", "*", ["username" => $username]);
    if ($existing_username) {
        die(toast("error", "Username already taken."));
    }

    // Insert user data
    $user_data = [
        "user_id" => GENERATE_ID('11', 4),
        "firstname" => $first_name,
        "lastname" => $last_name,
        "email" => $email,
        "username" => $username,
        "password" => $hashedPassword,
        "address" => $address,
        "contact" => $contact,
        "role" => $role,
        "created_at" => DATE_TIME,
        "updated_at" => DATE_TIME
    ];

    $insert = $DB->INSERT("users",$user_data);
    if (!$insert['success']) {
        die(toast("error", "Failed to create user."));
    }

    toast("success", "User created successfully.");
    die(redirect('/users',2000));

} catch (Exception $e) {
    die(toast("error", "Something went wrong. Please try again.".$e->getMessage()));
}