<?php
  # PHP Example to check a payment has been received
  # Payment Settings
  $my_address = "1LisLsZd3bx8U1NYzpNHqpo8Q6UCXKMJ4z";
  $desiredConfirmations = 3;

  # MySQL Settings
  $MYSQL_HOST = "localhost";
  $MYSQL_NAME = "main";
  $MYSQL_USER = "root";
  $MYSQL_PASSWORD = "jsd8ue8rijewjru";

  # Start of checks
  if(!isset($_GET['secret'])) {
      die('No secret found.');
  }

  # The only $_GET parameter should be the secret
  $secret = "7j0ap91o99cxj8k9";
  if ($_GET["secret"] !== $secret) die();

  # Make sure we have all the POST variables we want to get
  if(!$_POST['invoice_id'] || !$_POST['input_address'] || !$_POST['input_transaction_hash'] || !$_POST['transaction_hash'] || !$_POST['value'] || !$_POST['confirmations']) {
      die('One of more of the POST variables was not set in the request to our callback url.');
  }

  if ($_POST["destination_address"] !== $my_address) die();

  $invoice_id = $_POST["invoice_id"];
  $input_address = $_POST["input_address"];
  $input_transaction_hash = $_POST["input_transaction_hash"];
  $transaction_hash = $_POST["transaction_hash"];
  $value_in_btc = $_POST["value"];
  $confirmations = $_POST["confirmations"];
  $value_in_satoshi = $value_in_btc * 100000000;

  try {
      $conn = new PDO("mysql:host=$MYSQL_HOST;dbname=$MYSQL_NAME", "$MYSQL_USER", "$MYSQL_PASSWORD");
  } catch (PDOException $e) {
      die($e->getMessage());
  }

  # Confirmation check to make sure the confirmations is above our desired amount
  if($confirmations >= $desiredConfirmations) {
      # We should store the payment as soon as we receive it inside this callback file
      # We can later update details such as confirms if needed
      $stmt = $conn->prepare("INSERT INTO payments (invoice_id, input_address, input_transaction_hash, transaction_hash, value) VALUES (:invoice_id, :input_address, :input_transaction_hash, :transaction_hash, :value)");
      $stmt->execute(array("invoice_id" => $invoice_id, "input_address" => $input_address, "input_transaction_hash" => $input_transaction_hash, "transaction_hash" => $transaction_hash, "value" => $value_in_satoshi));

      if ($stmt->rowCount()) {
          # Good, we have now inserted the payment into the database
          echo "Successfully inserted payment into database";
      } else {
          # Failed to insert payment into database
      }
  } else {
      # Transaction has not reached our desired number of confirmations.
      # Keep waiting for confirmations to be larger
  }
?> 
