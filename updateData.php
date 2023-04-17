<?php
session_start();
include "includes/config.php";
include "functions.php";


/*
status_id: status_id,
status: status,
update_status_btn: 1
*/

if(isset($_POST['update_status_btn'])){
    $status = $conn->escape_string($_POST['status']);
    $status_id = $conn->escape_string($_POST['status_id']);

    $sql = "UPDATE `request_form` SET `request_status` = '$status' WHERE `id` = '$status_id'";
    $res = $conn->query($sql);

    if(!$res){
        echo "Failed to update request status";
    }else{
        echo "success";
    }
}


if(isset($_POST['update_request_btn'])){
    
    $id = $conn->escape_string($_POST['id']);
    $company = $conn->escape_string($_POST['company']);
    $model = $conn->escape_string($_POST['model']);
    $cs_number = $conn->escape_string($_POST['cs_number']);
    $schedule = $conn->escape_string($_POST['schedule']);
    $front_windshield = $conn->escape_string($_POST['front_windshield']);
    $rear_windshield = $conn->escape_string($_POST['rear_windshield']);
    $front_side_windows = $conn->escape_string($_POST['front_side_windows']);
    $rear_side_windows = $conn->escape_string($_POST['rear_side_windows']);


    $sql = "UPDATE `request_form` SET `company` = '$company', `model` = '$model', `cs_number` = '$cs_number', `schedule` = '$schedule', `front_windshield` = '$front_windshield', `front_windshield` = '$rear_windshield', `front_side_windows` = '$front_side_windows', `rear_side_windows` = '$rear_side_windows' WHERE `id`='$id'";

    $res = $conn->query($sql);

    if(!$res){
        echo "Failed to update request";
    }else{
        echo "success";
    }
}


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

if (isset($_POST['update_client_btn'])) {
    $client_id = $conn->escape_string($_POST['client_id']);
    $edit_customer_name = $conn->escape_string($_POST['edit_customer_name']);
    $edit_company = $conn->escape_string($_POST['edit_company']);
    $edit_model = $conn->escape_string($_POST['edit_model']);
    $edit_cs_number = $conn->escape_string($_POST['edit_cs_number']);

    if ($client_id == "" || $edit_customer_name == "" || $edit_company == "" || $edit_model == "" || $edit_cs_number == "") {
        echo "All fields are mandatory";
    } else {
        // update customer and some of transaction history
        update_client_and_transactions($client_id, $edit_model, $edit_company, $edit_customer_name, $edit_cs_number);

        echo "success";
    }
}

if (isset($_POST['update_user_btn'])) {

    $user_id = $conn->escape_string($_POST['user_id']);
    $update_display_name = $conn->escape_string($_POST['update_display_name']);
    $update_username = $conn->escape_string($_POST['update_username']);
    $update_password = $conn->escape_string($_POST['update_password']);
    $update_contact = $conn->escape_string($_POST['update_contact']);

    $res = update_user($user_id, $update_display_name, $update_username, $update_password, $update_contact);

    if (!$res) {
        echo "Failed to update account";
    } else {
        $_SESSION['display_name'] = $update_display_name;
        echo "success";
    }
}


// USERS

// activate users
if (isset($_POST['activate_btn'])) {
    $user_id = $conn->escape_string($_POST['user_id']);
    $res = activate($user_id);

    if (!$res) {
        echo "Failed to Deactivate";
    } else {
        echo "success";
    }
}

// deactivate_btn
if (isset($_POST['deactivate_btn'])) {
    $user_id = $conn->escape_string($_POST['user_id']);
    $res = deactivate($user_id);

    if (!$res) {
        echo "Failed to Deactivate";
    } else {
        echo "success";
    }
}

// activate all 
if (isset($_POST['activate_all'])) {
    $res = activate_all();

    if (!$res) {
        echo "Failed to activate all accounts";
    } else {
        echo "success";
    }
}

// deactivate all
if (isset($_POST['deactivate_all'])) {
    $res = deactivate_all();

    if (!$res) {
        echo "Failed to activate all accounts";
    } else {
        echo "success";
    }
}
