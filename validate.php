<?php
session_start();
include "includes/config.php";
include "functions.php";
include "includes/date.php";
include "includes/sms.php";

$res = getData("user");
$total_users = $res->num_rows;

$user_role = '';
$admin_role = '';

if (isset($_POST['loginBtn'])) {

    // check for admin username

    $username = $conn->escape_string($_POST['username']);
    $password = $conn->escape_string($_POST['password']);

    // check for role
    $user = "SELECT role FROM `user` WHERE `username` = '$username' LIMIT 1";
    $user = $conn->query($user);

    $admin = "SELECT role FROM `admins` WHERE `username` = '$username' LIMIT 1";
    $admin = $conn->query($admin);
    // $admin = $admin->fetch_assoc();


    if ($user->num_rows > 0) {
        $res = validateCredential("user", $username);
        $res = $res->fetch_assoc();
        if (!$res) {
            echo "Wrong Credentials";
        } else {
            if ($res['password'] != md5($password)) {
                echo "wrong password";
            } else {

                if ($res['active'] != 1) {
                    echo "You're account is not yet activated by the admin.";
                } else {
                    $_SESSION['user_role'] = "set";
                    $_SESSION['username'] = $res['username'];
                    $_SESSION['display_name'] = $res['display_name'];
                    $_SESSION['user_id'] = $res['user_id'];
                    $_SESSION['contact'] = $res['contact'];
                    echo "user";
                }
            }
        }
    } else if ($admin->num_rows > 0) {

        $res = validateCredential("admins", $username);
        // check verify password
        $res = $res->fetch_assoc();
        $hash = $res['password'];

        if (password_verify($password, $hash)) {

            $_SESSION['login'] = true;
            $_SESSION['admin_role'] = $res['role'];
            $_SESSION['admin_id'] = $res['id'];
            $_SESSION['adminName'] = $res['adminName'];

            // save login history
            $lastInsertId = loginHistory($res['id'], $res['adminName'], $res['username'], $res['role']);
            $_SESSION['currently_loginID'] = $lastInsertId;

            echo "admin";
        } else {
            echo "wrong password";
            exit;
        }
    } else {
        echo "Wrong Credentials";
    }


    // joel@amiler
}

if (isset($_POST['register_btn'])) {

    $display_name = $conn->escape_string($_POST['display_name']);
    $username = $conn->escape_string($_POST['username']);
    $password = $conn->escape_string($_POST['password']);
    $contact = $conn->escape_string($_POST['contact']);

    if ($display_name == NULL || $username == NULL || $password == NULL || $contact == NULL) {
        echo "All fields is mandatory";
    } else {

        $users = validateCredential("user", $username);
        $admin = validateCredential("admins", $username);

        $admin = $admin->num_rows;
        $users = $users->num_rows;

        if ($users > 0 || $admin > 0) {
            echo "$username" . " Already exist, please choose another username!";
        } else {
            if (strlen($contact) != 11) {
                echo "Invalid Contact Number";
            } else {
                $otp = generateNumericOTP();
                $user_id = uniqid();
                $password = md5($password);
                
                $_SESSION['otp'] = $otp;
                $_SESSION['contact'] = $contact;
                $_SESSION['password'] = $password;
                $_SESSION['display_name'] = $display_name;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                
                send_otp($contact, $_SESSION['otp']);

                echo "Registered";
            }
        }
    }
}
