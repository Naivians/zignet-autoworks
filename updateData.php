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


// Client

if(isset($_POST['update_client_btn'])){
    $client_id = $conn->escape_string($_POST['client_id']);
    $edit_customer_name = $conn->escape_string($_POST['edit_customer_name']);
    $edit_company = $conn->escape_string($_POST['edit_company']);
    $edit_model = $conn->escape_string($_POST['edit_model']);
    $edit_cs_number = $conn->escape_string($_POST['edit_cs_number']);

    if($client_id == "" || $edit_customer_name == "" || $edit_company == "" || $edit_model == "" || $edit_cs_number == ""){
        echo "All fields are mandatory";
    }else{
        // update customer and some of transaction history
        update_client_and_transactions($client_id, $edit_model, $edit_company, $edit_customer_name, $edit_cs_number);

        echo "success";
    }

}