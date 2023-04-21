<?php

session_start();

include "includes/config.php";
include "functions.php";



if (isset($_POST['search'])) {
    $searchItem = $conn->escape_string($_POST['search_item']);
    if ($searchItem != "") {
        $sql = "SELECT * FROM `user` WHERE `user_id` LIKE '%{$searchItem}%' OR `display_name` LIKE '%{$searchItem}%' OR `contact` LIKE '%{$searchItem}%' OR `username` LIKE '%{$searchItem}%'";
        $res = $conn->query($sql);
    } else {
        $msg = "Search input is empty";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/header.php"; ?>
    <link rel="stylesheet" href="css/dashboard.css?v=<?= time(); ?>">
    <title>Admin | Users</title>
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

                <h5 class="text-center text-dark mt-4">Users's Details</h5>

                <div class="modal-body">
                    <!-- form here -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="form-label text-secondary small-font">User ID</label>
                            <input type="text" name="user_id" id="user_id" class="form-control text-dark" disabled>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label text-secondary small-font">Display Name</label>
                            <input type="text" name="display_name" id="display_name" class="form-control text-dark" disabled>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label text-secondary small-font">Password</label>
                            <input type="password" name="password" id="password" class="form-control text-dark" disabled>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label text-secondary small-font">Contact</label>
                            <input type="text" name="contact" id="contact" class="form-control text-dark" disabled>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label text-secondary small-font">Date Created</label>
                            <input type="text" name="date_added" id="date_added" class="form-control text-dark" disabled>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label text-secondary small-font">Date Modified</label>
                            <input type="text" name="date_modified" id="date_modified" class="form-control text-dark" disabled>
                        </div>

                    </div>
                    <p class="mt-3 text-danger text-center">Click anywhere to close</p>
                </div>
            </div>
        </div>
    </div>

    <!-- main content -->
    <div class="wrapper" id="wrapper">
        <!-- import TopNavbar -->
        <?php include "includes/navBar.php"; ?>

        <div class="adminTable d-flex justify-content-between align-items-center mt-4">
            <h5>Users Account</h5>
        </div>

        <?php
        if (isset($msg)) : ?>
            <div class="msg-container" id="msg-container">
                <div class="message">
                    <h3 class="text-danger">Error!</h3>
                    <h5><?= $msg ?></h5>
                    <a href="users.php" class="btn btn-danger mt-4">Close</a>
                </div>
            </div>

        <?php endif;
        ?>

        <!-- live search -->
        <div class="filter d-flex align-items-center mt-3 mb-3">

            <div class="live-search">
                <form method="post">
                    <!-- <input type="search" name="search_item" id="search" placeholder="Search Anything" require> -->

                    <input type="text" name="search_item" id="search" placeholder="Search Anything" class="border-0 search">

                    <?php
                    if (isset($res)) {
                        if ($res->num_rows > 0) {
                    ?>
                            <a href="users.php" class="btn btn-success" name="search">back</a>
                        <?php
                        } else {
                        ?>
                            <a href="users.php" class="btn btn-success" name="search">back</a>
                        <?php
                        }
                    } else {
                        ?>
                        <button class="btn btn-success" name="search">search</button>
                    <?php
                    }
                    ?>

                </form>
            </div>

            <!-- Example single danger button -->
            <!-- <div class="btn-group">
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
            </div> -->

            <!-- <div class="btn-group mx-2">
                <select name="" id="activations" class="filterBtn form-select" onchange="activate()">
                    <option disabled selected>Activations</option>
                    <option value="activate_all">Activate All</option>
                    <option value="deactivate_all">Deactivate All</option>
                </select>
            </div> -->
        </div>

        <div class="displayAccount mt-4" id="client_table">
            <?php
            if (isset($res)) {
                if ($res->num_rows > 0) {
            ?>
                    <table class="adminAcc-table">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Display Name</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Contact</th>
                                <th>Date Added</th>
                                <th>Date Modified</th>
                                <th>status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $res->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?= $row['user_id'] ?></td>
                                    <td><?= $row['display_name'] ?></td>
                                    <td><?= $row['username'] ?></td>
                                    <td><?= $row['password'] ?></td>
                                    <td><?= $row['contact'] ?></td>
                                    <td><?= $row['date_added'] ?></td>
                                    <td><?= $row['date_modified'] ?></td>
                                    <?php
                                    if ($row['active'] != 1) {
                                    ?>
                                        <td><button class="btn btn-danger badge" onclick="status('activate', '<?= $row['user_id'] ?>')">Deactivated</button></td>
                                    <?php
                                    } else {
                                    ?>
                                        <td><button class="btn btn-success badge" onclick="status('deactivate', '<?= $row['user_id'] ?>')">Activated</button></td>
                                    <?php
                                    }
                                    ?>


                                    <td>
                                        <!-- three btns for view, edit, and delete -->

                                        <!-- view -->
                                        <button class="btn" onclick="viewAdminAccount('<?= $row['user_id'] ?> ')">
                                            <img src="icons/view.svg" alt="view image" class="text-success">
                                        </button>

                                        <!-- delete -->
                                        <button class="btn" onclick="askDelete(' <?= $row['id'] ?> ')">
                                        <i class='bx bxs-archive-in text-light'></i>
                                        </button>

                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                <?php
                } else {
                    echo "<h3 class='text-danger'> No Record found</h3>";
                }
            } else {
                ?>
                <table class="adminAcc-table">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Display Name</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Contact</th>
                            <th>Date Added</th>
                            <th>Date Modified</th>
                            <th>status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $res = getData("user");
                        while ($row = $res->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?= $row['user_id'] ?></td>
                                <td><?= $row['display_name'] ?></td>
                                <td><?= $row['username'] ?></td>
                                <td><?= $row['password'] ?></td>
                                <td><?= $row['contact'] ?></td>
                                <td><?= $row['date_added'] ?></td>
                                <td><?= $row['date_modified'] ?></td>
                                <?php
                                if ($row['active'] != 1) {
                                ?>
                                    <td><button class="btn btn-danger badge" onclick="status('activate', '<?= $row['user_id'] ?>')">Deactivated</button></td>
                                <?php
                                } else {
                                ?>
                                    <td><button class="btn btn-success badge" onclick="status('deactivate', '<?= $row['user_id'] ?>')">Activated</button></td>
                                <?php
                                }
                                ?>


                                <td>
                                    <!-- three btns for view, edit, and delete -->

                                    <!-- view -->
                                    <button class="btn" onclick="viewAdminAccount('<?= $row['user_id'] ?> ')">
                                        <img src="icons/view.svg" alt="view image" class="text-success">
                                    </button>

                                    <!-- delete -->
                                    <button class="btn" onclick="askDelete(' <?= $row['id'] ?> ')">
                                    <i class='bx bxs-archive-in text-light'></i>
                                    </button>

                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            }
            ?>
            <!-- display clients data using ajax and jquery -->
        </div>
    </div>
    <!-- import sidebar -->
    <?php include "includes/script.php" ?>
    <?php include "includes/sidebar.php"; ?>
    <script src="includes/app.js"></script>

    <script>
        $(document).ready(() => {
            // nice scroll js
            $("#client_table").niceScroll({
                cursorwidth: "8px",
                autohidemode: false,
                zindex: 999,
                cursorcolor: "#FF70DF",
                cursorborder: "none",
            });



        });


        function showPass(id) {
            var x = document.getElementById(id);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function activate() {
            var activations = $("#activations").val();

            if (activations == "activate_all") {
                
                Swal.fire({
                    title: 'Opppsss...!',
                    text: "Are you sure you want to activate all account?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Activate all!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var data = {
                            activate_all: 1,
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
                                    window.location.reload();
                                }
                            }
                        });
                    }
                })
            } else {
                Swal.fire({
                    title: 'Opppsss...!',
                    text: "Are you sure you want to deactivate all account?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, deactivate all!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var data = {
                            deactivate_all: 1,
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
                                    window.location.reload();
                                }
                            }
                        });
                    }
                })
            }

        }


        function status(status, user_id) {


            if (status == "activate") {
                Swal.fire({
                    title: 'Opppsss...!',
                    text: "Are you sure you want to activate this account?!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var data = {
                            user_id: user_id,
                            activate_btn: 1,
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
                                    window.location.reload();
                                }
                            }
                        });
                    }
                })


            } else {
                Swal.fire({
                    title: 'Opppsss...!',
                    text: "Are you sure you want to deactivate this account?!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var data = {
                            user_id: user_id,
                            deactivate_btn: 1,
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
                                    window.location.reload();
                                    // Swal.fire({
                                    //     position: 'top-center',
                                    //     icon: 'success',
                                    //     title: "Successfully Deactivated!",
                                    //     showConfirmButton: false,
                                    //     timer: 1000
                                    // });

                                    // setInterval(() => {

                                    // }, 1000)
                                }
                            }
                        });
                    }
                })


            }
        }

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
                delete_user_btn: "delete_user_btn",
            };

            Swal.fire({
                title: "Are you sure?",
                text: "You're about to move this user to archive",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes",
            }).then((result) => {

                if (result.isConfirmed) {
                    $.ajax({
                        url: "deleteData.php",
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
                                    title: "Successfully move user to archive",
                                    showConfirmButton: false,
                                    timer: 1000
                                });

                                setInterval(() => {
                                    window.location.reload()
                                }, 1000);
                            }
                        }
                    })
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

            var data = {
                id: id,
                view_user_btn: 1
            }
            $.ajax({
                url: "displayData.php",
                method: "post",
                data: data,
                success: (res, status) => {

                    var response = JSON.parse(res);

                    // // console.log(response);
                    if (status == "success") {

                        $("#user_id").val(response.user_id);
                        $("#display_name").val(response.display_name);
                        $("#password").val(response.password);
                        $("#contact").val(response.contact);
                        $("#date_added").val(response.date_added);
                        $("#date_modified").val(response.date_modified);
                        // var img = document.getElementById("docs").src = `uploads/` + `${response.img_path}`;
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
                    display_users: 1
                },
                success: (res) => {
                    $("#client_table").html(res);
                }
            });
        }
    </script>


</body>

</html>