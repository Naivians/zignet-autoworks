<?php

session_start();

if (!isset($_SESSION['role'])) {
    header("Location:login.php");
} else {
    if ($_SESSION['role'] != "super admin") {
        header("Location:logout.php?access=1");
    }
}

include "includes/config.php";
include "functions.php";
$errorMessage = array();

$img_id = "";

if (isset($_GET['id'])) {
    $img_id = $_GET['id'];

    $res = getBY_clientID("customer", $img_id);

    $res = $res->fetch_assoc();
    $_SSESION['variable'] = "id";
}

if (isset($_GET['transact_id'])) {
    $img_id = $_GET['transact_id'];

    $res = getBY_clientID("transactions_history", $img_id);

    $res = $res->fetch_assoc();

    // echo $res['reciept'];
    $_SSESION['variable'] = "transact_id";

}

// customer
if (isset($_POST['create'])) {

    // file info declarations
    define("MB", 1000000);

    $upload_error = array(
        1 => "File size should not be exceed to 1mb",
        4 => "No file was uploaded.",
        3 => "You can't upload file of this type!",
        "unknown_error" => "Unknown error occured!",
        "file_upload_error" => "Failed to save to the right directory!",
    );

    $allowed_img_extentions = ['jpg', "jpeg", "png"];

    // file info
    $img_name = $_FILES['docs']['name'];
    $tmp_name = $_FILES['docs']['tmp_name'];
    $img_type = $_FILES['docs']['type'];
    $img_size = $_FILES['docs']['size'];
    $img_error = $_FILES['docs']['error'];

    // file validations
    if ($img_error == 0) {
        if ($img_size > MB) {
            $errorMessage['max_upload_size_error'] = $upload_error[1];
        } else {
            $img_extentions = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_extentions = strtolower($img_extentions);

            if (!in_array($img_extentions, $allowed_img_extentions)) {
                $errorMessage['ext_not_allowed'] = $upload_error[3];
            }
        }
    } else {
        if ($img_error == 4) {
            $errorMessage['no_file_upload_error'] = $upload_error[4];
        } else {
            $errorMessage['unknown_error'] = $upload_error["unknown_error"];
        }
    }

    // if no error
    if (count($errorMessage) === 0) {
        // upload files, get all information then insert to DB
        $new_img_name = uniqid("IMG-", true) . "." . $img_extentions;
        $img_upload_path = 'uploads/' . $new_img_name;

        if (!move_uploaded_file($tmp_name, $img_upload_path)) {
            $errorMessage['file_upload_error'] = $upload_error["file_upload_error"];
        } else {
            // insert to client and transactions    
            //  update_transact_img($img_path, $img_id)

            if($_SSESION['variable'] == "transact_id"){
                update_transact_img($new_img_name, $img_id);
                $_SESSION['success_upload'] = "Successfully Upload";
                header("location:supAdminTransact.php");
                exit;
            }

            if($_SSESION['variable'] == "id"){
                update_img($new_img_name, $img_id);
                $_SESSION['success'] = "Successfully update document form";
                header("location:supAdminClient.php");
                exit;
            }
            
        }
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/header.php"; ?>
    <link rel="stylesheet" href="css/dashboard.css?v=<?= time(); ?>">


    <title>Admin | Change Image Form</title>
</head>

<body>
    <!-- main content -->
    <div class="wrapper" id="wrapper">
        <div class="container short_width">
            <h1 class="text-light text-center mt-3 mb-2">Edit Form / Reciept</h1>
            <div class="card">
                <div class="card-body">
                    <?php
                    if (isset($errorMessage)) {
                        if (count($errorMessage) > 0) {
                    ?>
                            <div class="alert alert-danger" role="alert">
                                <?php
                                foreach ($errorMessage as $error) {
                                ?>
                                    <li class="small-font"><?= $error ?></li>
                                <?php
                                }
                                ?>
                            </div>
                    <?php
                        }
                    }

                    ?>

                    <form method="POST" enctype="multipart/form-data">
                        <div>
                            <!-- form here -->
                            <div class="mb-3 docs">
                                <?php
                                if (isset($_GET['id'])) {
                                ?>
                                    <img src="uploads/<?= $res['img_path'] ?>" alt="">
                                <?php
                                }

                                if (isset($_GET['transact_id'])) {
                                ?>
                                    <img src="uploads/<?= $res['reciept'] ?>" alt="">
                                <?php
                                }

                                ?>

                            </div>
                            <div class="mb-3">
                                <label for="docs" class="form-label text-dark small-font">Upload Docs</label>
                                <input type="file" name="docs" id="docs" class="form-control">
                            </div>

                            <div class="mt-4 mb-2">
                            <?php
                                if (isset($_GET['id'])) {
                                    ?>
                                        <a href="supAdminClient.php" class="btns psuedo_design pad dark small-font">Close</a>
                                    <?php
                                }

                                if (isset($_GET['transact_id'])) {
                                    ?>
                                        <a href="supAdminTransact.php" class="btns psuedo_design pad dark small-font">Close</a>
                                    <?php
                                }
                                    
                                ?>

                                
                                <button type="submit" class="btns small-font" name="create">Create</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




</body>

</html>