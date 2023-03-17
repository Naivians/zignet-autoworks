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
$errorMessage = array();
$customer_name = '';
$cs_number = '';
$models = '';
// customer
if (isset($_POST['create'])) {

    // validate for empty fields
    $customerName = $conn->escape_string($_POST['customerName']);
    $csNumber = $conn->escape_string($_POST['csNumber']);
    $company = $conn->escape_string($_POST['company']);
    $model = $conn->escape_string($_POST['model']);




    if ($customerName == "") {
        $errorMessage['Cliet_empty_error'] = "Client is required!";
    }else{
        $customer_name = $customerName;
    }

    if ($csNumber == "") {
        $errorMessage['cs_empty_error'] = "CS Number is required!";
    }else{
        $cs_number = $csNumber;
    }

    if ($company == "") {
        $errorMessage['company_empty_error'] = "Company is required!";
    }

    if ($model == "") {
        $errorMessage['model_empty_error'] = "Model is required!";
    }else{
        $models = $model;
    }

    // file info declarations
    define("MB", 1000000);
    $upload_error = array(
        1 => "File size should not be exceed to 1mb",
        4 => "No file was uploaded.",
        3 => "",
        "unknown_error" => "Unknown error occured!",
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
        }else{
            $img_extentions = pathinfo($img_name, PATHINFO_EXTENSION);

        }
    } 
    else {
        if($img_error == 4){
            $errorMessage['no_file_upload_error'] = $upload_error[4];
        }else{
            $errorMessage['no_file_upload_error'] = $upload_error["unknown_error"];
        }
    }
    
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/header.php"; ?>
    <link rel="stylesheet" href="css/dashboard.css?v=<?= time(); ?>">


    <title>Admin | Add Client</title>
</head>

<body>
    <!-- main content -->
    <div class="wrapper" id="wrapper">
        <div class="container short_width">
            <h1 class="text-light text-center mt-3 mb-2">Add client</h1>
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
                            <div class="mb-3">
                                <label for="" class="form-label text-dark small-font">Customer Name</label>
                                <input type="text" name="customerName" id="customerName" placeholder="John Doe" class="form-control text-dark" value="<?php if(isset($customer_name)){echo $customer_name;} ?>">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label text-dark small-font">CS Number</label>
                                <input type="text" name="csNumber" id="csNumber" placeholder="SSEDRFF" class="form-control text-dark" value="<?php if(isset($cs_number)){echo $cs_number;} ?>">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label text-dark small-font">Car Model</label>
                                <input type="text" name="model" id="model" placeholder="GDHBNFF" class="form-control text-dark" value="<?php if(isset($models)){echo $models;} ?>">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label text-dark small-font">Company Name</label>
                                <select name="company" id="" class="form-control">
                                    <option value="">Select Company</option>
                                    <option value="lexus">Lexus</option>
                                    <option value="bmw">BMW</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="docs" class="form-label text-dark small-font">Upload Docs</label>
                                <input type="file" name="docs" id="docs" class="form-control">
                            </div>

                            <div class="mt-4 mb-2">
                                <a href="supAdminClient.php" class="btns psuedo_design pad dark small-font">Close</a>
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