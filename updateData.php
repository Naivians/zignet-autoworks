<?php
session_start();
include "includes/config.php";
include "functions.php";
include "includes/sms.php";
include "includes/date.php";

// $_SESSION['attempts'] = 0;
/*
status_id: status_id,
status: status,
update_status_btn: 1
*/

if (isset($_POST['update_status_btn'])) {
    $status = $conn->escape_string($_POST['status']);
    $status_id = $conn->escape_string($_POST['status_id']);
    $contact = $conn->escape_string($_POST['contact']);

    $sql = "UPDATE `request_form` SET `request_status` = '$status' WHERE `id` = '$status_id'";
    $res = $conn->query($sql);

    if (!$res) {
        echo "Failed to update request status";
    } else {

        if ($status == "approved") {
            approved_request($contact);
        }

        echo "success";
    }
}


if (isset($_POST['update_request_btn'])) {

    $id = $conn->escape_string($_POST['id']);
    $description = $conn->escape_string($_POST['description']);
    $schedule = $conn->escape_string($_POST['schedule']);
    $address = $conn->escape_string($_POST['address']);

    $description =  str_replace('\r\n', "<br>", $description);
    $address =  str_replace('\r\n', "<br>", $address);

    $sql = "UPDATE `request_form` SET `description_of_service` = '$description', `schedule` = '$schedule', `address` = '$address', `schedule` = '$schedule', `date_modified` = '$today' WHERE `id`='$id'";

    $res = $conn->query($sql);

    if (!$res) {
        echo "Failed to update request";
    } else {
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

    $update_password = md5($update_password);

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

    $sql = "SELECT `contact` FROM `user` WHERE `user_id` = '$user_id'";
    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        $res = $res->fetch_assoc();

        activate_account($res['contact']);

        $res = activate($user_id);

        if (!$res) {
            echo "Failed to Activate";
        } else {

            echo "success";
        }
    } else {
        echo "Failed to Deactivate";
    }
}

// deactivate_btn
if (isset($_POST['deactivate_btn'])) {
    $user_id = $conn->escape_string($_POST['user_id']);
    $sql = "SELECT `contact` FROM `user` WHERE `user_id` = '$user_id'";
    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        $res = $res->fetch_assoc();

        deactivate_account($res['contact']);

        $res = deactivate($user_id);

        if (!$res) {
            echo "Failed to Activate";
        } else {

            echo "success";
        }
    } else {
        echo "Failed to Deactivate";
    }
}

// activate all 
if (isset($_POST['activate_all'])) {

    // get contact of all deactivated account and send sms for each
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


if (isset($_POST['disapproved_btn'])) {

    $message = $conn->escape_string($_POST['message']);
    $status = $conn->escape_string($_POST['status']);
    $status_id = $conn->escape_string($_POST['status_id']);
    $contact = $conn->escape_string($_POST['contact']);
    $message =  str_replace('\r\n', "<br>", $message);

    $sql = "UPDATE `request_form` SET `request_status` = '$status', `reason` = '$message' WHERE `id` = '$status_id'";
    $res = $conn->query($sql);

    if (!$res) {
        echo "Failed to update request status";
    } else {
        disapproved_request($contact, $message);
        echo "success";
    }
}


if (isset($_POST['verify_btn'])) {
    $user_id = $conn->escape_string($_POST['user_id']);
    $otp = $conn->escape_string($_POST['otp']);

    if ($otp != $_SESSION['otp']) {
        echo "Please enter a valid OTP";
    } else {

        $_SESSION['otp'];
        $_SESSION['contact'];
        $_SESSION['password'];
        $_SESSION['display_name'];
        $_SESSION['user_id'];
        $_SESSION['username'];

        $res = insert_user($_SESSION['user_id'], $_SESSION['display_name'], $_SESSION['username'], $_SESSION['password'],  $_SESSION['contact'],  $_SESSION['otp']);
        $_SESSION['user_id'] = $user_id;

        if ($res) {
            unset($_SESSION['otp']);
            echo "verified";
        } else {
            // unset($_SESSION['otp']);
            echo "Failed";
        }
    }
}


if (isset($_POST['reset_otp_btn'])) {
    $user_id = $conn->escape_string($_POST['user_id']);
    $contact = $conn->escape_string($_POST['contact']);
    // contact  

    $_SESSION['attemp'] += 1;

    if ($_SESSION['attemp'] > 3) {
        echo "attempt";
        $_SESSION['attemp'] = 0;
    } else {
        $new_otp = generateNumericOTP();
        $_SESSION['otp'] = $new_otp;
        echo "success";

        send_otp($contact, $_SESSION['otp']);

        // if ($conn->query("UPDATE `user` SET `OTP_code` = $new_otp WHERE `user_id` = '$user_id'")) {
        //     send_otp($contact, $_SESSION['otp']);
        // } else {
        //     echo "Failed to generate new OTP";
        // }
    }
}

if (isset($_POST['reset_otp'])) {
    $otp = $conn->escape_string($_POST['reset_otp']);

    if ($otp == $_SESSION['reset_otp']) {
        echo "verified";
        unset($_SESSION['reset_otp']);
    } else {
        echo "Invalid Reset OTP";
    }
}
