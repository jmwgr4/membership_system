<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"), true);
$token = $data['token'];
$password = password_hash($data['password'], PASSWORD_BCRYPT);

$conn = new mysqli("localhost", "root", "", "membership_system");

$result = $conn->query("SELECT email FROM password_resets WHERE token='$token' AND expiry > " . time());
if($result->num_rows == 0) {
    echo json_encode(["success" => false, "message" => "Invalid or expired token."]);
    exit();
}

$email = $result->fetch_assoc()['email'];
$conn->query("UPDATE users SET password='$password' WHERE email='$email'");
$conn->querry("DELETE FROM password_resets WHERE email ='$email'");

echo json_encode(["success" => true, "message" => "Password reset successful."]);
?>