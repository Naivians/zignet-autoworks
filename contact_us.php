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
                    
                    <a href="https://www.google.com/maps/place/Hapay+Na+Mangga+Elementary+School/@14.5695928,121.1596469,17z/data=!3m1!4b1!4m6!3m5!1s0x3397c74f236747d3:0x5aa9d1a7413249ef!8m2!3d14.5695876!4d121.1618356!16s%2Fg%2F11bzvzfpd3">
                        <div class="map">
                            <img src="img/map.jpg" alt="">
                        </div>
                    </a>
                    <p class="text-center mt-2 mb-2">click the image to see the map</p>
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