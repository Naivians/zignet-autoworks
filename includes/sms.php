<?php



function activate_account()
{
  $ch = curl_init();

  $code = rand(100000, 900000);


  for ($i = 1; $i <= 6; $i++) {
    $code .= rand(1, 9);
  }

  $parameters = array(
    'number' => '09510157609',
    'message' => "We have reviewed your Credentials, you can log in to our site",
    'username' => 'rent1',
    'password' => 'Qwer1234!'
  );

  curl_setopt($ch, CURLOPT_URL, 'http://178.128.117.85/apis/phpsms/');
  curl_setopt($ch, CURLOPT_POST, 1);

  //Send the parameters set above with the request
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));

  // Receive response from server
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $output = curl_exec($ch);
  curl_close($ch);

  // Show the server response
  echo $output;
}

// activate_account('09510157609');

activate_account();