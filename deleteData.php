<?php
include "includes/config.php";
include "functions.php";

// delete_archive_btn

if(isset($_POST['delete_archive_btn'])){
    $id = $conn->escape_string($_POST['id']);
    $res = delete_archive_request($id);

    if(!$res){
        echo "Failed to delete request form";
    }else{
        echo "success";
    }
}


if (isset($_POST['action'])) {
    
    $id = $conn->escape_string($_POST['id']);
    $table = $conn->escape_string($_POST['table']);
    $btn = $conn->escape_string($_POST['delete_client_btn']);

    if($btn == "delete_user_forever"){
        
        
        if(!deleteData($table, $id)){
            echo "Failed to move user to archive";
        }else{
            echo "success";
        }
    }

    // this button is from retieved page so this is delete permanently
    if ($btn == "deletedBTN") {
        $res = deleteData($table, $id);
        
        if (!$res) {
            $feedback = [
                "status" => 422,
                "message" => "Failed to move data to archive"
            ];
            echo json_encode($feedback);
        } else {
            $feedback = [
                "status" => 200,
                "message" => "Successfully move to archive"
            ];
            echo json_encode($feedback);
        }
    }



    // common delete button
    if ($btn == "delete") {
        // retrieved this account base on id
        $res = getById("admins", $id);

        $res = $res->fetch_assoc();
        // add this account to deleted admin account table
        getDeletedAdminaccount($id, $res['adminName'], $res['role'], $res['username'], $res['password'], $res['dateAdded'], $res['dateModified']);

        // then after that delete that account to admin table
        $res = deleteData($table, $id);

        if (!$res) {
            $feedback = [
                "status" => 422,
                "message" => "Failed to move archive"
            ];
            echo json_encode($feedback);
        } else {
            $feedback = [
                "status" => 200,
                "message" => "Successfully move account to archive"
            ];
            echo json_encode($feedback);
        }
    }

    if ($btn == "delete_client_btn") {

        // insert to archives
        get_deleted_client($id);
        get_deleted_transactions($id);

        $res = delete_client_and_transactions($id);

        if (!$res) {
            $feedback = [
                "status" => 422,
                "message" => "Failed to move to archive"
            ];
            echo json_encode($feedback);
        } else {
            $feedback = [
                "status" => 200,
                "message" => "Successfully move account to archive"
            ];
            echo json_encode($feedback);
        }
    }
}

// 

// deleted_client_and_transactions
if (isset($_POST['deleted_client_and_transactions'])) {
    $client_id = $conn->escape_string($_POST['client_id']);

    // echo $client_id;
    $res = permanently_deleted_client_and_transactions($client_id);

    if (!$res) {
        echo "Failed to move client related data to archive";
    } else {
        echo "success";
    }
}


if(isset($_POST['delete_user_btn'])){
    $id = $conn->escape_string($_POST['id']);
    get_deleted_user($id);

    $user = delete_user($id);
    $request = delete_request($id);
    
    if($user == TRUE && $request == TRUE){
        echo "success";
    }else{
        echo "Failed to move to archive";
    }
}
// REQUEST
if(isset($_POST['archive_request_btn'])){
    $id = $conn->escape_string($_POST['id']);
    $sql = "INSERT INTO `deleted_request_form` SELECT * FROM `request_form` WHERE `id`='$id'";
    $res = $conn->query($sql);

    delete_request($id);
    
    if(!$res){
        echo "Failed to archive request";
    }else{
        echo "success";
    }
}
