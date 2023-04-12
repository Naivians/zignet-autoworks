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
    <title>Admin | Archive </title>
</head>

<body>

    <!-- View Client Modal-->
    <div class="modal fade " id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!-- move -->
        <div class="modal-dialog">
            <!-- modal-client -->
            <div class="modal-content">

                <h5 class="text-center text-dark mt-4 mb-4">View Reciept</h5>

                <div class="docs p-3" id="zoom-container">
                    <img src="forms/bmw.jpg" id="forms">
                </div>

            </div>
        </div>
    </div>

    <!-- main content -->
    <div class="wrapper" id="wrapper">
        <!-- import TopNavbar -->
        <?php include "includes/navBar.php"; ?>

        <div class="adminTable d-flex justify-content-between align-items-center mt-4">
            <h5>Deleted Transactions</h5>
            <!-- live search -->
            <div class="filter d-flex align-items-center mt-3 mb-3">
                <div class="live-search">
                    <input type="search" id="search" placeholder="Search admin name">
                </div>

            </div>
        </div>

        <div class="displayAccount mt-4" id="adminTable">
            <!-- table for admin accounts -->
        </div>

    </div>

    <!-- import sidebar -->
    <?php include "includes/archiveSidebar.php"; ?>
    <?php include "includes/script.php"; ?>
    <script src="includes/app.js"></script>


    <script>
        $(document).ready(() => {
            displayAccounts();

            $("#search").keyup(function() {
                var search = $(this).val();

                if (search != "") {

                    var data = {
                        search: search,
                        action: 1,
                        btn: "search_deleted_transactions",
                        table: "deleted_transactions_history"
                    }

                    $.ajax({
                        url: "displayData.php",
                        method: "POST",
                        data: data,
                        success: (res, status) => {
                            $("#adminTable").html(res);
                        }
                    });
                } else {
                    displayAccounts();
                }

            });
        });

        function viewAdminAccount(client_id) {
            $.ajax({
                url: "displayData.php",
                method: "POST",
                data: {
                    client_id: client_id,
                    view_deleted_transact_btn: 1,
                },
                success: (res) => {
                    if (res == "empty") {
                        alert("Failed to load image")
                    } else {
                        var img = document.getElementById("forms").src = `uploads/` + `${res}`; 
                        $("#viewModal").modal("show");
                    }
                }
            });
        }

        function displayAccounts() {
            $.ajax({
                url: "displayData.php",
                method: "post",
                data: {
                    deleted_transactions: 1
                },
                success: (res) => {
                    $("#adminTable").html(res);
                }
            });
        }
    </script>


</body>


</html>