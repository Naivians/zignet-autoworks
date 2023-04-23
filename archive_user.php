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

    <!-- main content -->
    <div class="wrapper" id="wrapper">
        <!-- import TopNavbar -->
        <a href="archives_dashboard.php" class=" mt-3 btn btn-success text-decoration-none">Back</a>

        <div class="adminTable d-flex justify-content-between align-items-center mt-4">
            <h5>Archive User Account</h5>
            <!-- live search -->
            <div class="filter d-flex align-items-center mt-3 mb-3">
                <div class="live-search">
                    <input type="text" id="search" placeholder="Search Anything" class="border-0 search">
                    <!-- <button class="btn btn-outline-light me-2" id="reset" onclick="reset()"><i class='bx bx-reset text-danger'></i></button> -->
                </div>
            </div>
        </div>

        <div class="displayAccount mt-4" id="adminTable">
            <!-- table for admin accounts -->
        </div>

    </div>

    <!-- import sidebar -->
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
                        archive_user: 1,
                        search: search
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
                    deleted_user: 1
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