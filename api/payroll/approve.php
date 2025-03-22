<?php require("../../app/init.php") ?>
<?php require("../auth/auth.php") ?>
<?php

// Validate input fields
if(!isset($_POST['action'])) die(Toast("error", "Invalid action"));

$dataPayroll = [
    "status" => 'Approved',
    "updated_at" => DATE_TIME
];
$update = $DB->UPDATE("payroll",$dataPayroll, ["status" => 'Processing']);
if (!$update['success']) die(toast("error", "Failed to update payroll"));

Toast("success", "Payroll Approved Successfully");
Refresh(1000);
die();

