<?php
session_start();

if (!isset($_SESSION['user_role'])) {
    header("Location:login.php");
}

include "includes/config.php";
include "functions.php";

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
        <div class="modal fade" id="view_request_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Description of Service(s)</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6><strong>ADDRESS</strong></h6>
                        <p><span id="address"></span></p>
                        <h6><strong>DESCRIPTION OF SERVICE(S)</strong></h6>
                        <p id="description"></p>
                        <h6><strong>Disapproval Message (if there is)</strong></h6>
                        <p id="disapproved"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="header">
            <h2 class="text-center mt-2">Submitted Form</h2>
        </div>
        <?php
        if (isset($msg)) : ?>
            <div class="alert alert-warning alert-dismissible fade show wrapper" role="alert">
                <strong>Warning!</strong> <?= $msg ?>
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


        <div class=" mt-3">
            <div class="form">
                <table class="table stripped">
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Service</th>
                            <th>Status</th>
                            <th>Schedule</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $user_id = $_SESSION['user_id'];
                        $res = getBY_userID("request_form", $_SESSION['user_id']);

                        // $sql = "SELECT * FROM `request_form` WHERE user_id = $user_id ORDER BY date_added ASC";
                        // $res = $conn->query($sql);
                        if ($res->num_rows > 0) {
                            while ($row  = $res->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><?= $row['request_id'] ?></td>
                                    <td><?= $row['service'] ?></td>
                                    <?php
                                    if ($row['request_status'] == "pending") {
                                    ?>
                                        <td><span class="badge text-warning"><?= $row['request_status'] ?></span></td>
                                    <?php
                                    }
                                    
                                    if ($row['request_status'] == "disapproved") {
                                    ?>
                                        <td><span class="badge text-danger"><?= $row['request_status'] ?></span></td>
                                    <?php
                                    } 
                                    
                                    if($row['request_status'] == "approved") {
                                    ?>
                                        <td><span class="badge text-success"><?= $row['request_status'] ?></span></td>
                                    <?php
                                    }
                                    ?>
                                    <td><?= $row['schedule'] ?></td>
                                    <td> <button class="btn" onclick="view_description(<?= $row['id'] ?>)"><img src="icons/view.svg" alt="view image" class="text-success"></button></td>

                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <?php
    include "includes/user_sidebar.php";
    include "includes/script.php";
    ?>

    <script>
        function view_description(id) {
            $("#view_request_modal").modal("show");
            $.ajax({
                url: "displayData.php",
                method: "POST",
                data: {
                    display_request: 1,
                    id: id
                },
                success: (res) => {
                    var response = JSON.parse(res);
                    // disapproved
                    document.getElementById("description").innerHTML = response.description_of_service;
                    document.getElementById("address").innerHTML = response.address;
                    document.getElementById("disapproved").innerHTML = response.reason;

                }
            });
        }
    </script>
</body>

</html>