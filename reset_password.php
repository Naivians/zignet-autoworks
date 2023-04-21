<?php
session_start();

if (!isset($_SESSION['reset_password'])) {
    header("location:login.php");
}

include "includes/config.php";
include "includes/date.php";

$error = array();

if (isset($_POST['submit'])) {
    $password = $conn->escape_string($_POST['password']);
    $confirm_password = $conn->escape_string($_POST['confirm_password']);

    if ($password == "" && $confirm_password == "") {
        $error['empty'] = "All fields required!";
    }

    if ($password != $confirm_password) {
        $error['not_match'] = "Passoword doesn't match!";
    }


    // if no error
    if (count($error) === 0) {
        // update password

        $username = $_SESSION['reset_password'];

        $password = md5($password);

        $sql = "UPDATE `user` SET `password` = '$password' WHERE `username` = '$username'";

        if ($conn->query($sql)) {
            header("location:login.php");
            $_SESSION['msg'] = "Successfully Update Password!";
            exit;
        } else {
            $error['Failed'] = "Failed to update Password. Please Check your query.";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/header.php"; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .containers {
            background: linear-gradient(to bottom, #0B0F30, #2D2E47);
            color: #fff;
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        form {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 30px;
            border-radius: 5px;
            width: 400px;
            max-width: 100%;
        }

        h2 {
            text-align: center;
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }



        button[type="submit"] {
            background-color: #fff;
            color: #0B0F30;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        button[type="submit"]:hover {
            background-color: #eee;
        }
    </style>
</head>

<body>
    <div class="containers">
        <form method="POST">
            <?php
            if (isset($error)) {
                foreach ($error as $errors) {
            ?>
                    <div class="alert alert-danger">
                        <li><?= $errors ?></li>
                    </div>
            <?php
                }
            }
            ?>
            <h2>Enter New Password</h2>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter password" class="form-control">
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm password" class="form-control">
            </div>
            <div class="mt-3 mb-3 d-flex- align-items-center ">
                <span class="me-2">Show Password</span>
                <input type="checkbox" name="" id="" onclick="showPass()">
            </div>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>

    <script>
        var pass = document.getElementById("password");
        var conform_password = document.getElementById("confirm_password");

        function showPass() {
            if (pass.type === "password" || conform_password.type === "password") {
                pass.type = "text";
                conform_password.type = "text";
            } else {
                pass.type = "password";
                conform_password.type = "password";
            }
        }
    </script>

</body>

</html>