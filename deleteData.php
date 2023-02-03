<?php

include "functions.php";

if(isset($_POST['deleteBtn'])){
    $id = $_POST['id'];

    $res = deleteData("admins", $id);

    if(!$res){
        $feedback = [
            "status" => 422,
            "message" => "Failed to delete data"
        ];
        echo json_encode($feedback);
    }else{
        $feedback = [
            "status" => 200,
            "message" => "Seccessfully deleted accounts"
        ];
        echo json_encode($feedback);
    }
}
