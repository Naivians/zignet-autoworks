<?php
include "functions.php";
session_start();

$LoginID = $_SESSION['currently_loginID'];

logout($LoginID);

session_unset();
session_destroy();
header("location:login.php");


if (isset($_GET['access'])) {
    header("location:login.php?unautorized_access=You are not allowed to enter to this page");
} 
