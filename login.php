<?php
include "functions.php";
$retrieved = getData("admins");

$username = "";
$password = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // check if the input fields is empty

    if($username == ""){
       $usernameError = "border: 1px solid red;";
    }elseif($password == ""){
        $passwordError = "border: 1px solid red;";
    }else{
        //  to be continue
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "includes/header.php"; ?>
    <title>Home | Login to your Account</title>

    <!-- custom css -->
    <link rel="stylesheet" href="css/login.css?v=<?=time()?>">

    <!-- not working on external css -->
    <style>
        body {
            background-color: #000B18;
        }
    </style>

</head>

<body>
    <div class="wrapper">
        <!-- NAVIGATIONS FOR LOGIN-->
        <div class="navigation-bar">
            <div class="logo">
                <img src="./img/logo.svg" alt="">
            </div>
            <div class="navs">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
        </div>

        <!-- HERO DESIGN -->
        <section class="hero mt-5">
            <div class="hero-left">
                <div class="hero-title">
                    <h1>Welcome to <span id="title">Zignet Autoworks</span> please login to your account</h1>
                </div>
                <div class="form">
                    <form method="post" action="login.php">
                        <!-- username -->
                        <div class="mb3">
                            <input type="text" name="username" id="username" placeholder="Enter Username" autocomplete="off" style="<?=  $usernameError?>" 
                            value="<?php if(isset($username)){echo $username;}?>">
                        </div>
                        <!-- password -->
                        <div class="mb3">
                            <input type="password" name="password" id="password" placeholder="Enter Password" autocomplete="off" style="<?= $passwordError?>"  value="<?php if(isset($password)){echo $password;}?>">
                        </div>

                        <!-- buttons -->
                        <div class="mb3 mt-3">
                            <button type="submit" name="login">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span> Login
                            </button>
                        </div>
                        

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
    </script>
</body>

</html>