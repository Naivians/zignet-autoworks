<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/landing.css">
    <?php include "includes/header.php"; ?>
    <title>Zignet | About us</title>
</head>

<body>
    <?php include "includes/landing_header.php"; ?>
    <main>
        <div class="wrapper">
            <h1 class="text-center mt-3 dark-blue about">ABOUT US</h1>
            <!-- about us content-->
            <div class="row">
                <div class="about-img col-md-6">
                    <img src="img/about_us_img.jpg" alt="zignet picture">
                </div>
                <div class="about-content col-md-6 " id="about_content">
                    <h2 class="dark-blue mb-3 text-center" id="about_sub_title">ZIGNET AUTOWORKS</h2>
                    <p class="text-secondary">
                        ZIGNET is a premier private car care and dealer services centre aiming to provide the best and latest quality car care services in the country. Recently established in June 6, 2008 it is already servicing top quality conscious private and institutional clients such as BMW (RSA Motors Corp.), Lexus Manila Inc., Aston Martin, PGA Cars, Autostrada Inc. (Ferrari, Jaguar, Land Rover Maserati) and others for their factory Window tint installation and showroom detailing for their new and pre-owned vehicles. The company’s aim is to protect and maintain vehicle’s sale value and experience the feel of a new car owner. A range of specialized services allows for one stop express shop for most car care needs. Additional services include home and business window tint and security film installation borne from the more complex installation techniques required for the vehicles.
                    </p>
                </div>
            </div>
        </div>

        <section class="sponsor">
            <div class="wrapper">
                <h2 class="text-center dark-blue mb-5">Sponsored by:</h2>
                <div class="sponsor-content">
                    <div class="row d-flex align-items-center justify-content-between">
                        <div class="col-md-3">
                            <img src="img/Lexus-Logo.png" alt="">
                        </div>
                        <div class="col-md-3">
                            <img src="img/bwm.png" alt="">
                        </div>
                        <div class="col-md-3">
                            <img src="img/3m.png" alt="">
                        </div>
                        <div class="col-md-3">
                            <img src="img/V-KOOL-Logo-bk.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Swiper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <?php include "includes/script.php" ?>
    <script src="main.js"></script>

    <script>
        $("body").niceScroll({
            cursorwidth: "8px",
            autohidemode: true,
            zindex: 999,
            cursorcolor: "#FF70DF",
            cursorborder: "none",
            horizrailenabled: false,
        });
    </script>
</body>

</html>