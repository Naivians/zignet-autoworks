<?php

session_start();

if (!isset($_SESSION['reset_password'])) {
    header("location:login.php");
}

?>
<!DOCTYPE html>
<html>

<head>
    <?php include "includes/header.php" ?>
    <title>Forgot Password OTP</title>

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type='number'] {
            -moz-appearance: textfield;
        }

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
        <h2 id="title">Enter your reset password OTP</h2>

        <input type="number" id="otp" class="text-center" />
        <p id="error"></p>

        <!--  $_SESSION['contact'] -->
        <button id="submit" disabled>Submit</button>
        <button id="resend" disabled>Resend Code</button>
    </div>

    <?php include "includes/script.php" ?>
    <script>
        var timer = document.getElementById('timer');
        const otpInput = document.getElementById('otp');
        const submitButton = document.getElementById('submit');
        const errorText = document.getElementById('error');
        const resend = document.getElementById('resend');
        const title = document.getElementById('title');
        var count = Number(localStorage.getItem("timer"));

        otpInput.addEventListener('input', () => {
            const value = otpInput.value.replace(/\D/g, ''); // Remove non-digit characters

            if (value.length > 6) {
                otpInput.value = value.slice(0, 6);
            }
        });

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

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Please Another request",
                })

                submitButton.style.display = "none";
                errorText.style.display = "none";
                otpInput.style.display = "none";
                title.style.display = "none";
                resend.style.display = "none";

                setInterval(() => {
                    window.location.href = "login.php";
                }, 4000);

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
            var reset_otp = $("#otp").val()

            $.ajax({
                url: "updateData.php",
                method: "POST",
                data: {
                    reset_otp: reset_otp,
                    reset_pass_btn: 1,
                },
                success: (res) => {
                    if (res != "verified") {
                        errorText.innerHTML = res;
                    } else {
                        // redirect to change pass
                        window.location.href = "reset_password.php";
                    }
                }
            });

        });
    </script>
</body>

</html>