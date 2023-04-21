<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("location:login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Verified Account</title>
  <style>
    /* Center the content vertically and horizontally */
    html,
    body {
      height: 100%;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    /* Style the container */
    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      max-width: 600px;
      width: 90%;
      padding: 50px;
      background-color: #f2f2f2;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    /* Style the text and button */
    h1 {
      font-size: 2.5rem;
      margin-bottom: 30px;
    }

    button {
      padding: 10px 20px;
      font-size: 1.2rem;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: all 0.2s ease-in-out;
    }

    button:hover {
      background-color: #0069d9;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Your account has been verified</h1>
    <button id="login-btn">Login to your account</button>
  </div>

  <script>
    // Add event listener to the button
    const loginBtn = document.getElementById('login-btn');
    loginBtn.addEventListener('click', () => {
      // Redirect the user to the login page
      window.location.href = 'login.php';
    });
  </script>
</body>

</html>