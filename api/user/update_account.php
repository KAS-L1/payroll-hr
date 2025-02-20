<?php require("../../app/init.php") ?>
<?php require("../auth/auth.php") ?>
<?php

CSRF('verify');

if(isset($_POST['user_id'])){

    // Check if all required POST data exists
    $requiredFields = ['user_id', 'firstname', 'lastname', 'username', 'email', 'address', 'contact'];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field])) {
            die(toast('error', "Missing field: $field"));
        }
    }
        
    $user_id = $_POST['user_id'];

    // Ensure user_id exists in database
    $user = $DB->SELECT_ONE_WHERE('users', '*', ['user_id' => $user_id]);
    if (!$user) die(toast('error', 'User does not exist.'));

    $data = [
        "firstname" => $DB->ESCAPE(VALID_STRING($_POST['firstname'])),
        "lastname"  => $DB->ESCAPE(VALID_STRING($_POST['lastname'])),
        "username"   => $DB->ESCAPE(VALID_STRING($_POST['username'])),
        "email"      => $DB->ESCAPE(VALID_MAIL($_POST['email'])),
        "address"    => $DB->ESCAPE(VALID_STRING($_POST['address'])),
        "contact"    => $DB->ESCAPE(VALID_NUMBER($_POST['contact']))
    ];

    // Check if any fields have not changed
    if (
        $data['firstname'] == $user['firstname'] &&
        $data['lastname'] == $user['lastname'] &&
        $data['username'] == $user['username'] &&
        $data['email'] == $user['email'] &&
        $data['address'] == $user['address'] &&
        $data['contact'] == $user['contact']
    ) {
        die(toast('error', 'No changes were made.'));
    }


    $update_user = $DB->UPDATE("users", $data,["user_id" => $user_id]);
    if (!$update_user) die(toast('error', 'Failed to update Account Information'));

    toast('success', 'Account information successfully updated');
    die(refresh(2000));

}else{
    die(toast('error', 'Invalid server request'));
}