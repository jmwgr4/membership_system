<?php
session_start();
include 'db_connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $username = trim($data["username"]);
    $password = trim($data["password"]);

    if (!$conn) {
        echo json_encode(["success" => false, "message" => "Database connection failed!"]);
        exit();
    }

    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    if (!$stmt) {
        echo json_encode(["success" => false, "message" => "Database query failed!"]);
        exit();
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row["password"])) {
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["role"] = $row["role"];

            $redirectUrl = ($row["role"] === "admin") ? "admin_dashboard.php" : "member_dashboard.php";
            echo json_encode(["success" => true, "redirect" => $redirectUrl]);
            exit();
        } else {
            echo json_encode(["success" => false, "message" => "Incorrect password!"]);
            exit();
        }
    } else {
        echo json_encode(["success" => false, "message" => "Username not found!"]);
        exit();
    }

    
}
?>
