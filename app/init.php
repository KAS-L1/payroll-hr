<?php if (session_status() === PHP_SESSION_NONE) session_start() ?>
<?php

/**
 * APPLICATION SETUP
**/

// APPLICATION GLOBAL CONFIG VARIALBE
require_once("core/config.php");

// APPLICATION GLOBAL SETTINGS
require_once("core/functions.php");

// APPLICATION FUNCTIONS
require_once("core/utils.php");

// APPLICATION COMPONENTS
require_once("core/components.php");

// APPLICATION DATABASE
require_once("core/database.php");

// INITIATE DATABASE CONNECTION
$DB = new Database();

