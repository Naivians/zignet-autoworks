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

    <!-- generate between two dates with specific column  -->
    <div class="modal fade" id="generate_client_by_date" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content p-4">
                <span class="text-center mt-2">In this section you can generate report either specific date or between two dates. input the same date for specific date</span>
                <div class="modal-body">
                    <div class="mb-3">

                        <form method="post" action="generate_report.php">
                            <div class="mb-3">
                                <label for="tables" class="select-label text-secondary">Select Table</label>
                                <select name="tables" id="" class="form-select">
                                    <option value="customer">Client</option>
                                    <option value="transactions_history">Transaction History</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="column" class="select-label text-secondary">Select Column</label>
                                <select name="column" id="" class="form-select">
                                    <option value="client_id">Client ID</option>
                                    <option value="company">Company</option>
                                    <option value="csNumber">CS Number</option>
                                    <option value="paymentStatus">Payment Status</option>
                                </select>
                            </div>

                            <div class="input mt-3 mb-3">
                                <label for="column_value" class="form-label text-secondary">Input value relevant from selected column</label>
                                <input type="text" name="column_value" id="" class="form-control" placeholder="Type here!">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label text-secondary">From: </label>
                                <input type="date" name="from" id="from" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label text-secondary">To: </label>
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
    
    <!-- users between two dates with specific column -->
    <div class="modal fade" id="users" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content p-4">
                <span class="text-center mt-2">In this section you can generate report either specific date or between two dates. input the same date for specific date</span>
                <div class="modal-body">
                    <div class="mb-3">

                        <form method="post" action="generate_report.php">
                            <div class="mb-3">
                                <label for="tables" class="select-label text-secondary">Select Table</label>
                                <select name="tables" id="" class="form-select">
                                    <option value="user">Users</option>
                                    <option value="request_form">Request Form</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="column" class="select-label text-secondary">Select Column</label>
                                <select name="column" id="" class="form-select">
                                    <option value="user_id">User Id</option>
                                    <option value="request_id">Request ID</option>
                                    <option value="display_name">Customer Name</option>
                                </select>
                            </div>

                            <div class="input mt-3 mb-3">
                                <label for="column_value" class="form-label text-secondary">Input value relevant from selected column</label>
                                <input type="text" name="column_value" id="" class="form-control" placeholder="Type here!">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label text-secondary">From: </label>
                                <input type="date" name="from" id="from" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label text-secondary">To: </label>
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

        <div class="row d-flex align-items-center justify-content-center">

            <!-- Generate Client -->
            <div class="col-md-3 col-sm-12 me-3 report mt-3 mb-3">
                <div class="title">
                    <i class="bx bxs-download text-light fs-1"></i>
                    <h5 class="mt-2 mb-2 text-center">Generate Transaction history and Client</h5>
                </div>

                <div class="dash-link mt-3">
                    <div class="mb-1">
                        <button class="btn btn-outline-success text-light" onclick="open_generate_modal('date_with_company')">Between two dates by:</button>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12 me-3 report mt-3 mb-3">
                <div class="title">
                    <i class="bx bxs-download text-light fs-1"></i>
                    <h5 class="mt-2 mb-2 text-center">Generate Users and Request Form</h5>
                </div>

                <div class="dash-link mt-3">
                    <div class="mb-1">
                        <button class="btn btn-outline-success text-light" onclick="open_generate_modal('users')">Between two dates by:</button>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12 me-3 report mt-3 mb-3">
                <div class="title">
                    <i class="bx bxs-download text-light fs-1"></i>
                    <h5 class="mt-2 mb-2 text-center">Generate from between two dates according to table</h5>
                </div>
                <div class="mb-1">
                    <button class="btn btn-outline-success text-light" onclick="open_generate_modal('between_two_dates')">Between two dates</button>
                </div>
            </div>

            <div class="col-md-3 col-sm-12 me-3 report mt-3 mb-3">
                <div class="title">
                    <i class="bx bxs-download text-light fs-1"></i>
                    <h5 class="mt-2 mb-2 text-center">Generate data according to table</h5>
                </div>
                <div class="dash-link mt-3">
                    <div class="mb-1">
                        <a href="#" class="btn btn-outline-success text-light text-decoration-none " onclick="open_generate_modal('all')">All Data</a>
                    </div>
                </div>
            </div>
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

            if (modal == 'users') {
                $("#users").modal("show");
            }

            // all_data
        }
    </script>

</body>


</html>