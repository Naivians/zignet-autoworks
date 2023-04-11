<?php
session_start();
include "includes/config.php";
include "functions.php";
include "includes/date.php";

$res = getData("request_form");
$total_users = $res->num_rows;

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
        if (strlen($username) < 8 || strlen($password) < 8 || strlen($adminName) < 8) {
            $response = [
                "status" => 422,
                "message" => "Admin Name, Username and Password must be atleast 8 character long"
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


if (isset($_POST['retrievedAction'])) {

    $retrievedID = $conn->escape_string($_POST['retrievedID']);
    $retrievedBtn = $conn->escape_string($_POST['retrievedBtn']);
    $retrievalTable = $conn->escape_string($_POST['table']);

    // retirieved by id
    if ($retrievedBtn == "retrievedAdmin") {
        $res = retrievedById($retrievalTable, $retrievedID);
        $retrieve = $res->fetch_assoc();

        // insert this retrieved account to admin table
        retrievedAdmin($retrieve['adminName'], $retrieve['username'], $retrieve['password'], $retrieve['role'], $retrieve['dateAdded'], $retrieve['dateModified']);

        // delete that retrieved account to deleted admin account table
        $res = deleteData($retrievalTable, $retrievedID);

        if (!$res) {


            $response = [
                "status" => 500,
                "message" => "Failed to retrieved account. Please contact the developer to fix it!",
            ];
            echo json_encode($response);
        } else {

            $response = [
                "status" => 200,
                "message" => "Retrieved Successfully!",
            ];

            echo json_encode($response);
        }
    }

    
}


// retrieved_deleted_client_and_transactions
if (isset($_POST['retrieved_deleted_client_and_transactions'])) {
    $client_id = $conn->escape_string($_POST['retrievedID']);
    $res = get_customer_by_clientID("deleted_client_account", $client_id);

    if ($res->num_rows > 0) {

        $res = $res->fetch_assoc();



        $client = retrieved_client($res['client_id'], $res['img_path'], $res['customerName'], $res['csNumber'], $res['model'], $res['company'], $res['dateAdded'], $res['dateModified']);

        if (!$client) {
            echo "Failed to retrieved deleted client";
        } else {
            $res = get_customer_by_clientID("deleted_transactions_history", $client_id);
            if ($res->num_rows > 0) {
                $res = $res->fetch_assoc();
                $results = retrieved_transactions($res['client_id'], $res['reciept'], $res['customerName'], $res['csNumber'], $res['paymentStatus'], $res['dateAdded'], $res['date_paid']);

                if (!$results) {
                    echo "Failed to retrieved deleted transactions_history";
                } else {
                    $res = permanently_deleted_client_and_transactions($client_id);
                    if (!$res) {
                        echo "Failed to retrieved deleted transactions_history";
                    } else {
                        echo "success";
                    }
                }
            } else {
                echo "Account does not exist in the database";
            }
        }
    } else {
        echo "Account does not exist in the database";
    }
}

 if(isset($_POST['request_btn'])){
    $display_name = $conn->escape_string($_SESSION['display_name']);
    $user_id = $conn->escape_string($_SESSION['user_id']);
    $company = $conn->escape_string($_POST['company']);
    $model = $conn->escape_string($_POST['model']);
    $cs_number = $conn->escape_string($_POST['cs_number']);
    $schedule = $conn->escape_string($_POST['sched']);
    $front_windshield = $conn->escape_string($_POST['front_windshield']);
    $rear_windshield = $conn->escape_string($_POST['rear_windshield']);
    $front_windows = $conn->escape_string($_POST['front_windows']);
    $rear_windows = $conn->escape_string($_POST['rear_windows']);

    // $request_id = $user_id = $year . "" . $month . "" . $day."". $total_users +1 ;
    $request_id = uniqid();
    
    $res = insert_form($user_id, $request_id, $display_name, $company, $model, $cs_number, $schedule, $front_windshield, $rear_windshield, $front_windows, $rear_windows);
    
    if(!$res){
        echo "Failed to send form request.";
    }else{
        echo "success";
    }

 }


 if(isset($_POST['retrievedBtn'])){
    $id = $conn->escape_string($_POST['id']);
    
    // retrieved
    
    // permanent delete
    deleteData("deleted_user", $id);
 }