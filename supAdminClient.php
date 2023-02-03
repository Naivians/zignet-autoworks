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

                            <select class="form-select small-font" aria-label="Default select example">
                                <option selected disabled>Select Company</option>
                                <option value="1">Lexus</option>
                                <option value="2">BMW</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label text-secondary small-font">Upload Docs</label>
                            <input type="file" name="" id="img" class="form-control">
                        </div>

                        <div class="mt-4 mb-2">
                            <button class="btns fullwidth mb-2 small-font">Create</button>
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
</body>

</html>