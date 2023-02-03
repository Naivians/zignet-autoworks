<?php

include "includes/config.php";
include "functions.php";

if (isset($_POST['action'])) {
    $adminName = $conn->escape_string($_POST['adminName']);
    $password = $conn->escape_string($_POST['password']);
    $role = $conn->escape_string($_POST['role']);
    $username = $conn->escape_string($_POST['username']);

    // validation for server
    if ($role == "" || $password == "" || $adminName == "" || $username == "") {
        
        $response = [
            "status" => 422,
            "message" => "all fields are mandatory"
        ];
        echo json_encode($response);

    } else {

        // check the leck of the username
        if (strlen($username) < 7 || strlen($password) < 7) {
            $response = [
                "status" => 422,
                "message" => "Username and Password must be atleast 8 character long"
            ];
            echo json_encode($response);
        } else {
            
            // check if username already exist
            if (checkForUsername($username) > 0) {
                $response = [
                    "status" => 422,
                    "message" => "This $username is already taken!"
                ];
                echo json_encode($response);
            } else {
                // encrypt password
                $password = password_hash($password, PASSWORD_DEFAULT);

                $res = addAdmin($adminName, $username, $password, $role);

                if (!$res) {
                    $response = [
                        "status" => 422,
                        "message" => "Failed to insert data please check you query"
                    ];
                    echo json_encode($response);
                } else {
                    $response = [
                        "status" => 200,
                        "message" => "Successfully Added"
                    ];
                    echo json_encode($response);
                }
            }

        }
    }
}
