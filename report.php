<?php
session_start();

if (!isset($_SESSION['admin_role'])) {
    header("Location:login.php");
}

include "includes/config.php";

// get all table names in the db

$sql = "SHOW TABLES;";
$res = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "includes/header.php";
    // include "includes/sweetalert.php";
    ?>
    <link rel="stylesheet" href="css/dashboard.css?v=<?= time(); ?>">
    <title>Admin | Report</title>

    <style>

    </style>
</head>

<body>
    <!-- $_SESSION['error_msg'] -->
    <!-- Generate client by date -->
    <?php
    if (isset($_SESSION['error_msg'])) : ?>
        <div class="msg-container" id="msg-container">
            <div class="message">
                <h3 class="text-danger">Error!</h3>
                <h5><?= $_SESSION['error_msg'] ?></h5>
                <a href="report.php" class="btn btn-danger mt-4">Close</a>
            </div>
        </div>

    <?php endif;
    unset($_SESSION['error_msg']);
    ?>

    <!-- generate between two dates with company  -->
    <div class="modal fade" id="generate_client_by_date" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content p-4">
                <span class="text-center mt-2">In this section you can generate report either specific date or between two dates. input the same date for specific date</span>
                <div class="modal-body">
                    <div class="mb-3">

                        <form method="post" action="generate_report.php">
                            <div class="mb-3">
                                <label for="tables" class="select-label">Select Table</label>
                                <select name="tables" id="" class="form-select">
                                    <option value="customer">Client</option>
                                    <option value="transactions_history">Transaction History</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tables" class="select-label">Select Company</label>
                                <select name="company" id="" class="form-select">
                                    <option value="lexus">lexus</option>
                                    <option value="bmw">bmw</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">From: </label>
                                <input type="date" name="from" id="from" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">To: </label>
                                <input type="date" name="to" id="to" class="form-control">
                            </div>

                            <div class="mb-3">
                                <button type="submit" name="client" class="btn btn-success">Generate</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- between two dates -->
    <div class="modal fade" id="between_two_dates" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content p-4">
                <span class="text-center mt-2">In this section you can generate report either specific date or between two dates. input the same date for specific date</span>
                <div class="modal-body">
                    <div class="mb-3">

                        <form method="post" action="generate_report.php">

                            <div class="mb-3">
                                <label for="tables" class="select-label">Select Table</label>
                                <select name="tables" id="" class="form-select">
                                    <option value="customer">Client</option>
                                    <option value="transactions_history">Transaction History</option>
                                    <option value="user">Users</option>
                                    <option value="request_form">Request Form</option>
                                    <option value="login_history">Login History</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">From: </label>
                                <input type="date" name="from" id="from" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">To: </label>
                                <input type="date" name="to" id="to" class="form-control">
                            </div>

                            <div class="mb-3">
                                <button type="submit" name="between_two_dates" class="btn btn-success">Generate</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- all data -->
    <div class="modal fade" id="all_data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content p-4">
                <span class="text-center mt-2">In this section you can generate all data from a specific table</span>
                <div class="modal-body">
                    <div class="mb-3">

                        <form method="post" action="generate_report.php">

                            <div class="mb-3">
                                <label for="tables" class="select-label">Select Table</label>
                                <select name="tables" id="" class="form-select">
                                    <option value="customer">Client</option>
                                    <option value="transactions_history">Transaction History</option>
                                    <option value="user">Users</option>
                                    <option value="request_form">Request Form</option>
                                    <option value="login_history">Login History</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <button type="submit" name="all_data" class="btn btn-success">Generate</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- main content -->
    <div class="wrapper" id="wrapper">
        <!-- import TopNavbar -->
        <?php include "includes/navBar.php"; ?>

        <div class="adminTable d-flex justify-content-between align-items-center mt-4 mb-4">
            <h5>Generate Reports</h5>
        </div>

        <div class="row">

            <!-- Generate Client -->
            <div class="col-md-3 me-3 report">
                <div class="title">
                    <i class="bx bxs-download text-light fs-1"></i>
                    <h5 class="mt-2 mb-2 text-center">Generate by:</h5>
                </div>

                <div class="dash-link mt-3">
                    <div class="mb-1">
                        <button class="btn btn-outline-success text-light" onclick="open_generate_modal('date_with_company')">Between two dates by company</button>
                    </div>
                    <div class="mb-1">
                        <button class="btn btn-outline-success text-light" onclick="open_generate_modal('between_two_dates')">Between two dates</button>
                    </div>
                    <div class="mb-1">
                        <a href="#" class="btn btn-outline-success text-light text-decoration-none " onclick="open_generate_modal('all')">All Data</a>
                    </div>
                </div>
            </div>


            <!-- Generate Archives -->
            <!-- <div class="col-md-3 me-3 report">
                <div class="title">
                    <i class="bx bxs-download text-light fs-1"></i>
                    <h5 class="mt-2 mb-2 text-center">Generate Archives by:</h5>
                </div>

                <div class="dash-link mt-3">
            
                    <div class="mb-1">
                        <a href="generate_report.php?generate=deleted_client_account" class="btn btn-outline-success text-light" onclick="">Deleted Client</a>
                    </div>

                    <div class="mb-1">
                        <a href="generate_report.php?generate=deleted_transactions_history" class="btn btn-outline-success text-light">Deleted Transactions</a>
                    </div>

                    <div class="mb-1">
                        <a href="generate_report.php?generate=login_history" class="btn btn-outline-success text-light text-decoration-none ">Login History</a>
                    </div>

                </div>
            </div> -->
        </div>




    </div>

    <!-- import sidebar -->
    <?php include "includes/sidebar.php"; ?>
    <?php include "includes/script.php"; ?>
    <script src="includes/app.js"></script>


    <script>
        function open_generate_modal(modal) {

            if (modal == 'date_with_company') {
                $("#generate_client_by_date").modal("show");
            }

            if (modal == 'between_two_dates') {
                $("#between_two_dates").modal("show");
            }

            if (modal == 'all') {
                $("#all_data").modal("show");
            }

            // all_data
        }
    </script>

</body>


</html>