<?php require("../../app/init.php") ?>
<?php require("../auth/auth.php") ?>
<?php

// Validate input fields
if(empty($_POST['benefit_id'])) die(Toast("error", "Benefit ID is required"));

$benefit_id = $_POST['benefit_id'];

$delete = $DB->DELETE("benefits_compensation",["id" => $benefit_id]);
if (!$delete['success']) die(toast("error", "Failed to delete"));

Toast("success", "Benefit Deleted");
Refresh(1000);
die();

