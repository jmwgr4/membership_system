<?php
session_start();
if(!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin"){
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin DashBoard</title>
    <link rel="stylesheet" href="style.css">
    <script src="dashboard.js" defer></script>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?> (Admin)</h2>
    <p id="user-info">You have administrator privileges.</p>
    <nav>
        <ul>
            <li><a href="member_dashboard.php">Membership Directory</a></li>
            <li><a href="attendance_record.php">Attendance Record</a></li>
            <li><a href="announcement_notifications.php">Announcement Notification</a></li>
        </ul>
    </nav>
    <button id="logout-btn">Logout</button>
    
</body>
</html>