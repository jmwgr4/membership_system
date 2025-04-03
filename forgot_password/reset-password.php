<?php
header('Content-Type: applicaiton/json');
$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'];

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["message" => "Invalid email format."]);
    exit();
}

$token = bin2hex(random_bytes(32));
$expiry = time() + 3600;

$conn = new mysqli("localhost", "root", "", "your_database");
$conn->query("INSERT INTO password_resets (email, token, expiry) VALUES ('$email', '$token', '$expiry')");

$resetLink = "http://yourwebsite.com/set-new-password.html?token=$token";
echo json_encode(["message" => "Check your email for the reset link.", "link" => $resetLink]);
?>