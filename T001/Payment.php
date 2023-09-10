<?php
if(isset($_GET["id_Cou"])){
  $id_Cou = $_GET["id_Cou"];
  require_once "../config/db.php";
}
require_once '../config/course_information.php';
require_once('../omise-php/lib/Omise.php');
define('OMISE_PUBLIC_KEY', 'pkey_test_5up309jgwjbj6ou8fs6');
define('OMISE_SECRET_KEY', 'skey_test_5up309jgwjbj6ou8fs6');

if (!empty($_POST['omiseToken'])) {
  try {
    $charge = OmiseCharge::create(array(
      'amount' => $_POST['amount'],
      'currency' => 'thb',
      'card' => $_POST['omiseToken']
    ));

    if ($charge['status'] == 'successful') {
      echo 'Payment Successful';
    } else {
      echo 'Payment failed: ' . $charge['failure_message'];
    }
  } catch (OmiseException $e) {
    echo 'Payment failed: ' . $e->getMessage();
  }
} else {
  echo 'Error: Missing required Omise Token';
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Omise Payment Gateway</title>
  <script type="text/javascript" src="https://cdn.omise.co/omise.js"></script>
  <style>
        /* Add your custom CSS styles here */
        form {
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 400px;
      margin: 0 auto;
      padding: 50px;
      background-color: #f2f2f2;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 18px;
        }

        input[type="submit"] {
        width: 100%;
        padding: 10px;
        margin-top: 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 18px;
        }

        input[type="submit"]:hover {
        background-color: #3e8e41;
        }
  </style>
</head>
<body>
  <form action="" method="post">
    <!-- Add input fields for card information -->
    <h1>Filter data to continue...</h1>
    <input type="text" id="cardName" placeholder="Cardholder Name">
    <input type="text" id="cardNumber" placeholder="Card Number">
    <input type="text" id="cardExpiryMonth" placeholder="Expiry Month">
    <input type="text" id="cardExpiryYear" placeholder="Expiry Year">
    <input type="text" id="cardCVC" placeholder="CVC">

    <input type="hidden" name="amount" value="100">
    <input type="hidden" name="omiseToken">
    <input type="submit" value="Pay">
  </form>

  <script type="text/javascript">
    Omise.setPublicKey("<?php echo OMISE_PUBLIC_KEY; ?>");
    var form = document.querySelector("form");
    form.addEventListener("submit", function (event) {
      event.preventDefault();

      Omise.createToken("card", {
        name: document.querySelector("#cardName").value,
        number: document.querySelector("#cardNumber").value,
        expiration_month: document.querySelector("#cardExpiryMonth").value,
        expiration_year: document.querySelector("#cardExpiryYear").value,
        security_code: document.querySelector("#cardCVC").value
      }, function (statusCode, response) {
        if (response.object == "token") {
          document.querySelector("input[name=omiseToken]").value = response.id;
          form.submit();
        } else {
          // Display an error message
          alert(response.message);
        }
      });
    });
  </script>
  <script>
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'path/to/your/stylesheet.css', true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var style = document.createElement('style');
        style.innerHTML = xhr.responseText;
        document.head.appendChild(style);
      }
    };
    xhr.send();

    fetch('path/to/your/stylesheet.css')
      .then(response => response.text())
      .then(css => {
        var style = document.createElement('style');
        style.innerHTML = css;
        document.head.appendChild(style);
      });
  </script>
</body>
</html>


