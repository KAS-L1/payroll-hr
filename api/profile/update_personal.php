<?php require("../../app/init.php") ?>
<?php require("../auth/auth.php") ?>
<?php

CSRF('verify');

if(AUTH_USER_ID){

    // Check if all required POST data exists
    $requiredFields = ['firstname', 'lastname', 'username', 'email', 'address', 'contact'];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field])) {
            die(toast('error', 'Invalid server request'));
        }
    }

    // Sanitize and validate input data
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
        $data['firstname'] == AUTH_USER['firstname'] &&
        $data['lastname'] == AUTH_USER['lastname'] &&
        $data['username'] == AUTH_USER['username'] &&
        $data['email'] == AUTH_USER['email'] &&
        $data['address'] == AUTH_USER['address'] &&
        $data['contact'] == AUTH_USER['contact']
    ) {
        die(toast('error', 'No changes were made.'));
    }

    $update_user = $DB->UPDATE("users", $data,["user_id" => AUTH_USER_ID]);
    if (!$update_user === "success") die(toast('error', 'Failed to update Personal Information'));

    toast('success', 'Personal information successfully updated');
    die(refresh(2000));

}else{
    die(toast('error', 'Invalid server request'));
}