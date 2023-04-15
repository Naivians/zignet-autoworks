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
    <title>Admin | Request Form</title>
</head>

<body>

    <!-- view request-->
    <div class="modal fade " id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!-- move -->
        <div class="modal-dialog">
            <!-- modal-client -->
            <div class="modal-content">

                <h5 class="text-center text-dark mt-4">Users's Details</h5>

                <div class="modal-body">
                    <!-- form here -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="form-label text-secondary small-font">User ID</label>
                            <input type="text" name="user_id" id="user_id" class="form-control text-dark" disabled>
                        </div>
                        <input type="hidden" name="" id="update_request_id">
                        <div class="col-md-6">
                            <label for="" class="form-label text-secondary small-font">Request ID</label>
                            <input type="text" name="request_id" id="request_id" class="form-control text-dark" disabled>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label text-secondary small-font">Display Name</label>
                            <input type="text" name="display_name" id="display_name" class="form-control text-dark" disabled>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label text-secondary small-font">Company</label>
                            <input type="text" name="company" id="company" class="form-control text-dark">
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label text-secondary small-font">Model</label>
                            <input type="text" name="model" id="model" class="form-control text-dark">
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label text-secondary small-font">CS Number</label>
                            <input type="text" name="cs_number" id="cs_number" class="form-control text-dark">
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label text-secondary small-font">Schedule</label>
                            <input type="date" name="schedule" id="schedule" class="form-control text-dark">
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label text-secondary small-font">Front Windshield</label>
                            <input type="text" name="front_windshield" id="front_windshield" class="form-control text-dark">
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label text-secondary small-font">Rear Windshield</label>
                            <input type="text" name="rear_windshield" id="rear_windshield" class="form-control text-dark">
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label text-secondary small-font">Front Side Windows</label>
                            <input type="text" name="front_side_windows" id="front_side_windows" class="form-control text-dark">
                        </div>


                        <div class="col-md-6">
                            <label for="" class="form-label text-secondary small-font">Rear Side Windows</label>
                            <input type="text" name="rear_side_windows" id="rear_side_windows" class="form-control text-dark">
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label text-secondary small-font">Date Created</label>
                            <input type="text" name="date_added" id="date_added" class="form-control text-dark" disabled>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label text-secondary small-font">Date Modified</label>
                            <input type="text" name="date_modified" id="date_modified" class="form-control text-dark" disabled>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label text-secondary small-font">Date Retrieved</label>
                            <input type="text" name="date_retrieved" id="date_retrieved" class="form-control text-dark" disabled>
                        </div>
                    </div>
                    <div class="mb-3 mt-3">
                        <button type="button" class="btn btn-success" onclick="update_request()">Update</button>
                    </div>
                    <!-- <p class="mt-3 text-danger text-center">Click anywhere to close</p> -->
                </div>
            </div>
        </div>
    </div>



    <!-- Edit Modal -->
    <!-- <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content modal-color modal-client">
                <div class="car">
                    <img src="img/car3.png" alt="cars">
                </div>

                <div class="shape">
                    <img src="img/Rectangle.png" alt="rectangle shape">
                </div>
                <h5 class="text-center text-light mt-2">Edit Account</h5>
                <form>
                    <div class="modal-body">
                        form here
                        <div class="">
                            <label for="" class="form-label gray small-font">Admin Name</label>
                            <input type="text" name="fnameawda" id="editName" placeholder="John" class="form-control text-dark">
                        </div>

                        <input type="hidden" id="updateID">;

                        <div class="mb-3">
                            <label for="" class="form-label text-light small-font">Role</label>
                            <select class="form-select" aria-label="Default select example" id="editRole">
                                <option selected disabled value="">Select Role</option>
                                <option value="super admin">Super Admin</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label gray small-font">Username</label>
                            <input type="text" name="fnameawda" id="editUsername" placeholder="John" class="form-control text-dark">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label text-secondary small-font">Password</label>
                            <input type="password" name="fnameawdaw" id="editPassword" class="form-control text-dark">
                            <div class="d-flex align-items-center">
                                <span class="mt-1 text-secondary small-font me-2">Show Password</span>
                                <input type="checkbox" onclick="showPass('editPassword')">
                            </div>
                            <span style="color:#333333;" class="small-font">This password is encrypted with most secure algorithm, so ask the developer once you forgot it.</span>
                        </div>

                        <div class="mt-4 mb-2">
                            <button class="btns fullwidth mb-2 small-font" onclick="updateAccount(event)">Update</button>
                            <button type="button" class="btns fullwidth dark small-font" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div> -->

    <!-- main content -->
    <div class="wrapper" id="wrapper">
        <!-- import TopNavbar -->
        <?php include "includes/navBar.php"; ?>

        <div class="adminTable d-flex justify-content-between align-items-center mt-4">
            <h5>Users Request Form</h5>
        </div>

        <!-- live search -->
        <div class="filter d-flex align-items-center mt-3 mb-3">

            <div class="live-search">
                <input type="search" id="search" placeholder="Try Something">
            </div>

            <!-- Example single danger button -->
            <!-- <div class="btn-group">
                <select name="" id="columnName" class="filterBtn form-select" onchange="filterBy()">
                    <option disabled selected>Sort by</option>
                    <option value="adminName">Admin Name</option>
                    <option value="username">Username</option>
                    <option value="role">Role</option>
                    <option value="dateAdded">Date Added</option>
                    <option value="dateModified">Date Modified</option>
                    <option value="retrievedDate">Date Retrieved</option>
                </select>
            </div> -->

        </div>

        <div class="displayAccount mt-4" id="adminTable">
            <!-- table for admin accounts -->
        </div>

    </div>

    <!-- import sidebar -->
    <?php include "includes/sidebar.php"; ?>
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
                        btn: "request_search",
                        table: "request_form"
                    }
                    $.ajax({
                        url: "displayData.php",
                        method: "POST",
                        data: data,
                        success: (res, status) => {
                            // console.log(res);
                            $("#adminTable").html(res);
                        }
                    });
                } else {
                    displayAccounts();
                }

            });
        });


        // function updateAccount(e) {
        //     e.preventDefault();
        //     // editName
        //     // editRole
        //     // editUsername
        //     // editPassword

        //     var editName = $("#editName").val();
        //     var editRole = $("#editRole").val();
        //     var editUsername = $("#editUsername").val();
        //     var editPassword = $("#editPassword").val();


        //     var data = {
        //         updateID: $("#updateID").val(),
        //         editName: $("#editName").val(),
        //         editRole: $("#editRole").val(),
        //         editUsername: $("#editUsername").val(),
        //         editPassword: $("#editPassword").val(),
        //         editBtn: 1
        //     }

        //     // first client side validation

        //     if (editName.length == 0 || editUsername.length == 0 || editPassword.length == 0) {
        //         Swal.fire({
        //             icon: 'error',
        //             title: 'Oops...',
        //             text: 'All fields are mandatory',
        //         });
        //     } else {
        //         // check the size of a string
        //         if (editName.length < 8 || editUsername.length < 8 || editPassword.length < 8) {
        //             Swal.fire({
        //                 icon: 'error',
        //                 title: 'Oops...',
        //                 text: 'Name, Username & Password must be atleast 8 characters long',
        //             });
        //         } else {
        //             // process the data
        //             $.ajax({
        //                 url: "updateData.php",
        //                 method: "post",
        //                 data: data,
        //                 success: (res) => {

        //                     var response = JSON.parse(res);

        //                     if (response.status == 422) {
        //                         Swal.fire({
        //                             icon: 'error',
        //                             title: 'Oops...',
        //                             text: response.message,
        //                             // response.message
        //                         });
        //                     } else if (response.status == 500) {
        //                         Swal.fire({
        //                             icon: 'error',
        //                             title: 'Oops...',
        //                             text: response.message,
        //                             // response.message
        //                         });
        //                     } else {
        //                         Swal.fire({
        //                             position: 'top-center',
        //                             icon: 'success',
        //                             title: response.message,
        //                             showConfirmButton: false,
        //                             timer: 1500
        //                         });
        //                         // hide modal
        //                         $("#editModal").modal('hide');
        //                         displayAccounts();
        //                     }
        //                 }
        //             });
        //         }
        //     }
        // }

        // function filterBy() {
        //     let columnName = $("#columnName").val();

        //     $.ajax({
        //         url: "displayData.php",
        //         method: "POST",
        //         data: {
        //             filterBtn: 1,
        //             columnName: columnName
        //         },
        //         success: (res) => {
        //             $("#adminTable").html(res);
        //             $("#search").val('');
        //         }
        //     });
        // }

        function askDelete(id) {
            
            var data = {
                id: id,
                delete_client_btn: "request",
                action:1,
                table:"admins"
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

        function update_request() {
            var id = $("#update_request_id").val()
            var company = $("#company").val();
            var model = $("#model").val();
            var cs_number = $("#cs_number").val();
            var schedule = $("#schedule").val();
            var front_windshield = $("#front_windshield").val();
            var rear_windshield = $("#rear_windshield").val();
            var front_side_windows = $("#front_side_windows").val();
            var rear_side_windows = $("#rear_side_windows").val();

            if (company == "" || model == "" || cs_number == "" || schedule == "" || front_windshield == "" || rear_windshield == "" || front_side_windows == "" || rear_side_windows == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'All fields is mandatory',
                });
            } else {

                var data = {
                    id: $("#update_request_id").val(),
                    company: $("#company").val(),
                    model: $("#model").val(),
                    cs_number: $("#cs_number").val(),
                    schedule: $("#schedule").val(),
                    front_windshield: $("#front_windshield").val(),
                    rear_windshield: $("#rear_windshield").val(),
                    front_side_windows: $("#front_side_windows").val(),
                    rear_side_windows: $("#rear_side_windows").val(),
                    update_request_btn:1
                }

                $.ajax({
                    url: "updateData.php",
                    method: "POST",
                    data: data,
                    success: (res) => {
                        if (res != "success") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: res,
                            });
                        } else {

                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: "Successfully update request",
                                showConfirmButton: false,
                                timer: 1000
                            });
                            setInterval(() => {
                                window.location.reload();
                            }, 1000);
                        }
                    }
                });


            }
        }

        function viewAdminAccount(id) {
            $("#update_request_id").val(id);
            var data = {
                id: id,
                view_request_btn: 1
            }
            $.ajax({
                url: "displayData.php",
                method: "post",
                data: data,
                success: (res, status) => {

                    var response = JSON.parse(res);

                    // console.log(response);

                    // // console.log(response);
                    if (status == "success") {

                        $("#user_id").val(response.user_id);
                        $("#request_id").val(response.request_id);
                        $("#display_name").val(response.display_name);
                        $("#company").val(response.company);
                        $("#model").val(response.model);
                        $("#cs_number").val(response.cs_number);
                        $("#schedule").val(response.schedule);
                        $("#front_windshield").val(response.front_windshield);
                        $("#rear_windshield").val(response.rear_windshield);
                        $("#front_side_windows").val(response.front_side_windows);
                        $("#rear_side_windows").val(response.rear_side_windows);
                        $("#date_added").val(response.date_added);
                        $("#date_modefied").val(response.date_modefied);
                        $("#date_retrieved").val(response.date_retrieved);

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
                    get_user: 1
                },
                success: (res) => {
                    $("#adminTable").html(res);
                }
            });
        }

        // function showPass(id) {
        //     var x = document.getElementById(id);
        //     if (x.type === "password") {
        //         x.type = "text";
        //     } else {
        //         x.type = "password";
        //     }
        // }

        // function submitData() {
        //     // e.preventDefault();
        //     var name = $("#adminName").val();
        //     var pass = $("#password").val();
        //     var role = $("#role").val();
        //     var username = $("#username").val();

        //     var data = {
        //         adminName: $("#adminName").val(),
        //         password: $("#password").val(),
        //         role: $("#role").val(),
        //         username: $("#username").val(),
        //         action: 1
        //     }

        //     // client side validations
        //     if (name == "" || pass == "" || role == null) {
        //         Swal.fire({
        //             icon: 'error',
        //             title: 'Oops...',
        //             text: 'all fields are mandatory',
        //         });
        //     } else {
        //         // process data
        //         $.ajax({
        //             url: "insertData.php",
        //             method: "post",
        //             data: data,
        //             success: (res) => {

        //                 var response = JSON.parse(res);
        //                 if (response.status == 200) {
        //                     Swal.fire({
        //                         position: 'top-center',
        //                         icon: 'success',
        //                         title: response.message,
        //                         showConfirmButton: false,
        //                         timer: 1500
        //                     });
        //                     reset();
        //                     $("#adminModal").modal("hide");
        //                 } else {
        //                     Swal.fire({
        //                         icon: 'error',
        //                         title: 'Oops...',
        //                         text: response.message,
        //                     });
        //                 }

        //                 displayAccounts();
        //             }
        //         });
        //     }
        // }
    </script>


</body>


</html>