<?php require("../../app/init.php") ?>
<?php require("../auth/auth.php") ?>
<?php

// Validate input fields
if(empty($_POST['type'])) die(Toast("error", "Empty fields is required"));

$type = $_POST['type'];

$exist_type = $DB->SELECT_ONE_WHERE("benefits", "*", ["type" =>  $type]);
if(!empty($exist_type)) die(toast("error", CAMEL($type)." already exist"));

// Insert user data
$data = [
    "type" => $type,
    "created_at" => DATE_TIME
];

$insert = $DB->INSERT("benefits",$data);
if (!$insert['success']) die(toast("error", "Failed to insert benefit"));

Toast("success", "Benefit Added");
Refresh(1000);
die();

