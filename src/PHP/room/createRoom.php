<?php
// Replace these with your actual Stringee credentials
$apiKeySid = 'YOUR_API_KEY_SID';
$apiKeySecret = 'YOUR_API_KEY_SECRET';

// Prepare payload to create a room
$data = [
    'name' => 'My_Video_Room_' . time(),
    'unique_name' => 'room_' . uniqid(),
    'record' => false
];

$payload = json_encode($data);

// Prepare request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.stringee.com/v1/room2/create");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "X-STRINGEE-AUTH: $apiKeySecret"
]);

// Execute request and parse response
$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>
