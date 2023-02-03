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
                    <img src="forms/bmw.jpg">
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
                    <option value="client">Client's Name</option>
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
                        <th>Client's Name</th>
                        <th>CS Nmber</th>
                        <th>Model</th>
                        <th>Company</th>
                        <th>Payment Status</th>
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
                        <td><span class="badge text-bg-success">Paid</span></td>
                        <td>1/1/23</td>
                        <td></td>
                        <td>

                            <!-- three btns for view, edit, and delete -->

                            <!-- view -->
                            <button class="btn" data-bs-toggle="modal" data-bs-target="#viewModal">
                                <img src="icons/view.svg" alt="view image" class="text-success">
                            </button>

                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <!-- import sidebar -->
    <?php include "includes/sidebar.php"; ?>
    <?php include "includes/script.php" ?>

    <script src="includes/app.js"></script>

</body>

</html>