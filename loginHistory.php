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
        <?php include "includes/navBar.php"; ?>

        <div class="adminTable d-flex justify-content-between align-items-center mt-4">
            <h5>Login History</h5>
            <div class="live-search">
                <input type="search" id="search" placeholder="Try Something">
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
                        action:1,
                        btn:"loginSearch" ,
                        table:"login_history"
                    }
                    
                    $.ajax({
                        url: "displayData.php",
                        method: "POST",
                        data: data,
                        success: (res, status) => {
                            $("#adminTable").html(res);
                            // console.log(res);
                        }
                    });
                } else {
                    displayAccounts();
                }

            });
        });


        function displayAccounts() {
            $.ajax({
                url: "displayData.php",
                method: "post",
                data: {
                    loginHistoryBtn: 1
                },
                success: (res) => {
                    $("#adminTable").html(res);
                }
            });
        }

    </script>


</body>


</html>