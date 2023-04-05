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
    <?php include "includes/header.php"; ?>
    <link rel="stylesheet" href="css/dashboard.css?v=<?= time(); ?>">
    <title>Admin | Transaction</title>
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
            <h5>Transaction History</h5>
            <?php
            if (isset($_SESSION['success_upload'])) {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> <?= $_SESSION['success_upload'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                unset($_SESSION['success_upload']);
            }
        ?>
        </div>

    
        <!-- live search -->
        <div class="filter d-flex align-items-center mt-3 mb-3">

            <div class="live-search">
                <input type="search" name="search" id="search" placeholder="Try Something">
            </div>

            <!-- Example single danger button -->
            <div class="btn-group">
                <select name="" id="columnName" class="filterBtn form-select" onchange="filterBy()">
                    <option disabled selected>Filter by</option>
                    <option value="customerName">Client's Name</option>
                    <option value="csNumber">CS Number</option>
                    <option value="paymentStatus">Payment Status</option>
                    <option value="dateAdded">Date Added</option>
                    <option value="date_paid">Date Paid</option>
                    <option value="dateRetrieved">Date Retrieved</option>
                </select>
            </div>

        </div>


        <div class="displayAccount mt-4" id="transaction_table">

        </div>
    </div>
    <!-- import sidebar -->
    <?php include "includes/sidebar.php"; ?>
    <?php include "includes/script.php" ?>

    <script src="includes/app.js"></script>

    <script>
        $(document).ready(() => {
            displayAccounts();

            // nice scroll js
            $("#transaction_table").niceScroll({
                cursorwidth: "8px",
                autohidemode: false,
                zindex: 999,
                cursorcolor: "#FF70DF",
                cursorborder: "none",
            });

            // live search
            $("#search").keyup(function() {
                var search = $(this).val();

                if (search != "") {
                    var data = {
                        search: search,
                        action: 1,
                        btn: "transact_search",
                        table: "transactions_history"
                    }
                    $.ajax({
                        url: "displayData.php",
                        method: "POST",
                        data: data,
                        success: (res, status) => {
                            // console.log(res)
                            $("#transaction_table").html(res);
                        }
                    });
                } else {
                    displayAccounts();
                }

            });
        });

    
        function updateAccount(e) {
            e.preventDefault();
            // editName
            // editRole
            // editUsername
            // editPassword

            var editName = $("#editName").val();
            var editRole = $("#editRole").val();
            var editUsername = $("#editUsername").val();
            var editPassword = $("#editPassword").val();


            var data = {
                updateID: $("#updateID").val(),
                editName: $("#editName").val(),
                editRole: $("#editRole").val(),
                editUsername: $("#editUsername").val(),
                editPassword: $("#editPassword").val(),
                editBtn: 1
            }

            // first client side validation

            if (editName.length == 0 || editUsername.length == 0 || editPassword.length == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'All fields are mandatory',
                });
            } else {
                // check the size of a string
                if (editName.length < 8 || editUsername.length < 8 || editPassword.length < 8) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Name, Username & Password must be atleast 8 characters long',
                    });
                } else {
                    // process the data
                    $.ajax({
                        url: "updateData.php",
                        method: "post",
                        data: data,
                        success: (res) => {

                            var response = JSON.parse(res);

                            if (response.status == 422) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.message,
                                    // response.message
                                });
                            } else if (response.status == 500) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.message,
                                    // response.message
                                });
                            } else {
                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'success',
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                // hide modal
                                $("#editModal").modal('hide');
                                displayAccounts();
                            }
                        }
                    });
                }
            }
        }

        function filterBy() {
            let columnName = $("#columnName").val();
            // alert(columnName)
            $.ajax({
                url: "displayData.php",
                method: "POST",
                data: {
                    filter_transact: 1,
                    columnName: columnName
                },
                success: (res) => {
                    // console.log(res)
                    $("#transaction_table").html(res);
                    $("#search").val('');
                }
            });
        }
        
        function viewEditAccount(id) {
            $("#updateID").val(id);

            // editName
            // editRole
            // editUsername
            // editPassword

            var data = {
                id: id,
                viewEditBtn: 1
            }

            $.ajax({
                url: "displayData.php",
                method: "post",
                data: data,
                success: (res, status) => {
                    var response = JSON.parse(res);
                    if (status == "success") {
                        $("#editName").val(response.adminName);
                        $("#editUsername").val(response.username);
                        $("#editPassword").val(response.password);
                        $("#editRole").val(response.role);
                        // editRole
                        $("#editModal").modal('show');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Failed to retirevd',
                        });
                    }

                }
            });
        }

        function viewAdminAccount(id) {

            var data = {
                id: id,
                view_reciept: 1
            }
            $.ajax({
                url: "displayData.php",
                method: "post",
                data: data,
                success: (res, status) => {

                    // // console.log(response);
                    if (res != "empty") {
                        $("#viewModal").modal('show');
                        var img = document.getElementById('forms').src = `uploads/` + `${res}`;
                        console.log(img);
                    } else {
                        document.getElementById('forms').src = `uploads/default_img.jpg`;
                    }
                }
            });
        }

        function displayAccounts() {
            $.ajax({
                url: "displayData.php",
                method: "post",
                data: {
                    display_transaction: 1
                },
                success: (res) => {
                    $("#transaction_table").html(res);
                    // console.log(res);
                }
            });
        }
    </script>
</body>

</html>