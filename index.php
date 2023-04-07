<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/landing.css?<?=time();?>">
    <?php include "includes/header.php"; ?>
    <title>Zignet | Home</title>
    <style>
        body {
            background-color: #f3f3f3;
        }
    </style>
</head>

<body>
    <?php include "includes/landing_header.php"; ?>
    <main>
        <section id="home" class="home">
            <div class="swiper mySwiper">
                <div class="overlay">
                    <div class="content">
                        <h1 class="primary text-center">Zignet<span class="title"> Autoworks</span></h1>
                        <p class="primary text-center mt-2 mb-5">ZIGNET is a premier private car care and dealer services centre aiming to <br> provide the best and latest quality car care services in the country</p>
                        <a href="login.php" class="btn_login d-flex align-items-center justify-content-center">Book now! 
                        <i class='bx bx-right-arrow-alt fs-3'></i>
                        </a>
                    </div>
                </div>
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="./img/img1.jpg" alt="Car" class="img"></div>
                    <div class="swiper-slide"><img src="./img/img2.jpg" alt="Car" class="img"></div>
                    <div class="swiper-slide"><img src="./img/img3.jpg" alt="Car" class="img"></div>
                    <div class="swiper-slide"><img src="./img/img4.jpg" alt="Car" class="img"></div>
                    <div class="swiper-slide"><img src="./img/img5.jpeg" alt="Car" class="img"></div>
                </div>
            </div>
        </section>
    </main>
    <!-- Swiper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <?php include "includes/script.php" ?>

    <script>
        // login part
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });
    </script>
</body>

</html>