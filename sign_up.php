<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/header.php"; ?>
    <title>Home | Sign up</title>

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


        @media only screen and (max-width: 850px) {
            .swiper {
                display: none;
            }

            .hero-title h1 {
                text-align: center;
            }


            .hero-left {
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
            }
            
        }


        /* @media only screen and (min-width: 320px) {
            .swiper {
                display: none;
            }

            .hero-title h1 {
                text-align: center;
            }

            .hero-left {
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
            }

        } */
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
        <section class="hero">
            <div class="hero-left">
                <div class="hero-title">
                    <h1>Welcome to <span id="title">Zignet Autoworks</span> Create your account here</h1>
                </div>

                <div class="form">
                    <form>
                        <!-- display name -->
                        <div class="">
                            <input type="text" name="display_name" id="display_name" placeholder="Enter Full Name" autocomplete="off" required>
                        </div>

                        <div class="">
                            <input name="contact" id="contact" placeholder="Enter Contact" autocomplete="off" required type="number">
                        </div>

                        <!-- username -->
                        <div class="">
                            <input type="text" name="username" id="username" placeholder="Enter Username" autocomplete="off" required>
                        </div>
                        <!-- password -->
                        <div class="mb-3">
                            <input type="password" name="password" id="password" placeholder="Enter Password" autocomplete="off" required>
                            <div class="d-flex align-items-center">
                                <span class="me-3 text-light" style="font-size: 12px;">Show Password</span>
                                <input type="checkbox" onclick="showPass()">
                            </div>
                        </div>

                        <button type="button" id="submit" style="width: 100%;">Create Account</button>
                        <!-- onclick="sign_up()" -->
                    </form>
                </div>

                <p class="text-light mt-4">Already have account? <a href="login.php" class="">Sign-in Here!</a></p>
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
        $("body").niceScroll({
            cursorwidth: "8px",
            autohidemode: true,
            zindex: 999,
            cursorcolor: "#FF70DF",
            cursorborder: "none",
            horizrailenabled: false,
        });

        function showPass() {
            var x = document.getElementById('password');
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        // login part
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
        });

        let btn = document.getElementById('submit');

        // when the btn is clicked print info in console 
        btn.addEventListener('click', (ev) => {
            sign_up();
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


        function sign_up() {

            var pattern = new RegExp("^1?([1-9])(\\d{11})");

            let username = $("#username").val();
            let password = $("#password").val();
            let display_name = $("#display_name").val();
            let contact = $("#contact").val();
            // contact

            let data = {
                username: username,
                contact: contact,
                password: password,
                display_name: display_name,
                register_btn: 1
            }

            if (username == "" || password == "" || display_name == "" || contact == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "All fields are mandatory",
                });

                reset();

            } else if (username.length <= 6) {
                alert("username must be atleast 6 characters long")
                $("#username").val('');
            } else if (password.length < 6) {
                alert("password must be atleast 8 characters long")
                $("#password").val('');
            } else if (pattern.test(contact)) {
                alert("Invalid Contact Number")
            } else {

                $.ajax({
                    url: "validate.php",
                    method: "POST",
                    data: data,

                    success: (res) => {
                        if (res == "Registered") {
                            // window.location.href = "supAdminDashboard.php";
                            // Swal.fire(
                            //     'Successfully Created Account!',
                            //     'Please wait for the admin to activate your account',
                            //     'success'
                            // )
                            window.location.reload();
                            window.location.href = "OTP.php";
                            localStorage.setItem("timer", 60);
                            // alert("success")
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: res,
                            });
                            $("#username").val('');
                        }
                    }
                });

                // if(contact.length != 11){
                //     alert("Invalid Contact Number")
                // }else{
                //     alert("Pass all")
                // }


            }


        }

        function reset() {
            $("#username").val('');
            $("#password").val('');
            $("#display_name").val('');
            $("#contact").val('');
        }
    </script>
</body>

</html>