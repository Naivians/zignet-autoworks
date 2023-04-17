<!DOCTYPE html>
<html>

<head>
    <title>OTP Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">

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
        <h2>Enter your OTP</h2>
        <input type="text" id="otp" maxlength="6" oninput="checkInput()" />
        <p id="error"></p>
        <button id="submit" disabled>Submit</button>
    </div>
    <script>
        const otpInput = document.getElementById('otp');
        const submitButton = document.getElementById('submit');
        const errorText = document.getElementById('error');

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
            alert('OTP submitted successfully!');
        });

    </script>
</body>

</html>