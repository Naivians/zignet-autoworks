<?php
session_start();

if (!isset($_SESSION['user_role'])) {
    header("Location:login.php");
}

include "includes/config.php";
include "functions.php";

$description = '';

if (isset($_POST['submit'])) {

    $service_description = $conn->escape_string($_POST['service_description']);
    $address = $conn->escape_string($_POST['address']);
    $schedule = $conn->escape_string($_POST['schedule']);

    $description_of_service = str_replace('\r\n', "<br>", $service_description);
    $address = str_replace('\r\n', "<br>", $address);
    
    if (!isset($_POST['services'])) {
        $_SESSION['msg'] = "Please select type of service";
    } else {

        if ($schedule != NULL) {
            $service_array = $_POST['services']; //array of s   trings
            
            $split_services = implode(",", $service_array);

            $request_id = uniqid();
            $res = insert_form($_SESSION['user_id'], $request_id, $_SESSION['display_name'], $address,  $split_services, $description_of_service, 'pending', $schedule);

            if (!$res) {
                $_SESSION['msg'] = "Failed to send request!";
            } else {
                $_SESSION['success'] = "request has been sent";
                //    redirect to request
            }
        } else {
            $_SESSION['msg'] = "All fields required!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/header.php"; ?>
    <title>User | Dashboard</title>
    <link rel="stylesheet" href="css/user.css?<?= time(); ?>">
</head>

<body>
    <main class="main">
        <div class="header">
            <h2 class="text-center mt-2">Request Form</h2>
        </div>
        <?php
        if (isset($_SESSION['msg'])) : ?>
            <div class="alert alert-warning alert-dismissible fade show wrapper" role="alert">
                <strong>Warning!</strong> <?= $_SESSION['msg'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            </div>
            </div>
        <?php endif;


        if (isset($_SESSION['success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show wrapper" role="alert">
                <strong>Warning!</strong> <?= $_SESSION['success'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            </div>
            </div>
        <?php endif;

        unset($_SESSION['success']);
        unset($_SESSION['msg']);
        ?>
        <div class="wrapper mt-3">
            <div class="form">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="" class="form-label text-secondary">Select Type of Service</label>
                                <div class="form-check mb-3 mt-2">
                                    <input class="form-check-input" type="checkbox" name="services[]" value="Paint Protection Film" id="flexCheckDefault" require>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Paint Protection Film
                                    </label>
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="services[]" value="Glass Tinting" id="flexCheckDefault" require>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Glass Tinting
                                    </label>
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="services[]" value="Security Film" id="flexCheckDefault" require>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Security Film
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">

                            <div class="mb-3">
                                <label for="" class="form-label text-secondary">Address</label>
                                <textarea name="address" id="" cols="30" rows="2" class="form-control"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label text-secondary">Schedule</label>
                                <input type="date" name="schedule" id="sched" class="form-control" require>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 mt-3">
                            <div class="mb-3">
                                <label for="" class="form-label text-secondary">Description of Service(s) (maximum of 100 Character)</label>
                                <textarea name="service_description" id="" type="text" cols="30" rows="10" class="form-control" placeholder="Add a description for each service 
                                ex: Glass Tinting:
                                - Front Windows
                                - Door Window" require></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="mb-3 mt-3">
                        <button type="submit" class="btn btn-outline-success" name="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php
    include "includes/user_sidebar.php";
    include "includes/script.php";
    ?>
</body>

</html>