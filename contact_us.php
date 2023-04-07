<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/landing.css?<?= time(); ?>">
    <?php include "includes/header.php"; ?>
    <title>Zignet | Contact us</title>
</head>

<body>
    <?php include "includes/landing_header.php"; ?>
    <main>
        <div class="wrapper">
            <h1 class="text-center mt-5 dark-blue about mb-3">GET IN TOUCH!</h1>
            <div class="row d-flex align-items-center justify-content-center contact">
                <div class="col-md-6">
                    <div class="map">
                        <img src="img/map.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-6 contact-content">
                    <ul>
                        <li>
                            <i class='bx bxl-facebook-circle text-primary fs-1'></i>Nelson Tint
                        </li>
                        <li> <i class='bx bxs-phone-call fs-1 text-danger'></i>09178998468 (GLOBE)</li>
                        <li> <i class='bx bxs-phone-call fs-1 text-danger'></i>09088818468 (SMART)</li>
                        <li> <i class='bx bxs-phone-call fs-1 text-danger'></i>0287228339 (OFFICE LANDLINE)</li>
                    </ul>

                </div>
            </div>
        </div>
    </main>
    <!-- Swiper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <?php include "includes/script.php" ?>

</body>

</html>