<?php
session_start();

if (!isset($_SESSION['admin_role'])) {
    header("Location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "includes/header.php";
    // include "includes/sweetalert.php";
    ?>
    <link rel="stylesheet" href="css/dashboard.css?v=<?= time(); ?>">
    <title>Admin | Archive</title>
</head>

<body>

    <!-- main content -->
    <div class="wrapper" id="wrapper">
        <!-- import TopNavbar -->
        <a href="supAdminDashboard.php" class=" mt-3 btn btn-success text-decoration-none">Back to Admin</a>
        <div class="adminTable d-flex justify-content-between align-items-center mt-4">
            <h5>Archive Dashboard</h5>
        </div>

        <div class="row d-flex  align-items-center justify-content-around">

            <a href="archive_admin.php" class="text-decoration-none col-md-2 d-flex text-light align-items-center justify-content-between p-4 border border-success m-2 rounded-3">
                <div class="title">
                    <h5>Admin</h5>
                </div>
                <i class='bx bxs-user-circle fs-1'></i>
            </a>

            <a href="archive_client.php" class="text-decoration-none col-md-2 d-flex text-light align-items-center justify-content-between p-4 border border-success m-2 rounded-3">
                <div class="title">
                    <h5>Client</h5>
                </div>
                <i class='bx bxs-user-detail fs-1'></i>
            </a>

            <a href="archive_transactions.php" class="text-decoration-none col-md-2 d-flex text-light align-items-center justify-content-between p-4 border border-success m-2 rounded-3">
                <div class="title text-left">
                    <h5>Transactions</h5>
                </div>
                <i class='bx bxs-bank fs-1'></i>
            </a>

            <a href="archive_user.php" class="text-decoration-none col-md-2 d-flex text-light align-items-center justify-content-between p-4 border border-success m-2 rounded-3">
                <div class="title">
                    <h5>Users</h5>
                </div>
                <i class='bx bx-user fs-1'></i>
            </a>
            <a href="archive_request.php" class="text-decoration-none col-md-2 d-flex text-light align-items-center justify-content-between p-4 border border-success m-2 rounded-3">
                <div class="title">
                    <h5>Request</h5>
                </div>
                <i class='bx bx-folder-open fs-1'></i>
            </a>
        </div>
    </div>

    <!-- import sidebar -->
    
    <?php include "includes/script.php"; ?>
    <script src="includes/app.js"></script>
    <script src="main.js"></script>



</body>


</html>