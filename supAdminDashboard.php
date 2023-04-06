<?php
session_start();

if (!isset($_SESSION['role'])) {
    header("Location:login.php");
} else {
    if ($_SESSION['role'] != "super admin") {
        header("Location:logout.php?access=1");
    }
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
        <?php include "includes/navBar.php"; ?>

        <div class="adminTable d-flex justify-content-between align-items-center mt-4">
            <h5>Dashboard</h5>
        </div>

        <div class="row">
            <div class="col-md-3 btn text-light btn-outline-success d-flex align-items-center justify-content-between p-4 me-3">
                <div class="title">
                    <h3>25+</h3>
                    <p>Clients</p>
                </div>
                <i class='bx bxs-user-circle fs-1'></i>
            </div>

            <div class="col-md-3 btn text-light btn-outline-success d-flex align-items-center justify-content-between p-4 me-3">
                <div class="title">
                    <h3>25+</h3>
                    <p>Clients</p>
                </div>
                <i class='bx bxs-user-circle fs-1'></i>
            </div>

            <div class="col-md-3 btn text-light btn-outline-success d-flex align-items-center justify-content-between p-4">
                <div class="title">
                    <h3>25+</h3>
                    <p>Users</p>
                </div>
                <i class='bx bxs-user-circle fs-1'></i>
            </div>
            
            
        </div>


    </div>

    <!-- import sidebar -->
    <?php include "includes/sidebar.php"; ?>
    <?php include "includes/script.php"; ?>
    <script src="includes/app.js"></script>


</body>


</html>