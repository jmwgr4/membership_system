<?php
include 'db_connection.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

$firstName = trim($data["firstName"]);
$middleName = trim($data["middleName"]) ?: null;
$lastName = trim($data["lastName"]);
$schoolId = trim($data["schoolId"]);
$username = trim($data["username"]);
$password = trim($data["password"]);
$phone = trim($data["phone"]);
$role = trim($data["role"]);

if($role !== "member" && $role !== "officer") {
    echo json_encode(["success" => false, "message" => "invalid role!"]);
    exit();
}

$stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR school_id = ?");
$stmt->bind_param("ss", $username, $schoolId);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "Username or School ID already exists!"]);
    exit();
}

$hashed_password = password_hash($password, PASSWORD_BCRYPT);

$stmt = $conn->prepare("INSERT INTO users (first_name, middle_name, last_name, school_id, username, password, phone, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $firstName, $middleName, $lastName, $schoolId, $username, $hashed_password, $phone, $role);

if($stmt->execute()){
    echo json_encode(["success" => true, "message" => "Account successfully created!"]);
} else {
    echo json_decode(["success" => false, "message" => "Error registering user."]);
}
?>