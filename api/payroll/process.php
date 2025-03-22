<?php require("../../app/init.php") ?>
<?php require("../auth/auth.php") ?>
<?php

// Validate input fields
if(empty($_POST['payroll_id']) OR empty($_POST['employee_id'])) die(Toast("error", "Empty fields is required"));

$payroll_id = $_POST['payroll_id'];
$employee_id = $_POST['employee_id'];
$gross_pay = $_POST['gross_pay'];
$total_deduction = $_POST['total_deduction'];
$net_pay = $_POST['net_pay'];

// Insert user data
$data = [
    "payroll_id" => $payroll_id,
    "employee_id" => $employee_id,
    "gross" => $gross_pay,
    "deduction" => $total_deduction,
    "net" => $net_pay,
    "created_at" => DATE_TIME
];

$insert = $DB->INSERT("payroll_summary",$data);
if(!$insert['success']) die(toast("error", "Failed to insert summary"));


$dataPayroll = [
    "status" => 'Processing',
    "updated_at" => DATE_TIME
];
$update = $DB->UPDATE("payroll",$dataPayroll, ["payroll_id" => $payroll_id, "employee_id" => $employee_id]);
if (!$update['success']) die(toast("error", "Failed to update payroll"));


Toast("success", "Payroll Processed");
Refresh(500);
die();

