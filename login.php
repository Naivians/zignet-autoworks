<?php
session_start();

if (isset($_SESSION['user_role'])) {
    header("location:user_view.php");
}

if (isset($_SESSION['admin_role'])) {
    header("location:user_view.php");
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

        .home_btn {
            text-decoration: none;
            color: var(--primary-);
            background-color: #dc3545;
            padding: 5px 15px;
            border-radius: 40px;
            transition: 0.3s ease-in;
        }

        .home_btn:hover {
            background-color: #dc3521;
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
                <a href="index.php" class="text-decoration-none">
                    <img src="./img/logo.svg" alt="">
                </a>
            </div>
            <a href="index.php" class="text-decoration-none text-light home_btn">Home</a>
        </div>
        <!-- HERO DESIGN -->
        <?php
        if (isset($_SESSION['msg'])) {
            $msg = $_SESSION['msg'];
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Yeheyyyyyy!</strong><?=$msg?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            unset($_SESSION['msg']);
        }
        ?>
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
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex align-items-center">
                                    <span class="me-3 text-light" style="font-size: 12px;">Show Password</span>
                                    <input type="checkbox" onclick="showPass()">
                                </div>
                                <span><a href="forgot_password.php" style="font-size: 12px;">Forgot Password</a></span>
                            </div>

                            <button type="button" id="submit" class="mt-3" style="width: 100%;">Sign-in now!</button>
                        </div>

                    </form>
                </div>

                <p class="text-light mt-4">Don't have account? <a href="sign_up.php" class="">Sign-up Here!</a></p>
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
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script src="includes/app.js"></script>

    <script>
        var x = document.getElementById('password');

        function showPass() {
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

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

        let btn = document.getElementById('submit');

        // when the btn is clicked print info in console 
        btn.addEventListener('click', (ev) => {
            login();
        });

        document.addEventListener('keypress', (event) => {

            // event.keyCode or event.which  property will have the code of the pressed key
            let keyCode = event.keyCode ? event.keyCode : event.which;

            // 13 points the enter key
            if (keyCode === 13) {
                // call click function of the buttonn 
                btn.click();
            }

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

                        if (res == "user") {
                            window.location.href = "user_view.php";
                        } else if (res == "admin") {
                            // window.location.reload();
                            window.location.href = "supAdminDashboard.php";
                        } else {
                            if (res == "wrong password") {

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: res,
                                });

                                $("#password").css("border", "1px solid red");
                                $("#username").css("border", "none");
                            } else if (res == "You're account is not yet activated by the admin.") {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: "Please wait for some time, You're account is not yet activated by the admin.",
                                    footer: '<a href="contact_us.php">Contact them here!</a>'
                                });
                                reset();
                            } else {

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: res,
                                });

                                $("#password").css("border", "1px solid red");
                                $("#username").css("border", "1px solid red");

                                reset();
                            }
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