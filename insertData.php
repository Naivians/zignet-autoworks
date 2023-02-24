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
    if($retrievedBtn == "retrievedAdmin"){
        $res = retrievedById($retrievalTable, $retrievedID);
        $retrieve = $res->fetch_assoc();

        // insert this retrieved account to admin table
        retrievedAdmin($retrieve['adminName'], $retrieve['username'], $retrieve['password'], $retrieve['role'], $retrieve['dateAdded'], $retrieve['dateModified']);

        // delete that retrieved account to deleted admin account table
        $res = deleteData($retrievalTable, $retrievedID);

        if(!$res){


            $response = [
                "status" => 500,
                "message" => "Failed to retrieved account. Please contact the developer to fix it!",
            ];
            echo json_encode($response);


        }else{

            $response = [
                "status"=>200,
                "message"=>"Retrieved Successfully!",
            ];

           echo json_encode($response);
        }
    }

}
