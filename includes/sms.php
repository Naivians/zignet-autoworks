<?php


include "auth.php";




// $code = rand(100000, 900000);

// for ($i = 1; $i <= 6; $i++) {
//   $code .= rand(1, 9);
// }


// activated of accounts
function activate_account($number)
{
  $ch = curl_init();

  $parameters = array(
    'apikey' => AUTH,
    'number' => $number,
    'message' => "Your profile is now active. Log in to access our website.-Zignet",
    'sendername' => 'SEMAPHORE'
  );

  curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
  curl_setopt($ch, CURLOPT_POST, 1);

  //Send the parameters set above with the request
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));

  // Receive response from server
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $output = curl_exec($ch);
  curl_close($ch);

  // // Show the server response
  // echo $output;
}


// deactivate
function deactivate_account($number)
{
  $ch = curl_init();

  $code = rand(100000, 900000);


  for ($i = 1; $i <= 6; $i++) {
    $code .= rand(1, 9);
  }

  $parameters = array(
    'apikey' => AUTH,
    'number' => $number,
    'message' => "Your profile is deactivated due to inactivity.-Zignet",
    'sendername' => 'SEMAPHORE'
  );

  curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
  curl_setopt($ch, CURLOPT_POST, 1);

  //Send the parameters set above with the request
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));

  // Receive response from server
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $output = curl_exec($ch);
  curl_close($ch);

  // // Show the server response
  // echo $output;
}


function disapproved_request($number, $message)
{
  $ch = curl_init();

  $code = rand(100000, 900000);

  for ($i = 1; $i <= 6; $i++) {
    $code .= rand(1, 9);
  }


  $parameters = array(
    'apikey' => AUTH,
    'number' => $number,
    'message' => $message,
    'sendername' => 'SEMAPHORE'
  );

  curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
  curl_setopt($ch, CURLOPT_POST, 1);

  //Send the parameters set above with the request
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));

  // Receive response from server
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $output = curl_exec($ch);
  curl_close($ch);

  // // Show the server response
  // echo $output;
}

// Good news! Your request has been approved.

function approved_request($number)
{
  $ch = curl_init();

  $code = rand(100000, 900000);

  for ($i = 1; $i <= 6; $i++) {
    $code .= rand(1, 9);
  }

  $parameters = array(
    'apikey' => AUTH,
    'number' => $number,
    'message' => 'Good news! Your request has been approved.-Zignet Autoworks',
    'sendername' => 'SEMAPHORE'
  );

  curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
  curl_setopt($ch, CURLOPT_POST, 1);

  //Send the parameters set above with the request
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));

  // Receive response from server
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $output = curl_exec($ch);
  curl_close($ch);

  // // Show the server response
  // echo $output;
}

function send_otp($number, $otp)
{
  $ch = curl_init();

  $code = rand(100000, 900000);

  for ($i = 1; $i <= 6; $i++) {
    $code .= rand(1, 9);
  }

  $parameters = array(
    'apikey' => AUTH,
    'number' => $number,
    'message' => 'Your One Time Password is ' . $otp . ' ',
    'sendername' => 'SEMAPHORE'
  );

  curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
  curl_setopt($ch, CURLOPT_POST, 1);

  //Send the parameters set above with the request
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));

  // Receive response from server
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $output = curl_exec($ch);
  curl_close($ch);

  // // Show the server response
  // echo $output;
}


function reset_password_otp($number, $otp)
{
  $ch = curl_init();

  $code = rand(100000, 900000);

  for ($i = 1; $i <= 6; $i++) {
    $code .= rand(1, 9);
  }

  $parameters = array(
    'apikey' => AUTH,
    'number' => $number,
    'message' => 'Your reset password OTP is ' . $otp . ' ',
    'sendername' => 'SEMAPHORE'
  );

  curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
  curl_setopt($ch, CURLOPT_POST, 1);

  //Send the parameters set above with the request
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));

  // Receive response from server
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $output = curl_exec($ch);
  curl_close($ch);

  // // Show the server response
  // echo $output;
}


// Function to generate OTP
function generateNumericOTP()
{
  // Taking a generator string that consists of
  // all the numeric digits
  $generator = "1357902468";

  // Iterating for n-times and pick a single character
  // from generator and append it to $result

  // Login for generating a random character from generator
  //     ---generate a random number
  //     ---take modulus of same with length of generator (say i)
  //     ---append the character at place (i) from generator to result

  $result = "";

  for ($i = 1; $i <= 6; $i++) {
    $result .= substr($generator, rand() % strlen($generator), 1);
  }

  // Returning the result
  return $result;
}
