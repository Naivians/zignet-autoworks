<?php

include "includes/config.php";
include "functions.php";
include "includes/date.php";

if (isset($_POST['editBtn'])) {

    $adminName = $conn->escape_string($_POST['editName']);
    $role = $conn->escape_string($_POST['editRole']);
    $username = $conn->escape_string($_POST['editUsername']);
    $password = $conn->escape_string($_POST['editPassword']);
    $updateID = $conn->escape_string($_POST['updateID']);

    $validateInput = [
         $adminName,
         $username,
         $password
    ];

    $validInputs = true;
    
    // SERVER SIDE VALIDATIONS

    // check for empty fields
    foreach ($validateInput as $input) {

        if (strlen($input) == 0) {
            $validInputs = false;
        }
    }

    // check if role is empty
    // check for the size if < 8 characters long
    if ($validInputs) {

        foreach ($validateInput as $input) {
            if (strlen($input) < 8) {
                $validInputs = false;
            }
        }

        if ($validInputs) {

            $retrievedRole = '';
            $verifyPassword = '';
            
            // set role if it's empty
            if(strlen($role) == 0) {
                $res = getById("admins", $updateID);
                $res  = $res->fetch_assoc();
                $retrievedRole = $res['role'];
                $verifyPassword = $res['password'];
            }else{

            }
            // if not empty then update the role

        }

    } else {
        $response = [
            "status" => 422,
            "message" => "All fields are mandatory"
        ];
        echo json_encode($response);
    }


}
