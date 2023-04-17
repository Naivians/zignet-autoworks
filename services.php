<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/landing.css?<?= time(); ?>">
    <?php include "includes/header.php"; ?>
    <title>Zignet | About us</title>
</head>

<body>
    <?php include "includes/landing_header.php"; ?>
    <main>
        <div class="wrapper">
            <h1 class="text-center mt-5 dark-blue about mb-5">HOME SERVICES OFFERED</h1>

            <div class="service_main_container">

                <div class="service-container">
                    <img src="img/PAINT PROTECTION FILM.jpg" class="top" alt="...">
                    <div class="service-content">
                        <h2 class="tetx-dark">PAINT PROTECTION FILM</h2>
                        <p class="text-secoondary">Film protected from scratches and debris of car’s paint.</p>
                    </div>
                </div>

                <div class="service-container big">
                    <img src="img/GLASS TINTING.jpg">
                    <div class="service-content">
                        <h2 class="tetx-dark">GLASS TINTING</h2>
                        <p>Film protected from scratches and debris of car’s paint.</p>
                    </div>
                </div>

                <div class="service-container">
                    <img src="img/SECURITY FILM.jpg"  alt="...">
                    <div class="service-content">
                        <h2 class="tetx-dark">SECURITY FILM</h2>
                        <p>Car and Home/Business installation of non-fading film that protects interior from heat and visibility.</p>
                    </div>
                </div>
            </div>
            <section class="sponsor mt-5">
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

</body>

</html>