<?php
session_start();

if(!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "member") {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script src="dashboard.js" defer></script>
</head>
<body>
    <h2>Welcome, Member</h2>
    <p id="user-info"></p>
    <nav>
        <ul>
            <li><a href="announcement_notifications.html">Announcement Notification</a></li>
        </ul>
        <button id="logout-btn">Logout</button>
    </nav>
</body>
</html>