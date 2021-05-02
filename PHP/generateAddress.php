<?php
  # PHP Example To Generate Address
  # Change the two values below
  $secret = "7j0ap91o99cxj8k9";
  $my_address = "1LisLsZd3bx8U1NYzpNHqpo8Q6UCXKMJ4z";

  $my_callback_url = "http://example.com/callback?invoice_id=1234&secret=" . $secret;
  $api_base = "https://blockchainapi.org/api/btc"; # Our BTC API endpoint

  $curl = curl_init();
  curl_setopt_array($curl, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => $api_base . "?method=create&address=" . $my_address . "&callback=" . $my_callback_url
  ));

  $response = curl_exec($curl);
  $http_status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  curl_close($curl);

  # If we get a good, 200 http status code, get the payment details: input_address & estimated_transaction_fee
  if ($http_status_code == 200) {
      $decoded = json_decode($response, true);
      echo "Please send the payment to the following Bitcoin address: " . $decoded["success"]["input_address"];
      echo "The current estimated fee is: ".$decoded["success"]["estimated_transaction_fee"].' BTC';
  } else {
      echo "Sorry, an error occurred: " . $response["error"];
  }
?>
