<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/header.php"; ?>
    <link rel="stylesheet" href="css/dashboard.css?v=<?= time(); ?>">
    <title>Home | Welcome Admin</title>
</head>

<body>

    <!-- Add new admin Modal -->
    <div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create new admin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <!-- form here -->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- main content -->
    <div class="wrapper" id="wrapper">
        <!-- import TopNavbar -->
        <?php include "includes/navBar.php"; ?>

    </div>
    <!-- import sidebar -->
    <?php include "includes/sidebar.php"; ?>

    <?php include "includes/script.php" ?>

    <script>
        
        function navBar() {
            var menuBar = document.getElementById("wrapper");
            menuBar.classList.toggle("move-to-right");
            
            var side = document.getElementById("sidebar");
            side.classList.toggle("move-to-right");

            // sidebar
        }
    </script>
</body>

</html>