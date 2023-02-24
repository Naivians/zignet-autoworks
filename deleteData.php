<?php
include "includes/config.php";
include "functions.php";

if (isset($_POST['action'])) {

    $id = $conn->escape_string($_POST['id']);
    $table = $conn->escape_string($_POST['table']);
    $btn = $conn->escape_string($_POST['deletedAccBtn']);

    // this button is from retieved page so this is delete permanently
    if ($btn == "deletedBTN") {
        $res = deleteData($table, $id);
        
        if (!$res) {
            $feedback = [
                "status" => 422,
                "message" => "Failed to delete data"
            ];
            echo json_encode($feedback);
        } else {
            $feedback = [
                "status" => 200,
                "message" => "Seccessfully deleted accounts"
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
                "message" => "Failed to delete data"
            ];
            echo json_encode($feedback);
        } else {
            $feedback = [
                "status" => 200,
                "message" => "Seccessfully deleted accounts"
            ];
            echo json_encode($feedback);
        }
    }
}
