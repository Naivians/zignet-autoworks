<?php session_start(); 

if(!isset($_SESSION['user_id'])){
    header("location:login.php");
}


?>

<!DOCTYPE html>
<html>

<head>
    <?php include "includes/header.php" ?>
    <title>OTP Page</title>

    <style>
        .container {
            max-width: 400px;
            margin: 0 auto;
            text-align: center;
        }

        h2 {
            font-size: 36px;
            margin-top: 50px;
        }

        input {
            font-size: 24px;
            padding: 10px;
            margin-top: 20px;
            width: 100%;
            border: 2px solid #ccc;
            border-radius: 5px;
        }

        button {
            font-size: 24px;
            padding: 10px 30px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        #error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <p id="timer" class="fs-1 text-danger mt-5"></p>
        <h2 id="title">Enter your OTP</h2>

        <input type="text" id="otp" maxlength="6" oninput="checkInput()" class="text-center"/>
        <p id="error"></p>
        <input type="hidden" name="" id="user_id" value="<?php if (isset($_SESSION['user_id'])) {
                                                                echo $_SESSION['user_id'];
                                                            } ?>">

        <input type="hidden" name="" id="contact" value="<?php if (isset($_SESSION['contact'])) {
                                                                echo $_SESSION['contact'];
                                                            } ?>">

        <!--  $_SESSION['contact'] -->
        <button id="submit" disabled>Submit</button>
        <button id="resend" disabled>Resend Code</button>
    </div>

    <?php include "includes/script.php" ?>
    <script>
        // localStorage.setItem("timer", 5);
        var timer = document.getElementById('timer');
        const otpInput = document.getElementById('otp');
        const submitButton = document.getElementById('submit');
        const errorText = document.getElementById('error');
        const resend = document.getElementById('resend');
        const title = document.getElementById('title');
        var count = Number(localStorage.getItem("timer"));

        let timerId = setInterval(function() {
            timer.innerHTML = count--;
            if (count <= -1) {
                clearInterval(timerId);
                // otp session has been expired!
                localStorage.removeItem("timer");
                timer.innerHTML = "Your OTP has expired!";
                // pop up a resend code
                submitButton.style.display = "none";
                errorText.style.display = "none";
                otpInput.style.display = "none";
                title.style.display = "none";
                resend.disabled = false;
                // reset OTP to 0

                resend.addEventListener("click", () => {
                    submitButton.style.display = "block";
                    errorText.style.display = "block";
                    otpInput.style.display = "block";
                    title.style.display = "block";

                    $.ajax({
                        url: "updateData.php",
                        method: "POST",
                        data: {
                            user_id: $("#user_id").val(),
                            contact: $("#contact").val(),
                            reset_otp_btn: 1
                        },
                        success: (res) => {
                            if (res == "success") {
                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'success',
                                    title: 'A new OTP has been sent to your phone',
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                                setInterval(() => {
                                    localStorage.removeItem("timer");
                                    localStorage.setItem("timer", 60);
                                    window.location.reload()
                                }, 1500);

                            } else if (res == "attempt") {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: "Too many attemps! Please create another account!",
                                })

                                submitButton.style.display = "none";
                                errorText.style.display = "none";
                                otpInput.style.display = "none";
                                title.style.display = "none";
                                resend.style.display = "none";

                                setInterval(() => {
                                    window.location.href = "login.php";
                                }, 4000);

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: res,
                                })
                            }
                        }
                    });
                })


            }
        }, 1000);

        function checkInput() {
            if (otpInput.value.length === 6) {
                submitButton.disabled = false;
                errorText.innerHTML = '';
            } else {
                submitButton.disabled = true;
                errorText.innerHTML = 'Please enter a valid OTP';
            }
        }
        
        submitButton.addEventListener('click', function() {
            var user_id = $("#user_id").val()
            submitButton.disabled = true;
            $.ajax({
                url: "updateData.php",
                method: "POST",
                data: {
                    user_id: user_id,
                    otp: otpInput.value,
                    verify_btn: 1
                },
                success: (res) => {
                    if (res != "verified") {
                        errorText.innerHTML = res;
                    } else {
                        window.location.href = "verified.php";
                    }
                }
            });

        });

    </script>
</body>

</html>