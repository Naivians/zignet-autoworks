<?php

include "includes/config.php";
include "functions.php";

if (isset($_POST['editBtn'])) {
    
    $adminName = $conn->escape_string($_POST['editName']);
    $role = $conn->escape_string($_POST['editRole']);
    $username = $conn->escape_string($_POST['editUsername']);
    $password = $conn->escape_string($_POST['editPassword']);
    $updateID = $conn->escape_string($_POST['updateID']);

    $validateInput = [$adminName, $username, $password];
    $validInputs = true; //counter


    // SERVER SIDE VALIDATIONS
    // check for empty fields
    foreach ($validateInput as $input) {
        if (strlen($input) == 0) {
            $validInputs = false;
        }
    }

    // check if role is empty
    if ($validInputs) {
        // check for the length if < 8 characters long
        foreach ($validateInput as $input) {
            if (strlen($input) < 8) {
                $validInputs = false;
            }
        }

        if ($validInputs) {

            $retrievedRole = '';
            $hash = '';

            $res = getById("admins", $updateID);
            $res  = $res->fetch_assoc();
            $retrievedAdmin = $res['adminName'];
            $retrievedUsername = $res['username'];
            $retrievedPass = $res['password'];


            if ($password != $retrievedPass) {

                $password = password_hash($password, PASSWORD_DEFAULT);
                $res = updateAdminAccount($updateID, $adminName, $username, $password, $role);

                if (!$res) {
                    $response = [
                        "status" => 500,
                        "message" => "Failed to updated accounts. Please check your query"
                    ];
                    echo json_encode($response);
                } else {
                    $response = [
                        "status" => 200,
                        "message" => "Update Successfully"
                    ];
                    echo json_encode($response);
                }
            } else {

                $res = updateAdminAccount($updateID, $adminName, $username, $password, $role);
                if (!$res) {
                    $response = [
                        "status" => 500,
                        "message" => "Failed to updated accounts. Please check your query"
                    ];
                    echo json_encode($response);
                } else {
                    $response = [
                        "status" => 200,
                        "message" => "Update Successfully"
                    ];
                    echo json_encode($response);
                }
            }
        }
    } else {
        $response = [
            "status" => 422,
            "message" => "All fields are mandatory"
        ];
        echo json_encode($response);
    }
}
