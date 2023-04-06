<?php
session_start();
if (isset($_SESSION['role'])) {
    header("location:supAdminAccount.php");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "includes/header.php"; ?>
    <title>Home | Login to your Account</title>

    <!-- custom css -->
    <link rel="stylesheet" href="css/login.css?v=<?= time() ?>">

    <!-- not working on external css -->
    <style>
        body {
            background-color: #000B18;
        }
    </style>

</head>

<body>
    <?php
    if (isset($_GET['unautorized_access'])) {
    ?>
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <strong>Oppppp!</strong> <?= $_GET['unautorized_access'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    }

    ?>
    <div class="wrapper">
        <!-- NAVIGATIONS FOR LOGIN-->
        <div class="navigation-bar ">
            <div class="logo">
                <img src="./img/logo.svg" alt="">
            </div>
        </div>
        <!-- HERO DESIGN -->
        <section class="hero mt-5">
            <div class="hero-left">
                <div class="hero-title">
                    <h1>Welcome to <span id="title">Zignet Autoworks</span> please login to your account</h1>
                </div>

                <div class="form">
                    <form>
                        <!-- username -->
                        <div class="mb3">
                            <input type="text" name="username" id="username" placeholder="Enter Username" autocomplete="off">
                        </div>
                        <!-- password -->
                        <div class="mb3">
                            <input type="password" name="password" id="password" placeholder="Enter Password" autocomplete="off">
                        </div>

                        <button type="button"  onclick="login()">Login now!</button>
                    </form>
                </div>
            </div>

            <div class="hero-car">
            </div>
            
            <!-- Swiper -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="./img/scion.png" alt="Car"></div>
                    <div class="swiper-slide"><img src="./img/car1.png" alt="Car"></div>
                    <div class="swiper-slide"><img src="./img/car3.png" alt="Car"></div>
                    <div class="swiper-slide"><img src="./img/car4.png" alt="Car"></div>
                    <div class="swiper-slide"><img src="./img/car5.png" alt="Car"></div>
                </div>
                <!-- <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div> -->
            </div>

        </section>
    </div>

    <?php include "includes/script.php" ?>
    <script src="includes/app.js"></script>

    <script>
        // login part
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            // pagination: {
            //     el: ".swiper-pagination",
            //     clickable: true,
            // },
            // navigation: {
            //     nextEl: ".swiper-button-next",
            //     prevEl: ".swiper-button-prev",
            // },
        });


        function login() {
            let username = $("#username").val();
            let password = $("#password").val();

            let data = {
                username: username,
                password: password,
                loginBtn: 1
            }
            
            if (username != "" || password != "") {
                $.ajax({
                    url: "validate.php",
                    method: "POST",
                    data: data,

                    success: (res) => {
                        if (res == "login successfully") {
                            window.location.href = "supAdminDashboard.php";
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: res,
                            });
                        }
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "All fields are mandatory",
                });
            }

        }

    </script>
</body>

</html>