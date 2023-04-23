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

    <!-- update status modal -->
    <div class="modal fade" id="update_status" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Request Status</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mb-3">
                    <label for="" class="form-label">Change Status</label>
                    <select name="" id="status" class="form-select">
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="disapproved">Disapproved</option>
                    </select>
                    <input type="hidden" name="" id="status_id">
                    <input type="hidden" name="" id="contact">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning text-secondary" onclick="update_status()">Updated Status</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Disapproval message-->
    <div class="modal fade" id="reason" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Disapproval Message</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mb-3">
                    <textarea name="" id="reasons" cols="30" rows="10" class="form-control">Hello, Your request has been disapproved due to a schedule conflict. Please contact us at <Contact #> for a reschedule. Thank you - Zignet Autowork."</textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning text-light d-flex align-items-center justify-content-center" onclick="disapproval()">Send<i class='bx bx-send'></i></button>
                </div>
            </div>
        </div>
    </div>


    <!-- view request-->
    <div class="modal fade" id="view_request_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Description of Service(s)</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <h6><strong> Address </strong></h6>
                            <textarea name="" id="address" cols="10" rows="5" class="form-control"></textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                            <h6><strong> Description of Service </strong></h6>
                            <textarea name="" id="description" cols="10" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <h6><strong> Reschedule </strong></h6>
                            <input type="date" name="" id="schedule" class="form-control">
                        </div>
                    </div>
                    <input type="hidden" name="" id="update_request_id">
                </div>
                <div class="modal-footer mt-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="update_requests()">Update</button>
                </div>
            </div>
        </div>
    </div>


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
                <input type="text" id="search" placeholder="Search Anything" class="border-0 search">
                <!-- <button class="btn btn-outline-light me-2" id="reset" onclick="reset()"><i class='bx bx-reset text-danger'></i></button> -->
            </div>

            <!-- Example single danger button -->
            <div class="btn-group">
                <select name="" id="columnName" class="filterBtn form-select" onchange="sortBY()">
                    <option disabled selected>Sort by</option>
                    <option value="date_added">Date Created</option>
                    <option value="user_id">User ID</option>
                    <option value="request_id">Request ID</option>
                    <option value="display_name">Display Name</option>
                    <option value="address">Address</option>
                    <option value="schedule">Schedule</option>
                    <option value="request_status">Status</option>
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


    <script>
        $("#adminTable").niceScroll({
            cursorwidth: "8px",
            autohidemode: true,
            zindex: 999,
            cursorcolor: "#FF70DF",
            cursorborder: "none",
            horizrailenabled: false,
        });

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

        function update_requests() {
            var update_request_id = $("#update_request_id").val()
            var address = $("#address").val()
            var description = $("#description").val();
            var schedule = $("#schedule").val();


            if (address == "" || description == "" || schedule == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'All fields is mandatory',
                });
            } else {

                var data = {
                    address: $("#address").val(),
                    description: $("#description").val(),
                    schedule: $("#schedule").val(),
                    id: $("#update_request_id").val(),
                    update_request_btn: 1
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
                            $("#view_request_modal").modal("hide");
                            displayAccounts();
                        }
                    }
                });


            }
        }



        function open_status_modal(status_id, contact) {
            $("#status_id").val(status_id);
            $("#contact").val(contact);
            $("#update_status").modal("show");
        }

        function disapproval() {
            var status_id = $("#status_id").val();
            var status = $("#status").val();
            var message = $("#reasons").val();
            var contact = $("#contact").val();


            if (message != '') {

                var data = {
                    status_id: status_id,
                    status: status,
                    message: message,
                    contact: contact,
                    disapproved_btn: 1
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
                            })
                        } else {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'Message sent!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#reason").modal("hide");
                            displayAccounts();
                        }
                    }
                });

            } else {
                alert("Message box is empty")
            }
        }

        function update_status() {
            var status_id = $("#status_id").val();
            var status = $("#status").val();
            var contact = $("#contact").val();


            if (status == "disapproved") {
                $("#update_status").modal("hide");
                $("#reason").modal("show");
            } else {
                // process data
                var data = {
                    status_id: status_id,
                    status: status,
                    contact: contact,
                    update_status_btn: 1
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
                            })
                        } else {
                            $("#update_status").modal("hide");
                            displayAccounts();
                        }
                    }
                });
            }


        }

        function view_description(id) {
            $("#update_request_id").val(id)
            $("#view_request_modal").modal("show");
            $.ajax({
                url: "displayData.php",
                method: "POST",
                data: {
                    display_request: 1,
                    id: id
                },
                success: (res) => {
                    var response = JSON.parse(res);

                    var service = response.description_of_service;
                    var add = response.address;

                    var doc1 = service.replace(/(<br ?\/?>)*/g, "");
                    var doc2 = add.replace(/(<br ?\/?>)*/g, "");

                    document.getElementById("description").innerHTML = doc1;
                    document.getElementById("address").innerHTML = doc2;
                    document.getElementById("schedule").value = response.schedule;

                }
            });
        }

        function sortBY() {
            let columnName = $("#columnName").val();

            $.ajax({
                url: "displayData.php",
                method: "POST",
                data: {
                    request_sort_btn: 1,
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
                archive_request_btn: 1
            };

            Swal.fire({
                title: "Are you sure?",
                text: "You're about to archive this request",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes",
            }).then((result) => {


                if (result.isConfirmed) {

                    $.ajax({
                        url: "deleteData.php",
                        method: "post",
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
                                    title: 'Successfully archive request!',
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                                displayAccounts();
                            }
                        }
                    });
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
    </script>


</body>


</html>