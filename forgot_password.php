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
        <h2 id="title">Enter your username</h2>

        <input type="text" id="username" oninput="checkInput()" class="text-center" autocomplete="off" />
        <p id="error"></p>

        <!--  $_SESSION['contact'] -->
        <button id="submit" disabled>Submit</button>
    </div>

    <?php include "includes/script.php" ?>
    <script>
        localStorage.removeItem("timer");


        const username = document.getElementById('username');
        const submitButton = document.getElementById('submit');
        const errorText = document.getElementById('error');
        const resend = document.getElementById('resend');
        const title = document.getElementById('title');
        var count = Number(localStorage.getItem("timer"));


        function checkInput() {
            if (username.value.length > 3) {
                submitButton.disabled = false;
            } else {
                submitButton.disabled = true;
                // errorText.innerHTML = 'Invalid Username';
            }
        }

        submitButton.addEventListener('click', function() {

            $.ajax({
                url: "displayData.php",
                method: "POST",
                data: {
                    check_reset_username: 1,
                    username: username.value,
                },
                success: (res) => {

                    console.log(res);
                    if (res == "success") {
                        localStorage.setItem("timer", 60);
                        window.location.href = "forgot_otp.php";
                    } 
                    else if (res == "attempts") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: "You too many attemps, you will be redirected to login page",
                        })

                        username.style.display = "none";
                        submitButton.style.display = "none";
                        errorText.style.display = "none";
                        title.style.display = "none";
                        
                        setInterval(() => {
                            window.location.href = 'login.php';
                        }, 4000);

                    } else {
                        errorText.innerHTML = 'Please enter a valid username';
                        username.value = '';
                    }
                }
            });

        });
    </script>
</body>

</html>