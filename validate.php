<?php
session_start();
include "includes/config.php";
include "functions.php";

if (isset($_POST['loginBtn'])) {

    $username = $conn->escape_string($_POST['username']);
    $password = $conn->escape_string($_POST['password']);

    $res = validateCredential($username);

    if ($res->num_rows < 1) {
        // check for usename
       echo "wrong credentials";
       exit;
    } else {
        // check verify password
        $res = $res->fetch_assoc();
        $hash = $res['password'];

        if (password_verify($password, $hash)) {
            $_SESSION['login'] = true;
            $_SESSION['role'] = $res['role'];
            $_SESSION[  'id'] = $res['id'];
            $_SESSION['adminName'] = $res['adminName'];

            // save login history
            $lastInsertId = loginHistory($res['id'], $res['adminName'], $res['username'], $res['role']);
            // $_SESSION['currently_loginID'] = $lastInsertId;

            echo "login successfully";

        } else {
            echo "wrong password";
            exit;
        }
    }

    // joel@amiler
}
