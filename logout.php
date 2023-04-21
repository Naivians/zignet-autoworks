<?php
include "functions.php";
session_start();

session_destroy();

if (isset($_GET['user'])) {
    $sessions = array("user_role", "username", "display_name", "user_id", "contact", 'otp');

    foreach ($sessions as $session) {
        unset($_SESSION[$session]);
    }
    header("location:index.php");
}

if (isset($_GET['admin'])) {
    $LoginID = $_SESSION['currently_loginID'];
    // logout($LoginID);

    $sessions = array("admin_role", "admin_id", "adminName", "currently_loginID", "login");

    foreach ($sessions as $session) {
        unset($_SESSION[$session]);
    }
    
    header("location:login.php");
}

// session_destroy();
