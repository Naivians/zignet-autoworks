<?php
session_start();

if (!isset($_SESSION['admin_role'])) {
    header("Location:login.php");
}

include "includes/config.php";
include "functions.php";

$todays_client = 0;
$current_week = 0;
$current_month = 0;
$current_year = 0;


$res = todays_client();
while ($row = $res->fetch_assoc()) {
    $todays_client += 1;
}

// current_week_client()

$res = current_week_client();
while ($row = $res->fetch_assoc()) {
    $current_week += 1;
}


// current_month_client()
$res = current_month_client();
while ($row = $res->fetch_assoc()) {
    $current_month += 1;
}

// current_year_client
$res = current_year_client();
while ($row = $res->fetch_assoc()) {
    $current_year += 1;
}


$inactive = inactive_users();
$active = active_users();
$total_client = getData("customer");
$total_transactions = getData("transactions_history");



$inactive = $inactive->num_rows;
$active = $active->num_rows;
$total_client = $total_client->num_rows;
$total_transactions = $total_transactions->num_rows;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "includes/header.php";
    // include "includes/sweetalert.php";
    ?>
    <link rel="stylesheet" href="css/dashboard.css?v=<?= time(); ?>">
    <title>Admin | Dashbaord</title>
</head>

<body>

    <!-- main content -->
    <div class="wrapper" id="wrapper">
        <!-- import TopNavbar -->
        <?php include "includes/navBar.php"; ?>

        <div class="adminTable d-flex justify-content-between align-items-center mt-4">
            <h5>Dashboard</h5>
        </div>

        <div class="row d-flex  align-items-center justify-content-around">

            <a href="users.php" class="text-decoration-none col-md-2 d-flex text-light align-items-center justify-content-between p-4 border border-success m-2 rounded-3">
                <div class="title">
                    <h3><?= $active ?></h3>
                    <p>Activated Users</p>
                </div>
                <i class='bx bx-user fs-1'></i>
            </a>

            <a href="users.php" class="text-decoration-none col-md-2 d-flex text-light align-items-center justify-content-between p-4 border border-success m-2 rounded-3">
                <div class="title">
                    <h3><?= $inactive ?></h3>
                    <p>Deactivated Users</p>
                </div>
                <i class='bx bx-user fs-1'></i>
            </a>

            <a href="supAdminClient.php" class="text-decoration-none col-md-2 d-flex text-light align-items-center justify-content-between p-4 border border-success m-2 rounded-3">
                <div class="title">
                    <h3><?= $total_client ?></h3>
                    <p>Clients</p>
                </div>
                <i class='bx bxs-user-detail fs-1'></i>
            </a>

            <a href="supAdminTransact.php" class="text-decoration-none col-md-2 d-flex text-light align-items-center justify-content-between p-4 border border-success m-2 rounded-3">
                <div class="title">
                    <h3><?= $total_transactions ?></h3>
                    <p>Transactions</p>
                </div>
                <i class='bx bxs-bank fs-1'></i>
            </a>
        </div>
        <div class="row align-items-center justify-content-around mt-5">
            <div class="col-md-2 d-flex text-light align-items-center justify-content-between p-4 border border-success m-2 rounded-3">
                <div class="title">
                    <h3><?= $todays_client ?></h3>
                    <p>Today's Client</p>
                </div>
                <i class='bx bxs-user-detail fs-1'></i>
            </div>

            <div class="col-md-2 d-flex text-light align-items-center justify-content-between p-4 border border-success m-2 rounded-3">
                <div class="title">
                    <h3><?= $current_week ?></h3>
                    <p>Weekly Client</p>
                </div>
                <i class='bx bxs-user-detail fs-1'></i>
            </div>

            <div class="col-md-2 d-flex text-light align-items-center justify-content-between p-4 border border-success m-2 rounded-3">
                <div class="title">
                    <h3><?= $current_month ?></h3>
                    <p>Monthly Client</p>
                </div>
                <i class='bx bxs-user-detail fs-1'></i>
            </div>
            <div class="col-md-2 d-flex text-light align-items-center justify-content-between p-4 border border-success m-2 rounded-3">
                <div class="title">
                    <h3><?= $current_year ?></h3>
                    <p>Yearly Client</p>
                </div>
                <i class='bx bxs-user-detail fs-1'></i>
            </div>
        </div>
    </div>

    <!-- import sidebar -->
    <?php include "includes/sidebar.php"; ?>
    <?php include "includes/script.php"; ?>
    <script src="includes/app.js"></script>
    <script src="main.js"></script>
    
</body>


</html>