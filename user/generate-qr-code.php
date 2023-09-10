<?php

$form_field = array();
$form_field['partnerTxnUid']  = substr(uniqid(rand(), true), 0, 15);
$form_field['partnerId']  = 'RaSCW7ln47wmsjINCFNLzB434kX9bNqg';
$form_field['partnerSecret']  = 'Client Secret';
$form_field['requestDt']  = '2018-01-03T12:30:00+07:00';
$form_field['merchantId']  = 'ใส่ Merchant ID ดูที่ User Info';
$form_field['terminalId']  = 'term1';
$form_field['qrType']  = '3';
$form_field['txnAmount']  = 100.50;
$form_field['txnCurrencyCode']  = 'THB';
$form_field['reference1']  = 'INV001';
$form_field['metadata']  = 'ปลาร้าสับแพคถุง 100 บาท ยั่ว ๆ จ้าาา';

$ch = curl_init();

curl_setopt_array($ch, [
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'Cache-Control: no-cache',
    ],
    CURLOPT_URL => 'https://apiportal.kasikornbank.com:12002/pos/qr_request',
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($form_field),
    CURLOPT_RETURNTRANSFER => true,
]);

$data = curl_exec($ch);
curl_close($ch);

$response = json_decode($data);

$params = [];
$params['data'] = $response->qrCode;
$params['level'] = 'H';
$params['size'] = 10;
$params['savename'] = $img = 'qrcode/'.$response->partnerTxnUid.'.png';
$this->ciqrcode->generate($params);

echo '<img src="'.$img.'"/>';

?>
