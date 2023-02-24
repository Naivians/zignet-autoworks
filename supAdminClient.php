<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/header.php"; ?>
    <link rel="stylesheet" href="css/dashboard.css?v=<?= time(); ?>">


    <title>Admin | Client</title>
</head>

<body>

    <!-- Add new Client Modal -->
    <div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content modal-color modal-client">
                <div class="car">
                    <img src="img/car3.png" alt="cars">
                </div>

                <div class="shape">
                    <img src="img/Rectangle.png" alt="rectangle shape">
                </div>
                <h5 class="text-center text-light mt-2">Add New Client</h5>
                <form>
                    <div class="modal-body">
                        <!-- form here -->
                        <div class="mb-3">
                            <label for="" class="form-label gray small-font">Customer Name</label>
                            <input type="text" name="fname" id="customerName" placeholder="John Doe" class="form-control text-dark">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label text-light small-font">CS Number</label>
                            <input type="text" name="fname" id="csNumber" placeholder="SSEDRFF" class="form-control text-dark">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label text-light small-font">Car Model</label>
                            <input type="text" name="fname" id="model" placeholder="GDHBNFF" class="form-control text-dark">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label text-secondary small-font">Company Name</label>

                            <select class="form-select small-font" aria-label="Default select example" id="company">
                                <option selected disabled>Select Company</option>
                                <option value="1">Lexus</option>
                                <option value="2">BMW</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label text-secondary small-font">Upload Docs</label>
                            <input type="file" name="" id="docs" class="form-control">
                        </div>

                        <div class="mt-4 mb-2">
                            <button class="btns fullwidth mb-2 small-font" onclick="addCustomer()">Create</button>
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
                <h5 class="text-center text-light mt-2">Edit Customer Details</h5>
                <form>
                    <div class="modal-body">
                        <!-- form here -->
                        <div class="mb-3">
                            <label for="" class="form-label gray small-font">Customer Name</label>
                            <input type="text" name="fname" id="fname" placeholder="John Doe" class="form-control text-dark">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label text-light small-font">CS Number</label>
                            <input type="text" name="fname" id="fname" placeholder="SSEDRFF" class="form-control text-dark">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label text-light small-font">Car Model</label>
                            <input type="text" name="fname" id="fname" placeholder="GDHBNFF" class="form-control text-dark">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label text-secondary small-font">Company Name</label>
                            <input type="text" name="fname" id="fname" placeholder="Lexus" class="form-control text-dark">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label text-secondary small-font">Upload Docs</label>
                            <input type="file" name="" id="img" class="form-control">
                        </div>

                        <div class="mt-4 mb-2">
                            <button class="btns fullwidth mb-2 small-font">Update</button>
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

                <h5 class="text-center text-light mt-2">Customer Full Details</h5>

                <div class="docs" id="zoom-container">
                    <img src="forms/bmw.jpg">
                </div>

                <div class="modal-body">
                    <!-- form here -->
                    <div class="mb-2">
                        <label for="" class="form-label text-secondary small-font">Clients Name</label>
                        <input type="text" name="fname" id="fname" placeholder="John Doe" class="form-control text-dark" disabled>
                    </div>

                    <div class="mb-2">
                        <label for="" class="form-label text-secondary small-font">CS Number</label>
                        <input type="text" name="fname" id="fname" placeholder="SSEDRFF" class="form-control text-dark" disabled>
                    </div>

                    <div class="mb-2">
                        <label for="" class="form-label text-secondary small-font">Car Model</label>
                        <input type="text" name="fname" id="fname" placeholder="GDHBNFF" class="form-control text-dark" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label text-secondary small-font">Company Name</label>
                        <input type="text" name="fname" id="fname" placeholder="Lexus" class="form-control text-dark" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- main content -->
    <div class="wrapper" id="wrapper">
        <!-- import TopNavbar -->
        <?php include "includes/navBar.php"; ?>

        <div class="adminTable d-flex justify-content-between align-items-center mt-4">
            <h5>Customers Account</h5>
            <button data-bs-toggle="modal" data-bs-target="#adminModal" class="btns">Add New Client</button>
        </div>

        <!-- live search -->
        <div class="filter d-flex align-items-center mt-3 mb-3">

            <div class="live-search">
                <input type="search" name="search" id="search" placeholder="Try Something">
            </div>


            <!-- Example single danger button -->
            <div class="btn-group">
                <select name="" id="filter" class="filterBtn form-select" onchange="filterBy()">
                    <option disabled selected>Filter by</option>
                    <option value="client">Customer's Name</option>
                    <option value="csNumber">CS Number</option>
                    <option value="model">Model</option>
                    <option value="dateAdded">Date Added</option>
                    <option value="dateModified">Date Modified</option>
                </select>
            </div>

        </div>

        <div class="displayAccount mt-4" id="adminTable">
            <!-- table for admin accounts -->
            <table class="adminAcc-table">
                <thead>
                    <tr>
                        <th>Documents</th>
                        <th>Customer's Name</th>
                        <th>CS Nmber</th>
                        <th>Model</th>
                        <th>Company</th>
                        <th>Date Added</th>
                        <th>Date Modified</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>
                            <img src="img/car1.png" alt="cars" class="img">
                        </td>
                        <td>John Doe</td>
                        <td>SSHDE</td>
                        <td>HESST</td>
                        <td>Lexus</td>
                        <td>1/1/23</td>
                        <td></td>
                        <td>
                            <!-- three btns for view, edit, and delete -->
                            <!-- view -->
                            <button class="btn" data-bs-toggle="modal" data-bs-target="#viewModal">
                                <img src="icons/view.svg" alt="view image" class="text-success">
                            </button>

                            <!-- edit -->
                            <button class="btn" data-bs-toggle="modal" data-bs-target="#editModal">
                                <img src="icons/edit.svg" alt="view image" class="text-primary">
                            </button>

                            <!--  viewModal -->

                            <!-- delete -->
                            <button class="btn" onclick="askDelete()">
                                <img src="icons/delete.svg" alt="view image" class="text-danger">
                            </button>

                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <!-- import sidebar -->
    <?php include "includes/script.php" ?>
    <?php include "includes/sidebar.php"; ?>
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
                deletedAccBtn: "delete",
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

                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
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

    
        function addCustomer() {
            // e.preventDefault();
            var customerName = $("#customerName").val();
            var csNumber = $("#csNumber").val();
            var model = $("#model").val();
            var company = $("#company").val();
            var docs = $("#docs").val();

            var data = {
                customerName: $("#customerName").val(),
                csNumber: $("#csNumber").val(),
                company: $("#company").val(),
                model: $("#username").val(),
                docs: $("#docs").val(),
                addCustomerBtn: 1
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