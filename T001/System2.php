<?php

// Your API key for the payment gateway
$apiKey = "skey_test_5up308530vbzsn02b14";

// The amount to be paid
$amount = 100;

// Generate the QR code URL using the payment gateway API
$qrCodeUrl = "https://payment-gateway.com/qr-code?api_key=" . urlencode($apiKey) . "&amount=" . urlencode($amount);

// Add CORS header to allow the image to be displayed
header("Access-Control-Allow-Origin: *");

// Try to retrieve the QR code image
$qrCodeImage = @file_get_contents($qrCodeUrl);
if ($qrCodeImage === false) {
    // Error handling
    echo "Error: Failed to retrieve QR code image: " . error_get_last()['message'];
} else {
    // Display the QR code image
    header("Content-Type: image/png");
    echo $qrCodeImage;
}

?>
