<?php
session_start();

if (!isset($_SESSION['role'])) {
    header("Location:login.php");
} else {
    if ($_SESSION['role'] != "user") {
        header("Location:logout.php?access=1");
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
            <img src="img/ZIGNET.png" alt="">
            <h2 class="text-center mt-2">Request Form</h2>
        </div>

        <div class="wrapper mt-3">
            <div class="form">
                <form>
                    <h5 class="text-primary mt-3">Car Details</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label text-secondary">Company</label>
                                <input type="text" name="company" id="company" class="form-control" placeholder="Enter Company Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label text-secondary">Model</label>
                                <input type="text" name="model" id="model" class="form-control" placeholder="Enter Car Model">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label text-secondary">CS Number</label>
                                <input type="text" name="cs_number" id="cs_number" class="form-control" placeholder="Enter CS Number">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label text-secondary">Schedule</label>
                                <input type="date" name="sched" id="sched" class="form-control">
                            </div>
                        </div>
                    </div>


                    <h5 class="text-primary mt-2">Tint Details</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label text-secondary">Front Windshield</label>
                                <input type="text" name="front_windshield" id="front_windshield" class="form-control" placeholder="Enter Front Windshield">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label text-secondary">Rear Windshield</label>
                                <input type="text" name="rear_windshield" id="rear_windshield" class="form-control" placeholder="Enter Rear Windshield">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label text-secondary">Front Windows</label>
                                <input type="text" name="front_windows" id="front_windows" class="form-control" placeholder="Enter Front Windows">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label text-secondary">Rear Windows</label>
                                <input type="text" name="rear_windows" id="rear_windows" class="form-control" placeholder="Enter Rear Windows">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 mt-3">
                        <button type="button" class="btn btn-outline-success" onclick="submit_request()">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php
    include "includes/user_sidebar.php";
    include "includes/script.php";
    ?>

    <script>
        function submit_request() {

            let data = {
                company: $("#company").val(),
                model: $("#model").val(),
                cs_number: $("#cs_number").val(),
                sched: $("#sched").val(),
                front_windshield: $("#front_windshield").val(),
                rear_windshield: $("#rear_windshield").val(),
                front_windows: $("#front_windows").val(),
                rear_windows: $("#rear_windows").val(),
                request_btn: 1
            }
            
            $.ajax({
                url: "insertData.php",
                method: "POST",
                data: data,

                success: (res) => {

                    if (res == "success") {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Successfully Submit Request',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        window.reset();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: res,
                        });
                    }
                }
            });

        }
    </script>
</body>

</html>