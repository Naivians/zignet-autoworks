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
                            <input type="date" name="" id="schedule" class="form-control" value="111111">
                        </div>
                    </div>
                </div>
                <div class="modal-footer mt-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-outline-success" onclick="retrieved()">
                        Retrieved
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- main content -->
    <div class="wrapper" id="wrapper">
        <!-- import TopNavbar -->
        <a href="archives_dashboard.php" class=" mt-3 btn btn-success text-decoration-none">Back</a>

        <div class="adminTable d-flex justify-content-between align-items-center mt-4">
            <h5>Archive Request Form</h5>
            <!-- live search -->
            <div class="filter d-flex align-items-center mt-3 mb-3">
                <div class="live-search">
                    <input type="search" id="search" placeholder="Search by name">
                </div>
            </div>
        </div>

        <div class="displayAccount mt-3" id="adminTable">
            <!-- table for admin accounts -->
        </div>

    </div>

    <!-- import sidebar -->
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
                        btn: "deletedSearch",
                        table: "deleted_admin_account"
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

        function view_description(id) {
            $("#view_request_modal").modal("show");
            $.ajax({
                url: "displayData.php",
                method: "POST",
                data: {
                    view_deleted_request: 1,
                    id: id
                },
                success: (res) => {
                    var response = JSON.parse(res);

                    // console.log(response);

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


        function askDelete(id) {

            var data = {
                id: id,
                delete_client_btn: "delete_user_forever",
                action: 1,
                table: "deleted_user"
            };


            Swal.fire({
                title: "Are you sure?",
                text: "You're about to delete this account permanently",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ff3333",
                cancelButtonColor: "#2f2d2d",
                confirmButtonText: "Yes, Delete Forever!",
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
                                    title: 'Successfully Deleted User',
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                                setInterval(() => {
                                    window.location.reload()
                                }, 1500);
                            }
                        }
                    });
                }

            });
        }

        function displayAccounts() {
            $.ajax({
                url: "displayData.php",
                method: "POST",
                data: {
                    archive_request: 1
                },
                success: (res) => {
                    $("#adminTable").html(res);
                }
            });
        }

        function retrieved(retrievedID) {
            // alert(retrievedID)
            // go to insert and retrieved this account by the id 
            var data = {
                id: retrievedID,
                retrievedBtn: 1
            };

            Swal.fire({
                title: "Are you sure?",
                text: "You're about to recover this account",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#2f2d2d",
                confirmButtonText: "Yes, I want to recover",
            }).then((result) => {

                if (result.isConfirmed) {
                    $.ajax({
                        url: "insertData.php",
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
                                    title: 'Successfully Retrieved User',
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                                setInterval(() => {
                                    window.location.reload()
                                }, 1500);
                            }
                        }
                    });
                }

            });
        }
    </script>


</body>


</html>