<?php require("../../app/init.php") ?>
<?php require("../auth/auth.php") ?>
<?php

// Validate input fields
if(empty($_POST['benefit_id'])) die(Toast("error", "Benefit id is invalid"));
if(empty($_POST['amount'])) die(Toast("error", "Amount is required"));

$benefit_id = $_POST['benefit_id'];
$amount = $_POST['amount'];

// Insert user data
$data = [
    "amount" => $amount,
    "updated_at" => DATE_TIME,
    "updated_by" => AUTH_USER['username']
];

$update = $DB->UPDATE("benefits_compensation",$data, ["id" => $benefit_id]);
if (!$update['success']) die(toast("error", "Failed to update"));

Toast("success", "Benefit Updated");
Refresh(1000);
die();

