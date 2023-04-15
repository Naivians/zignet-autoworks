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
    <title>Admin | Accounts</title>
</head>

<body>
    
    <!-- View Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content modal-color modal-client">
                <div class="car">
                    <img src="img/car3.png" alt="cars">
                </div>

                <div class="shape">
                    <img src="img/Rectangle.png" alt="rectangle shape">
                </div>
                <h5 class="text-center text-light mt-2">View Accounts</h5>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="" class="form-label text-light small-font">Admin Name</label>
                        <input type="text" name="fname" id="viewName" class="form-control text-dark" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label text-light small-font">Role</label>
                        <input type="text" name="fname" id="viewRole" class="form-control text-dark" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label text-light small-font">Username</label>
                        <input type="text" name="fname" id="viewUsername" class="form-control text-dark" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label text-light small-font">Password</label>
                        <input type="password" name="fname" id="viewPassword" class="form-control text-dark" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label text-secondary small-font">Date Added</label>
                        <input type="text" name="fname" id="viewDateAdded" class="form-control text-dark" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label text-secondary small-font">Date Modified</label>
                        <input type="text" name="fname" id="viewDateModified" class="form-control text-dark" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label text-secondary small-font">Date Retrieved</label>
                        <input type="text" name="fname" id="viewDateRetrieved" class="form-control text-dark" disabled>
                    </div>
                    <div class="text-center">
                        <span style="color: red" class="small-font ">Click anywhere to close</span>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Add new admin Modal -->
    <div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content modal-color modal-client">
                <div class="car">
                    <img src="img/car3.png" alt="cars">
                </div>

                <div class="shape">
                    <img src="img/Rectangle.png" alt="rectangle shape">
                </div>
                <h5 class="text-center text-light mt-2">Add New Admin</h5>
                <form method="post">
                    <div class="modal-body ">
                        <!-- form here -->
                        <div class="mb-3">
                            <label for="" class="form-label gray small-font">Admin Name</label>
                            <input type="text" name="adminName" id="adminName" placeholder="John" class="form-control text-dark" autocomplete="off">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label gray small-font">Username</label>
                            <input type="text" name="username" id="username" placeholder="JohnDoe@00" class="form-control text-dark" autocomplete="off">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label text-secondary small-font">Password</label>
                            <input type="password" name="password" id="password" placeholder="***********" class="form-control text-dark" autocomplete="off">
                            <div class="d-flex align-items-center">
                                <span class="mt-1 text-secondary small-font me-2">Show Password</span>
                                <input type="checkbox" onclick="showPass('password')">
                            </div>
                        </div>


                        <div class="mb-3">
                            <label for="" class="form-label text-secondary small-font">Role</label>
                            <select class="form-select" aria-label="Default select example" id="role">
                                <option selected disabled value="">Select Role</option>
                                <option value="super admin">Super Admin</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div class="mt-4 mb-2">

                            <button type="button" class="btns fullwidth mb-2 small-font" onclick="submitData()">Save</button>

                            <button type="button" class="btns fullwidth dark small-font" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                <h5 class="text-center text-light mt-2">Edit Account</h5>
                <form>
                    <div class="modal-body">
                        <!-- form here -->
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
    </div>

    <!-- main content -->
    <div class="wrapper" id="wrapper">
        <!-- import TopNavbar -->
        <?php include "includes/navBar.php"; ?>

        <div class="adminTable d-flex justify-content-between align-items-center mt-4">
            <h5>Admin Account</h5>
            <button data-bs-toggle="modal" data-bs-target="#adminModal" class="btns">Add new admin</button>
        </div>

        <!-- live search -->
        <div class="filter d-flex align-items-center mt-3 mb-3">

            <div class="live-search">
                <input type="search" id="search" placeholder="Try Something">
            </div>

            <!-- Example single danger button -->
            <div class="btn-group">
                <select name="" id="columnName" class="filterBtn form-select" onchange="filterBy()">
                    <option disabled selected>Sort by</option>
                    <option value="adminName">Admin Name</option>
                    <option value="username">Username</option>
                    <option value="role">Role</option>
                    <option value="dateAdded">Date Added</option>
                    <option value="dateModified">Date Modified</option>
                    <option value="retrievedDate">Date Retrieved</option>
                </select>
            </div>

        </div>

        <div class="displayAccount mt-4" id="adminTable">
            <!-- table for admin accounts -->
        </div>

    </div>

    <!-- import sidebar -->
    <?php include "includes/sidebar.php"; ?>
    <?php include "includes/script.php"; ?>
    <script src="includes/app.js"></script>
    <script src="main.js"></script>


    <script>
        $(document).ready(() => {
            displayAccounts();

            $("#search").keyup(function() {
                var search = $(this).val();

                if (search != "") {
                    var data = {
                        search: search,
                        action: 1,
                        btn: "adminSearch",
                        table: "admins"
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

            $.ajax({
                url: "displayData.php",
                method: "POST",
                data: {
                    filterBtn: 1,
                    columnName: columnName
                },
                success: (res) => {
                    $("#adminTable").html(res);
                    $("#search").val('');
                }
            });
        }

        function askDelete(id) {
            var data = {
                id: id,
                delete_client_btn: "delete",
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
            

            $("#viewModal").modal('show');
            var data = {
                id: id,
                viewBtn: 1
            }
            $.ajax({
                url: "displayData.php",
                method: "post",
                data: data,
                success: (res, status) => {
                    
                    var response = JSON.parse(res);

                    // // console.log(response);
                    if (status == "success") {
                    
                        $("#viewName").val(response.adminName);
                        $("#viewPassword").val(response.password);
                        $("#viewDateAdded").val(response.dateAdded);
                        $("#viewDateModified").val(response.dateModified);
                        $("#viewDateRetrieved").val(response.retrievedDate);
                        $("#viewRole").val(response.role);
                        $("#viewUsername").val(response.username);

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
                    getBtn: 1
                },
                success: (res) => {
                    $("#adminTable").html(res);
                }
            });
        }

        function showPass(id) {
            var x = document.getElementById(id);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function submitData() {
            // e.preventDefault();
            var name = $("#adminName").val();
            var pass = $("#password").val();
            var role = $("#role").val();
            var username = $("#username").val();

            var data = {
                adminName: $("#adminName").val(),
                password: $("#password").val(),
                role: $("#role").val(),
                username: $("#username").val(),
                action: 1
            }

            // client side validations
            if (name == "" || pass == "" || role == null) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'all fields are mandatory',
                });
            } else {
                // process data
                $.ajax({
                    url: "insertData.php",
                    method: "post",
                    data: data,
                    success: (res) => {

                        var response = JSON.parse(res);
                        if (response.status == 200) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            reset();
                            $("#adminModal").modal("hide");
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message,
                            });
                        }

                        displayAccounts();
                    }
                });
            }
        }
    </script>


</body>


</html>