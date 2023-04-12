<?php

session_start();

if (!isset($_SESSION['admin_role'])) {
    header("Location:login.php");
}

include "includes/config.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/header.php"; ?>
    <link rel="stylesheet" href="css/dashboard.css?v=<?= time(); ?>">
    <title>Admin | Client</title>

</head>

<body>


    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content modal-color modal-client">
                <div class="car">
                    <img src="img/car3.png" alt="cars">
                </div>

                <div class="shape">
                    <img src="img/Rectangle.png" alt="rectangle shape">
                </div>
                <h5 class="text-center text-light mt-2">Edit Customer Details</h5>
                <form>
                    <div class="modal-body">
                        <!-- form here -->
                        <div class="mb-3">
                            <label for="" class="form-label gray small-font">Customer Name</label>
                            <input type="text" name="fname" id="edit_customer_name" placeholder="John Doe" class="form-control text-dark">
                        </div>

                        <input type="hidden" name="updateID" id="updateID">

                        <div class="mb-3">
                            <label for="" class="form-label text-light small-font">CS Number</label>
                            <input type="text" name="fname" id="edit_cs_number" placeholder="SSEDRFF" class="form-control text-dark">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label text-dark small-font">Car Model</label>
                            <input type="text" name="fname" id="edit_model" placeholder="GDHBNFF" class="form-control text-dark">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label text-secondary small-font">Company Name</label>
                            <input type="text" name="" id="edit_company" class="form-control">
                        </div>

                        <div class="mt-4 mb-2">
                            <button type="button" class="btns fullwidth mb-2 small-font" onclick="updateAccount()">Update</button>
                            <button type="button" class="btns fullwidth dark small-font" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- View Client Modal-->
    <div class="modal fade " id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!-- move -->
        <div class="modal-dialog">
            <!-- modal-client -->
            <div class="modal-content">

                <div class="docs" id="zoom-container">
                    <img src="forms/bmw.jpg" id="docs">
                </div>

                <h5 class="text-center text-dark mt-4">Client's Full Details</h5>

                <div class="modal-body">
                    <!-- form here -->
                    <div class="mb-2">
                        <label for="" class="form-label text-secondary small-font">Clients Name</label>
                        <input type="text" name="fname" id="client_name" class="form-control text-dark" disabled>
                    </div>

                    <div class="mb-2">
                        <label for="" class="form-label text-secondary small-font">CS Number</label>
                        <input type="text" name="fname" id="cs_number" class="form-control text-dark" disabled>
                    </div>

                    <div class="mb-2">
                        <label for="" class="form-label text-secondary small-font">Car Model</label>
                        <input type="text" name="fname" id="model" class="form-control text-dark" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label text-secondary small-font">Company Name</label>
                        <input type="text" name="fname" id="company" class="form-control text-dark" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- $_SESSION['success'] -->
    <!-- main content -->
    <div class="wrapper" id="wrapper">
        <!-- import TopNavbar -->
        <?php include "includes/navBar.php"; ?>

        <div class="adminTable d-flex justify-content-between align-items-center mt-4">
            <h5>Customers Account</h5>
            <?php
            if (isset($_SESSION['failed_to_insert'])) {
            ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> <?= $_SESSION['failed_to_insert'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }

            if (isset($_SESSION['success'])) {
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> <?= $_SESSION['success'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }
            unset($_SESSION['failed_to_insert']);
            unset($_SESSION['success']);
            ?>

            <a href="admin_insert_client.php" class="btns psuedo_design">Add New Client</a>
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
                    <option value="customerName">Customer's Name</option>
                    <option value="csNumber">CS Number</option>
                    <option value="model">Model</option>
                    <option value="dateAdded">Date Added</option>
                    <option value="dateModified">Date Modified</option>
                    <option value="retrievedDate">Retrieved Date</option>
                    <option value="company">Company</option>
                </select>
            </div>
        </div>

        <div class="displayAccount mt-4" id="client_table">
            <!-- display clients data using ajax and jquery -->
        </div>
    </div>
    <!-- import sidebar -->
    <?php include "includes/script.php" ?>
    <?php include "includes/sidebar.php"; ?>
    <script src="includes/app.js"></script>

    <script>
        $(document).ready(() => {
            displayAccounts();

            // nice scroll js
            $("#client_table").niceScroll({
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
                        btn: "client_search",
                        table: "customer"
                    }
                    $.ajax({
                        url: "displayData.php",
                        method: "POST",
                        data: data,
                        success: (res, status) => {
                            $("#client_table").html(res);
                        }
                    });
                } else {
                    displayAccounts();
                }

            });
        });

        function updateAccount() {

            var id = $("#updateID").val();

            var edit_customer_name = $("#edit_customer_name").val();
            var edit_company = $("#edit_company").val();
            var edit_model = $("#edit_model").val();
            var edit_cs_number = $("#edit_cs_number").val();



            var data = {
                client_id: $("#updateID").val(), 
                edit_customer_name: $("#edit_customer_name").val(),
                edit_company: $("#edit_company").val(),
                edit_model: $("#edit_model").val(),
                edit_cs_number: $("#edit_cs_number").val(),
                update_client_btn: 1
            }

            // first client side validation

            if (edit_customer_name.length == 0 || edit_company.length == 0 || edit_model.length == 0 || edit_cs_number.length == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'All fields are mandatory',
                });
            } else {
                // process the data
                $.ajax({
                    url: "updateData.php",
                    method: "post",
                    data: data,
                    success: (res) => {
                        if (res != "success") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: res,
                                // response.message
                            });
                        } else {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: "Successfully update",
                                showConfirmButton: false,
                                timer: 1500
                            });

                            $("#editModal").modal('hide');
                            displayAccounts();
                        }
                    }
                });
            }
        }

        function filterBy() {
            let columnName = $("#columnName").val();

            $.ajax({
                url: "displayData.php",
                method: "POST",
                data: {
                    filter_client: 1,
                    columnName: columnName
                },
                success: (res) => {
                    $("#client_table").html(res);
                    $("#search").val('');
                }
            });
        }

        function askDelete(id) {

            var data = {
                id: id,
                delete_client_btn: "delete_client_btn",
                action: 1,
                table: "customer"
            };

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: "deleteData.php",
                        method: "post",
                        data: data,
                        success: (res) => {

                            console.log(res);

                            var response = JSON.parse(res);

                            if (response.status == 200) {
                                if (result.isConfirmed) {
                                    Swal.fire("Deleted!", response.message, "success");
                                }
                                displayAccounts();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.messsage,
                                });
                            }
                        }
                    });
                }


            });
        }

        function viewEditAccount(id) {
            $("#updateID").val(id);

            var data = {
                id: id,
                view_client_btn: 1
            }

            $.ajax({
                url: "displayData.php",
                method: "post",
                data: data,
                success: (res, status) => {
                    var response = JSON.parse(res);

                    if (status == "success") {
                        $("#edit_customer_name").val(response.customerName);
                        $("#edit_cs_number").val(response.csNumber);
                        $("#edit_model").val(response.model);
                        $("#edit_company").val(response.company);
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
            
            // $("#viewModal").modal('show');

            var data = {
                id: id,
                view_client_btn: 1
            }
            $.ajax({
                url: "displayData.php",
                method: "post",
                data: data,
                success: (res, status) => {

                    var response = JSON.parse(res);

                    // // console.log(response);
                    if (status == "success") {
                        $("#client_name").val(response.customerName);
                        $("#cs_number").val(response.csNumber);
                        $("#model").val(response.model);
                        $("#company").val(response.company);
                        var img = document.getElementById("docs").src = `uploads/` + `${response.img_path}`;

                        console.log(img);
                        $("#viewModal").modal('show');
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

        function displayAccounts() {
            $.ajax({
                url: "displayData.php",
                method: "post",
                data: {
                    display_client: 1
                },
                success: (res) => {
                    $("#client_table").html(res);
                }
            });
        }
    </script>


</body>

</html>