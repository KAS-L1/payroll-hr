<?php require("../../app/init.php") ?>
<?php require("../auth/auth.php") ?>
<?php

// Validate input fields
if(empty($_POST['employee_id']) OR empty($_POST['category']) OR empty($_POST['type']) OR empty($_POST['amount'])) die(Toast("error", "Empty fields is required"));

$employee_id = $_POST['employee_id'];
$category = $_POST['category'];
$amount = $_POST['amount'];
$type = $_POST['type'];

$exist_salary = $DB->SELECT_ONE_WHERE("benefits_compensation", "*", ["employee_id" => $employee_id, "type" =>  $type]);
if(!empty($exist_salary)) die(Toast("error", CAMEL($type)." already exist"));

// Insert user data
$data = [
    "employee_id" => $employee_id,
    "type" => $category,
    "amount" => $type == 'Add' ? $amount : '-'.$amount,
    "remark" => $type,
    "created_at" => DATE_TIME
];

$insert = $DB->INSERT("benefits_compensation",$data);
if (!$insert['success']) die(toast("error", "Failed to insert compensation"));

Toast("success", "Compensation Added");
Refresh(1000);
die();

